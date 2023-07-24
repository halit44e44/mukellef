<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{

    /**
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'subscription' => [
                'id' => $this->userSubscription->id,
                'subscription_id' => $this->userSubscription->subscription_id,
                'subscription_name' => $this->userSubscription->subscription->title,
                'status' => $this->userSubscription->status,
                'renewed_at' => $this->userSubscription->renewed_at,
                'expired_at' => $this->userSubscription->expired_at,
                'transactions' => $this->userSubscription->transactions,
            ]
        ];
    }
}
