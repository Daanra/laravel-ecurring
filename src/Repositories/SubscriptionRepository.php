<?php

namespace Daanra\Ecurring\Repositories;

use Daanra\Ecurring\Constants\SubscriptionStatus;
use Daanra\Ecurring\Models\Subscription;
use Carbon\Carbon;

class SubscriptionRepository extends BaseRepository
{
    protected static $model = Subscription::class;


    public static function updateStatus($id, string $status): Subscription
    {
        return static::update($id, [
            'status' => $status
        ]);
    }

    /**
     * @param int|string $id
     * @param string|\Illuminate\Support\Carbon|null $cancel_at - If it's a string, it should be in ISO 8601 format
     * @return mixed
     * @throws \Daanra\Ecurring\Contracts\ApiException
     */
    public static function cancel($id, $cancel_at = null)
    {
        if ($cancel_at instanceof Carbon) {
            $cancel_at = $cancel_at->toIso8601String();
        }

        return static::update($id, $cancel_at ? [
            'cancel_date' => $cancel_at,
        ] : [
            'status' => SubscriptionStatus::CANCELLED,
        ]);
    }

    public static function resume($id)
    {
        return static::updateStatus($id, SubscriptionStatus::ACTIVE);
    }

    /**
     * @param int|string $id
     * @param string|\Illuminate\Support\Carbon|null $resume_at - If it's a string, it should be in ISO 8601 format
     * @return Subscription
     * @throws \Daanra\Ecurring\Contracts\ApiException
     */
    public static function pause($id, $resume_at = null): Subscription
    {
        if ($resume_at instanceof Carbon) {
            $resume_at = $resume_at->toIso8601String();
        }

        return static::update($id, [
            'status' => SubscriptionStatus::PAUSED,
            'resume_date' => $resume_at,
        ]);
    }

    /**
     * @param int|string $subscription_id
     */
    public static function getTransactions($subscription_id)
    {
        return collect([]);
    }
}
