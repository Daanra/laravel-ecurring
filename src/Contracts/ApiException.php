<?php

namespace Daanra\Ecurring\Contracts;

use Illuminate\Http\Client\Response;

interface ApiException
{
    public function getResponse(): Response;
}
