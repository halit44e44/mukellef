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

    public function createOrUpdateSubscription(array $data)
    {
        if ($this->userSubscriptionRepository->existsSubscription($data['user_id'], $data['subscription_id'])) {
            throw new \Exception('This user has a subscription', 400);
        }

        if ($checkSub = $this->userSubscriptionRepository->findByUserId($data['user_id'])) {
            return $this->userSubscriptionRepository->update($checkSub->id, $data);
        }
        return $this->userSubscriptionRepository->create($data);
    }


    public function deleteSubscription(int $id)
    {
        return $this->userSubscriptionRepository->delete($id);
    }

}
