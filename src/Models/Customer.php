<?php

namespace Daanra\Ecurring\Models;

use Daanra\Ecurring\Repositories\SubscriptionPlanRepository;
use Daanra\Ecurring\Repositories\SubscriptionRepository;
use Illuminate\Support\Collection;

/**
 * A Customer entity in eCurring. All properties are non-nullable. In case the property has not been filled
 * in, its value is the empty string.
 */
class Customer extends BaseModel
{
    /** @var string|null ''|'m'|'f' */
    public ?string $gender;
    public string $first_name;
    public ?string $middle_name;
    public string $last_name;
    public ?string $company_name;
    public ?string $vat_number;
    public ?string $bank_holder;
    public ?string $iban;
    public string $payment_method;
    public ?string $bank_verification_method;
    public ?string $card_holder;
    public ?string $card_number;
    public ?string $postalcode;
    public ?string $house_number;
    public ?string $house_number_add;
    public ?string $street;
    public ?string $city;
    public ?string $country_iso2;
    public string $email;
    public ?string $telephone;
    public string $language;
    public string $created_at;
    public string $updated_at;
    /** @var Collection|int[] */
    public Collection $subscription_ids;


    public function getLatestSubscription(): ?Subscription
    {
        $latest = $this->subscription_ids->last();
        return $latest ? SubscriptionRepository::find($latest) : null;
    }
}