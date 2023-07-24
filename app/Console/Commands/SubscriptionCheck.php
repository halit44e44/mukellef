<?php

namespace App\Console\Commands;

use App\Repositories\TransactionRepository;
use App\Services\UserSubscriptionService;
use Illuminate\Console\Command;

class SubscriptionCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscription:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Abonelikleri belli periodlar ile kontrol eder.
    Aboneliği son 6 saat içerisine gelen kullanıcıların aboneliklerini otomatik yeniler';


    protected UserSubscriptionService $userSubscriptionService;
    protected TransactionRepository $transactionRepository;
    private bool $paymentStatus = true;

    public function __construct(UserSubscriptionService $userSubscriptionService, TransactionRepository $transactionRepository)
    {
        parent::__construct();
        $this->userSubscriptionService = $userSubscriptionService;
        $this->transactionRepository = $transactionRepository;
    }

    /**
     * Execute the console command.
     */
    /*
     * NOT : Bu alanda kuyruk kullanmak daha sağlıklı olacaktır. Ödeme işlemleri uzun sonuçlar dönderdiği için kuyruğu atılıp
     * 3 4 defa tekrar tekrar denenmesi daha sağlıklı olacaktır. Failure işlemleride bir nebze olsun önüne geçmiş oluruz.
     * Ve çok fazla yük binmemiş olur.  
     */
    public function handle(): bool
    {
        $expiredSubscriptions = $this->userSubscriptionService->findExpiredSubscriptions(6);

        if ($expiredSubscriptions->count() > 0) {
            foreach ($expiredSubscriptions as $expiredSubscription) {
                //TODO:: Ödeme için gerekli servislere istekler atılmış olarak kabul ediyorum.
                if ($this->paymentStatus) {
                    $this->transactionRepository->create([
                        'user_subscription_id' => $expiredSubscription->id,
                        'price' => $expiredSubscription->subscription->price,
                        'result' => $this->paymentStatus
                    ]);
                    $this->userSubscriptionService->updateTimeSubscription($expiredSubscription);
                    echo $expiredSubscription->id . ' - ' . "Payment Success" . PHP_EOL;
                }
            }
            return 1;
        }
        return 0;
    }
}
