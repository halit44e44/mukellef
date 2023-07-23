<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserSubscriptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
//        return parent::toArray($request);
        return [
            'id' => $this->id,
            'status' => $this->status,
            'renewed_at' => $this->renewed_at,
            'expired_at' => $this->expired_at,
            'subscription' => $this->subscription,
            'user' => $this->user
        ];
    }
}
