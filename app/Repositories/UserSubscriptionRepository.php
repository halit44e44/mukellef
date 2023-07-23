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

    public function find(int $id)
    {
        return UserSubscription::findOrFail($id);
    }

    public function all(array $data)
    {
        $subscription = UserSubscription::orderBy(
            $data['sort'] ?: 'id',
            $data['sortType'] ?: 'desc');
        return $subscription->paginate($data['perPage']);
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
}