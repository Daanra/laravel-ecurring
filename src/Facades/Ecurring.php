<?php

namespace Daanra\Ecurring\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Daanra\Ecurring\Ecurring
 * @method static \Daanra\Ecurring\Repositories\CustomerRepository customer()
 * @method static \Daanra\Ecurring\Repositories\SubscriptionRepository subscription()
 * @method static \Daanra\Ecurring\Repositories\SubscriptionPlanRepository subscriptionPlan()
 * @method static \Daanra\Ecurring\Repositories\InvoiceRepository invoice()
 * @method static \Illuminate\Http\Client\Response delete(string $url, array $data = [])
 * @method static \Illuminate\Http\Client\Response get(string $url, array $query = [])
 * @method static \Illuminate\Http\Client\Response head(string $url, array $query = [])
 * @method static \Illuminate\Http\Client\Response patch(string $url, array $data = [])
 * @method static \Illuminate\Http\Client\Response post(string $url, array $data = [])
 * @method static \Illuminate\Http\Client\Response put(string $url, array $data = [])
 * @method static \Illuminate\Http\Client\Response send(string $method, string $url, array $options = [])
 */
class Ecurring extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ecurring';
    }
}
