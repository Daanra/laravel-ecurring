<?php

namespace Daanra\Ecurring\Exceptions;

use Daanra\Ecurring\Contracts\ApiException;
use Exception;
use Illuminate\Http\Client\Response;

class ServerError extends Exception implements ApiException
{
    protected Response $response;

    protected ?string $response_code;

    public function __construct(Response $response)
    {
        $this->response = $response;
        $data = $response->json();
        $this->response_code = isset($data['errors']['code']) ? $data['errors']['code'] : null;
        $strData = rescue(function () use ($data) {
            return json_encode($data);
        }, '') ?: 'false';
        parent::__construct('The eCurring API request failed with an internal server error. Code: ' . $this->response_code . ' Body: ' . $strData);
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
