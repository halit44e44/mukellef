<?php


namespace App\Services;

use App\Models\UserSubscription;
use App\Repositories\TransactionRepository;
use App\Repositories\UserSubscriptionRepository;

class UserSubscriptionService
{
    private $result;
    private bool $paymentStatus = true;
    protected UserSubscriptionRepository $userSubscriptionRepository;
    protected TransactionRepository $transactionRepository;

    public function __construct(UserSubscriptionRepository $userSubscriptionRepository, TransactionRepository $transactionRepository)
    {
        $this->userSubscriptionRepository = $userSubscriptionRepository;
        $this->transactionRepository = $transactionRepository;
    }

    public function createOrUpdateSubscription(array $data)
    {
        if ($this->userSubscriptionRepository->existsSubscription($data['user_id'], $data['subscription_id'])) {
            throw new \Exception('This user has a subscription', 400);
        }

        //TODO:: Ödeme için gerekli servislere istekler atılmış olarak kabul ediyorum.
        if ($this->paymentStatus) {
            if ($checkSub = $this->userSubscriptionRepository->findByUserId($data['user_id'])) {
                $this->result = $this->userSubscriptionRepository->update($checkSub->id, $data);
            } else {
                $this->result = $this->userSubscriptionRepository->create($data);
            }
            $this->transactionRepository->create([
                'user_subscription_id' => $this->result->id,
                'price' => $this->result->subscription->price,
                'result' => $this->paymentStatus
            ]);

            return $this->result;
        }
        return false;
    }


    public function deleteSubscription(int $id)
    {
        return $this->userSubscriptionRepository->delete($id);
    }

    public function findExpiredSubscriptions(int $hour)
    {
        return $this->userSubscriptionRepository->findExpiredSubscriptions($hour);
    }

    public function updateTimeSubscription(UserSubscription $userSubscription)
    {
        return $this->userSubscriptionRepository->updateTime($userSubscription);
    }
}
