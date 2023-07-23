<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserSubscriptionRequest;
use App\Http\Resources\UserSubscriptionResource;
use App\Models\UserSubscription;
use App\Services\UserSubscriptionService;
use Exception;
use Illuminate\Http\JsonResponse;

class UserSubscriptionController extends Controller
{
    protected UserSubscriptionService $userSubscriptionService;

    public function __construct(UserSubscriptionService $userSubscriptionService)
    {
        $this->userSubscriptionService = $userSubscriptionService;
    }

    /**
     * @param UserSubscriptionRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function createOrUpdate(UserSubscriptionRequest $request): JsonResponse
    {
        $subscription = $this->userSubscriptionService->createOrUpdateSubscription($request->all());
        return $this->callBackResponse("User subscription is saved", new UserSubscriptionResource($subscription), 201);
    }

    /**
     * @param int $userSubscriptionId
     * @return JsonResponse
     */
    public function destroy(int $userSubscriptionId): JsonResponse
    {
        $subscription = $this->userSubscriptionService->deleteSubscription($userSubscriptionId);
        return $this->callBackResponse("User subscription is deleted", new UserSubscriptionResource($subscription));
    }
}
