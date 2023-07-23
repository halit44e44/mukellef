<?php

namespace App\Services;

use App\Repositories\SubscriptionRepository;

class SubscriptionService
{
    protected SubscriptionRepository $subscriptionRepository;

    public function __construct(SubscriptionRepository $subscriptionRepository)
    {
        $this->subscriptionRepository = $subscriptionRepository;
    }

    public function createSubscription(array $data)
    {
        return $this->subscriptionRepository->create($data);
    }

    public function updateSubscription(int $id, array $data)
    {
        return $this->subscriptionRepository->update($id, $data);
    }

    public function showSubscription(int $id)
    {
        return $this->subscriptionRepository->find($id);
    }

    public function listSubscriptions(array $data)
    {
        return $this->subscriptionRepository->all($data);
    }

    public function deleteSubscription(int $id)
    {
        return $this->subscriptionRepository->delete($id);
    }

}
