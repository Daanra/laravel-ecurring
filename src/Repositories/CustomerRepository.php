<?php

namespace Daanra\Ecurring\Repositories;

use Daanra\Ecurring\Models\Customer;

/**
 * Class CustomerRepository
 * @method static Customer|null find($id)
 * @method static Customer create($id)
 * @method static Customer update($id, array $attributes)
 */
class CustomerRepository extends BaseRepository
{
    protected static $model = Customer::class;
}
