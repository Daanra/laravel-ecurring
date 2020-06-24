<?php

namespace Daanra\Ecurring\Exceptions;

use Daanra\Ecurring\Contracts\ApiException;
use Illuminate\Database\Eloquent\ModelNotFoundException as BaseException;
use Illuminate\Http\Client\Response;

class ModelNotFoundException extends BaseException implements ApiException
{
    protected Response $response;

    protected ?string $response_code;

    public function __construct(Response $response, string $model_type, $model_id)
    {
        $this->response = $response;
        $data = $response->json();
        $this->response_code = isset($data['errors']['code']) ? $data['errors']['code'] : null;
        parent::__construct($model_type, $model_id);
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
