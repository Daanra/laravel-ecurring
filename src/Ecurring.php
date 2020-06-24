<?php

namespace Daanra\Ecurring;

use Daanra\Ecurring\Api\CustomerApi;
use Daanra\Ecurring\Repositories\CustomerRepository;
use Daanra\Ecurring\Repositories\SubscriptionPlanRepository;
use Daanra\Ecurring\Repositories\SubscriptionRepository;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Traits\ForwardsCalls;
use Illuminate\Http\Client\Factory;

/**
 * Class Ecurring
 */
class Ecurring
{
    use ForwardsCalls;

    /** @var Client */
    protected $client;

    /** @var PendingRequest */
    protected $http;

    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->http = Http::withHeaders([
            'X-Authorization' => $client->getApiKey()
        ]);
    }
//
//    public function __call($method, $parameters)
//    {
//        return $this->forwardCallTo($this->http, $method, $parameters);
//    }

    public function create()
    {
        return $this->http->post('/');
    }

    public function post(string $path, array $data = [])
    {
        return $this->http->post($this->client->getUrl($path), $data);
    }

    public function patch(string $path, array $data = [])
    {
        return $this->http->patch($this->client->getUrl($path), $data);
    }

    /**
     * @param string $path
     * @param array|string|null $query
     */
    public function get(string $path, $query = null)
    {
        return $this->http->get($this->client->getUrl($path), $query);
    }

    public function customer(): CustomerRepository
    {
        return new CustomerRepository();
    }

    public function subscription(): SubscriptionRepository
    {
        return new SubscriptionRepository();
    }

    public function subscriptionPlan(): SubscriptionPlanRepository
    {
        return new SubscriptionPlanRepository();
    }
}
