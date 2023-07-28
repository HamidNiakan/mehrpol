<?php

namespace Tests\Feature\Concerns;
use App\Enums\User\DeviceTypeEnums;
use App\Models\Subscription;
use App\Models\User;
use App\Models\UserSubscription;
use Tests\Feature\Concerns\TestingSubscription;

trait TestingUser {
	use TestingSubscription;
	public function createUser(string $mobile,string $password, string $device_type) {
		return User::factory()
					->setDeviceType($device_type)
					->setMobile($mobile)
					->setPassword($password)
					->create();
	}
	
	public function createUserWithSubscription(string $mobile,string $password, string $device_type,int $day) {
		$user = $this->createUser($mobile,$password,$device_type);
		$subscription = $this->createSubscription($day);
		UserSubscription::factory()
			->setUser($user->id)
			->setSubscription($subscription->id)
			->setEndAt($day)
			->create();
		
		return [$user,$subscription];
	}
	
	
	
	
	
}