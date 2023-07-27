<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
			'id' => $this->id,
			'last_name' => $this->last_name,
			'first_name' => $this->first_name,
			'mobile' => $this->mobile,
			'device_type' => $this->device_type->value,
			'subscriptions' => $this->whenLoaded('subscriptions',UserSubscriptionResource::collection($this->subscriptions->load('subscription')))
		];
    }
}
