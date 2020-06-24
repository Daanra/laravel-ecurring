<?php

namespace Daanra\Ecurring\Exceptions;

use Daanra\Ecurring\Contracts\ApiException;
use Exception;
use Illuminate\Http\Client\Response;

class ClientError extends Exception implements ApiException
{
    protected Response $response;

    protected ?string $response_code;

    public function __construct(Response $response)
    {
        $this->response = $response;
        $data = $response->json();
        $this->response_code = isset($data['errors']['code']) ? $data['errors']['code'] : null;
        parent::__construct('The eCurring API request failed with a client error.');
    }

    public function getResponse(): Response
    {
        return $this->response;
    }

    public function getResponseCode(): ?string
    {
        return $this->response_code;
    }
}
