<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubscriptionRequest;
use App\Http\Resources\SubscriptionResource;
use App\Models\Subscription;
use App\Services\SubscriptionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{

    protected SubscriptionService $subscriptionService;

    public function __construct(SubscriptionService $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $subscription = $this->subscriptionService->listSubscriptions($request->all());
        return response()->json([
            'message' => 'Subscription received successfully',
            'data' => SubscriptionResource::collection($subscription)
        ]);
    }

    /**
     * @param SubscriptionRequest $request
     * @return JsonResponse
     */
    public function store(SubscriptionRequest $request): JsonResponse
    {
        $subscription = $this->subscriptionService->createSubscription($request->all());
        return response()->json([
            'message' => 'Subscription is saved',
            'data' => new SubscriptionResource($subscription)
        ], 201);
    }

    /**
     * @param Subscription $subscription
     * @return JsonResponse
     */
    public function show(Subscription $subscription): JsonResponse
    {
        $subscription = $this->subscriptionService->showSubscription($subscription->id);
        return response()->json([
            'message' => 'Subscription received successfully',
            'data' => new SubscriptionResource($subscription)
        ]);
    }

    /**
     * @param SubscriptionRequest $request
     * @param Subscription $subscription
     * @return JsonResponse
     */
    public function update(SubscriptionRequest $request, Subscription $subscription): JsonResponse
    {
        $subscription = $this->subscriptionService->updateSubscription($subscription->id, $request->all());
        return response()->json([
            'message' => 'Subscription is updated',
            'data' => new SubscriptionResource($subscription)
        ]);
    }

    /**
     * @param Subscription $subscription
     * @return JsonResponse
     */
    public function destroy(Subscription $subscription): JsonResponse
    {
        $subscription = $this->subscriptionService->deleteSubscription($subscription->id);
        return response()->json([
            'message' => 'Subscription is deleted',
            'data' => new SubscriptionResource($subscription)
        ]);
    }
}
