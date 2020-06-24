<?php

namespace Daanra\Ecurring\Repositories;

use Daanra\Ecurring\Models\SubscriptionPlan;

/**
 * Class SubscriptionPlanRepository
 * @method static SubscriptionPlan|null find($id)

 */
class SubscriptionPlanRepository extends BaseRepository
{
    protected static $model = SubscriptionPlan::class;
}
