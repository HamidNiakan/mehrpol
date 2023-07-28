<?php

namespace Database\Factories;

use App\Models\Subscription;
use App\Models\User;
use App\Models\UserSubscription;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserSubscription>
 */
class UserSubscriptionFactory extends Factory
{
	protected $model = UserSubscription::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
			'started_at' => Carbon::now()
        ];
    }
	
	
	public function setUser(int $userId): static {
		return  $this->state(fn() => [
			'user_id' => $userId
		]);
	}
	
	public function setSubscription(int $id) :static {
		return  $this->state(fn() => [
			'subscription_id' => $id
		]);
	}
	
	public function setEndAt(int $day) {
		return $this->state(fn() => [
			'end_at' => Carbon::now()->addDays($day)
		]);
	}
}
