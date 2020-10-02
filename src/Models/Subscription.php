<?php

namespace Daanra\Ecurring\Models;

use Daanra\Ecurring\Constants\SubscriptionStatus;
use Daanra\Ecurring\Facades\Ecurring;
use Daanra\Ecurring\Repositories\CustomerRepository;
use Daanra\Ecurring\Repositories\SubscriptionPlanRepository;

/**
 * A Customer entity in eCurring. All properties are non-nullable. In case the property has not been filled
 * in, its value is the empty string.
 */
class Subscription extends BaseModel
{
    public ?string $mandate_code;
    public bool $mandate_accepted;

    public ?string $mandate_accepted_date;
    public string $start_date;

    /** @var string - One of @see \Daanra\Ecurring\Constants\SubscriptionStatus */
    public string $status;

    public ?string $cancel_date;

    public ?string $resume_date;

    public string $confirmation_page;

    public bool $confirmation_sent;

    public string $subscription_webhook_url;

    public string $transaction_webhook_url;

    public ?string $success_redirect_url;

    public $metadata;

    public string $created_at;

    public string $updated_at;

    public string $subscription_plan_id;

    public string $customer_id;

    private $subscription_plan;
    private $transactions;

    public function cancelled(): bool
    {
        return $this->status === SubscriptionStatus::CANCELLED || $this->cancel_date;
    }

    public function paused(): bool
    {
        return $this->status === SubscriptionStatus::CANCELLED;
    }

    public function active(): bool
    {
        return $this->status === SubscriptionStatus::ACTIVE;
    }

    public function unverified(): bool
    {
        return $this->status === SubscriptionStatus::UNVERIFIED;
    }

    public function getCustomer(): ?Customer
    {
        return CustomerRepository::find($this->customer_id);
    }

    public function getSubscriptionPlan(): SubscriptionPlan
    {
        if ($this->subscription_plan !== null) {
            return $this->subscription_plan;
        }

        return $this->subscription_plan = SubscriptionPlanRepository::find($this->subscription_plan_id);
    }

    /**
     * @param string|\Illuminate\Support\Carbon|null $cancel_at - If it's a string, it should be in ISO 8601 format
     * @return mixed
     * @throws \Daanra\Ecurring\Contracts\ApiException
     */
    public function cancel($cancel_at = null)
    {
        return Ecurring::subscription()->cancel($this->id, $cancel_at);
    }

    public function getTransactions()
    {
        if ($this->transactions !== null) {
            return $this->transactions;
        }

        return $this->transactions = SubscriptionPlanRepository::getTransactions($this->id);
    }
}
