<?php

namespace Daanra\Ecurring\Repositories;

use function collect;
use Daanra\Ecurring\Contracts\RestApi;
use Daanra\Ecurring\Facades\Ecurring;
use Daanra\Ecurring\Factories\ApiExceptionFactory;
use Daanra\Ecurring\Models\BaseModel;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Str;

class BaseRepository implements RestApi
{
    protected static $model;

    public static function find($id): ?BaseModel
    {
        $response = Ecurring::get(static::getBasePath() . '/' . $id);
        if (! $response->successful()) {
            throw ApiExceptionFactory::make($response, static::$model, $id);
        }

        return static::makeModel($response);
    }

    /**
     * @param array $attributes
     * @return mixed
     * @throws \Daanra\Ecurring\Contracts\ApiException
     */
    public static function create(array $attributes)
    {
        $response = Ecurring::post(static::getBasePath(), [
            'data' => [
                'type' => static::getModelName(),
                'attributes' => $attributes,
            ],
        ]);

        if (! $response->successful()) {
            throw ApiExceptionFactory::make($response, static::$model);
        }

        return static::makeModel($response);
    }

    public static function update($id, array $attributes)
    {
        $response = Ecurring::patch(static::getBasePath() . '/' . $id, static::formatBody($id, $attributes));
        if (! $response->successful()) {
            throw ApiExceptionFactory::make($response, static::$model);
        }

        return static::makeModel($response);
    }

    /**
     * @param int|string $id
     * @param array $attributes
     * @return array
     */
    protected static function formatBody($id, array $attributes)
    {
        return [
            'data' => [
                'type' => static::getModelName(),
                'id' => (string)$id,
                'attributes' => $attributes,
            ],
        ];
    }

    public static function getModelName()
    {
        return Str::kebab(Str::afterLast(static::$model, '\\'));
    }

    public static function getBasePath()
    {
        return '/' . Str::plural(static::getModelName());
    }

    public static function makeFromData(array $data)
    {
        $attributes = $data['attributes'];
        $attributes['id'] = $data['id'];
        $relations = $data['relationships'] ?? [];
        foreach ($relations as $relation_name => $relation) {
            if (! isset($relation['data'])) {
                continue;
            }
            $relation_name = Str::slug($relation_name, '_');
            $singular = Str::singular($relation_name);
            $has_multiple = $singular !== $relation_name;
            if ($has_multiple) {
                $attributes[$singular . '_ids'] = collect($relation['data'])->map->id;
            } else {
                $attributes[$relation_name . '_id'] = $relation['data']['id'];
            }
        }

        return static::$model::make($attributes);
    }

    public static function makeModel(Response $response)
    {
        $data = $response->json()['data'];

        return static::makeFromData($data);
    }
}
