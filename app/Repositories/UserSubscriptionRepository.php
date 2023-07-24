<?php


namespace App\Repositories;

use App\Models\UserSubscription;

class UserSubscriptionRepository
{
    public function create(array $data)
    {
        return UserSubscription::create($data);
    }

    public function update(int $id, array $data)
    {
        $subscription = UserSubscription::findOrFail($id);
        $subscription->update($data);
        return $subscription;
    }

    public function findByUserId(int $userId)
    {
        return UserSubscription::whereUserId($userId)->first();
    }

    public function delete(int $id)
    {
        $subscription = UserSubscription::findOrFail($id);
        $subscription->delete();
        return $subscription;
    }

    public function existsSubscription(int $user_id, int $subscription_id): bool
    {
        return UserSubscription::where('user_id', $user_id)
            ->where('subscription_id', $subscription_id)
            ->exists();
    }

    public function findExpiredSubscriptions(int $hour)
    {
        return UserSubscription::where('expired_at', '<', now()->addHours($hour))->where('expired_at', '>', now())->get();
    }

    public function updateTime(UserSubscription $userSubscription)
    {
        $subscription = UserSubscription::findOrFail($userSubscription->id);
        $subscription->update([
            'renewed_at' => now(),
            'expired_at' => now()->addMonth()
        ]);
        return $subscription;
    }
}
