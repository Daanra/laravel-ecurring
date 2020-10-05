<?php

namespace Daanra\Ecurring\Models;

use Illuminate\Support\Collection;

/**
 * A Customer entity in eCurring. All properties are non-nullable. In case the property has not been filled
 * in, its value is the empty string.
 */
class SubscriptionPlan extends BaseModel
{
    public string $name;
    public string $description;
    public string $start_date;
    public string $status;
    public string $mandate_authentication_method;
    public bool $send_invoice;
    public int $storno_retries;
    public $terms;
    public string $created_at;
    public string $updated_at;

    public ?Collection $subscription_ids;

    public function subscriptions()
    {
    }
}
