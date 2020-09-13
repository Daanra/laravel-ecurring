<?php

namespace Daanra\Ecurring\Concerns;

use Daanra\Ecurring\Exceptions\EcurringCustomerNotSet;
use Daanra\Ecurring\Facades\Ecurring;
use Daanra\Ecurring\Models\Customer;
use Daanra\Ecurring\Models\Subscription;

trait Billable
{
    private ?Subscription $fetchedSubscription;
    private ?Customer $fetchedCustomer;

    private bool $hasFetchedCustomer = false;
    private bool $hasFetchedSubscription = false;

    public function getCustomer(): ?Customer
    {
        if ($this->ecurring_customer_id === null) {
            return null;
        }

        if ($this->hasFetchedCustomer) {
            return $this->fetchedCustomer;
        }

        $this->hasFetchedCustomer = true;

        return $this->fetchedCustomer = Ecurring::customer()->find($this->ecurring_customer_id);
    }

    public function getSubscription(): ?Subscription
    {
        if ($this->hasFetchedSubscription) {
            return $this->fetchedSubscription;
        }

        $this->hasFetchedSubscription = true;

        return $this->fetchedSubscription = optional($this->getCustomer())->getLatestSubscription();
    }

    /**
     * @param string|int $subscription_plan_id
     * @param array $attributes - The extra attributes to send to the API endpoint.
     * @throws EcurringCustomerNotSet
     * @throws \Daanra\Ecurring\Contracts\ApiException
     * @return Subscription
     */
    public function createSubscription($subscription_plan_id, array $attributes = []): Subscription
    {
        if ($this->ecurring_customer_id === null) {
            throw new EcurringCustomerNotSet($this);
        }

        return Ecurring::subscription()->create(array_merge([
            'customer_id' => (string) $this->ecurring_customer_id,
            'subscription_plan_id' => (string) $subscription_plan_id,
        ], $attributes));
    }
}
