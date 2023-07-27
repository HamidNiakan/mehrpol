<?php

namespace App\Listeners;

use App\Enums\UserSubscription\UserSubscriptionStatusEnums;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AssigningSubscriptionToUserIosListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
		$user = $event->user;
		$subscription = Subscription::query()->find(2);
		
		$user->subscriptions()
			 ->create([
						  'subscription_id' => $subscription->id,
						  'started_at' => Carbon::now(),
						  'end_at' => Carbon::now()->addDays($subscription->day),
						  'status' => UserSubscriptionStatusEnums::Active
					  ]);
    }
}
