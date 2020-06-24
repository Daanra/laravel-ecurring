<?php

namespace Daanra\Ecurring\Contracts;

interface RestApi
{
    /**
     * @param string|int $id
     * @return mixed
     */
    public static function find($id);
}
