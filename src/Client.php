<?php

namespace Daanra\Ecurring;

class Client
{
    /** @var string */
    protected $endpoint;

    /** @var string */
    protected $api_key;

    /** @var string */
    protected $prefix;

    public function __construct(string $api_key, string $endpoint, string $prefix = '')
    {
        $this->api_key = $api_key;
        $this->endpoint = $endpoint;
        $this->prefix = $prefix;
    }

    public function setPrefix(string $prefix): self
    {
        $this->prefix = $prefix;

        return $this;
    }

    public function getUrl(string $path = ''): string
    {
        return $this->endpoint . $this->prefix . $path;
    }

    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    public function getApiKey(): string
    {
        return $this->api_key;
    }
}
