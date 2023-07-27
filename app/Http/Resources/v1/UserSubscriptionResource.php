<?php

namespace App\Http\Resources\v1;

use App\Models\Subscription;
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
        return [
			'id' => $this->id,
			'started_at' => $this->started_at,
			'end_at' => $this->end_at,
			'reminder_days' => $this->reminder_days,
			'subscription' => $this->whenLoaded('subscription',SubscriptionResource::make($this->subscription))
		];
    }
}
