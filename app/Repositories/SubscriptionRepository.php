<?php

namespace App\Repositories;

use App\Models\Subscription;

class SubscriptionRepository
{
    public function create(array $data)
    {
        return Subscription::create($data);
    }

    public function update(int $id, array $data)
    {
        $subscription = Subscription::findOrFail($id);
        $subscription->update($data);
        return $subscription;
    }

    public function find(int $id)
    {
        return Subscription::findOrFail($id);
    }

    public function all(array $data)
    {
        $subscription = Subscription::orderBy(
            $data['sort'] ?? 'id',
            $data['sortType'] ?? 'desc');
        return $subscription->paginate($data['perPage'] ?? 15);
    }

    public function delete(int $id)
    {
        $subscription = Subscription::findOrFail($id);
        $subscription->delete();
        return $subscription;
    }
}
