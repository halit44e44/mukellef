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
    public function store(UserSubscriptionRequest $request): JsonResponse
    {
        $subscription = $this->userSubscriptionService->createSubscription($request->all());
        return $this->callBackResponse("User subscription is saved", new UserSubscriptionResource($subscription), 201);
    }

    public function update(UserSubscriptionRequest $request, UserSubscription $userSubscription): JsonResponse
    {
        $subscription = $this->userSubscriptionService->updateSubscription($userSubscription->id, $request->all());
        return $this->callBackResponse("User subscription is updated", new UserSubscriptionResource($subscription));
    }

    /**
     * @param UserSubscription $userSubscription
     * @return JsonResponse
     */
    public function destroy(UserSubscription $userSubscription): JsonResponse
    {
        $subscription = $this->userSubscriptionService->deleteSubscription($userSubscription->id);
        return $this->callBackResponse("User subscription is deleted", new UserSubscriptionResource($subscription));
    }
}
