<?php

namespace Tests\Feature\Concerns;
use App\Models\Subscription;
use App\Models\UserSubscription;

trait TestingSubscription {
	
	public function createSubscription(int $day) {
		return Subscription::factory()
					->withNumberOfDays($day)->create();
	}
	
	
	public function findUserSubscriptionByUserId(int $user) {
		return UserSubscription::query()->where('user_id',$user->id)->first();
	}
}