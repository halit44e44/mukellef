<?php


namespace App\Services;

use App\Repositories\UserSubscriptionRepository;

class UserSubscriptionService
{
    protected UserSubscriptionRepository $userSubscriptionRepository;

    public function __construct(UserSubscriptionRepository $userSubscriptionRepository)
    {
        $this->userSubscriptionRepository = $userSubscriptionRepository;
    }

    public function createSubscription(array $data)
    {
        if ($this->userSubscriptionRepository->existsSubscription($data['user_id'], $data['subscription_id'])) {
            throw new \Exception('This user has a subscription', 400);
        }
        return $this->userSubscriptionRepository->create($data);
    }

    public function updateSubscription(int $id, array $data)
    {
        return $this->userSubscriptionRepository->update($id, $data);
    }

    public function showSubscription(int $id)
    {
        return $this->userSubscriptionRepository->find($id);
    }

    public function listSubscriptions(array $data)
    {
        return $this->userSubscriptionRepository->all($data);
    }

    public function deleteSubscription(int $id)
    {
        return $this->userSubscriptionRepository->delete($id);
    }

}
