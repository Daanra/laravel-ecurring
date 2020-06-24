<?php

namespace Daanra\Ecurring\Exceptions;

use Exception;

class EcurringApiKeyMissing extends Exception
{
    public function __construct()
    {
        parent::__construct('The eCurring API key is not set.');
    }
}