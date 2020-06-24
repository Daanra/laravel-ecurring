<?php

namespace Daanra\Ecurring\Exceptions;

use Exception;
use Illuminate\Http\Client\Response;

class EcurringCustomerNotSet extends Exception
{
    public $model;

    public function __construct($model)
    {
        $this->model = $model;
        parent::__construct('The eCurring customer id was not set on this model.');
    }
}