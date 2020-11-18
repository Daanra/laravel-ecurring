<?php

namespace Daanra\Ecurring\Repositories;

use Daanra\Ecurring\Facades\Ecurring;
use Daanra\Ecurring\Factories\ApiExceptionFactory;
use Daanra\Ecurring\Models\SubscriptionPlan;
use Illuminate\Support\Collection;

/**
 * Class SubscriptionPlanRepository
 * @method static SubscriptionPlan|null find($id)

 */
class SubscriptionPlanRepository extends BaseRepository
{
    protected static $model = SubscriptionPlan::class;

    public function all(int $amount = 200): Collection
    {
        $response = Ecurring::get(static::getBasePath(), [
            'page[size]' => $amount,
        ]);
        if (! $response->successful()) {
            throw ApiExceptionFactory::make($response, static::$model);
        }

        $data = $response->json()['data'];
        return collect($data)->map(function ($plan) {
            return static::makeModel($plan);
        });
    }
}
