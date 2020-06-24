<?php

namespace Daanra\Ecurring\Factories;

use Daanra\Ecurring\Contracts\ApiException;
use Daanra\Ecurring\Exceptions\ModelNotFoundException;
use Daanra\Ecurring\Exceptions\ServerError;
use Illuminate\Http\Client\Response;

class ApiExceptionFactory
{
    public static function make(Response $response, string $model, $id = null): ApiException
    {
        if ($response->status() === 404) {
            return new ModelNotFoundException($response, $model, $id);
        }

        if ($response->status() >= 500) {
            return new ServerError($response);
        }

        if ($response->status() === 403) {

        }
        dd($response->json());
    }
}