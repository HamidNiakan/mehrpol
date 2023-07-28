<?php

namespace Database\Factories;

use App\Models\Subscription;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscription>
 */
class SubscriptionFactory extends Factory
{
	
	protected $model = Subscription::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
			'title' => $this->faker->sentence(),
        ];
    }
	public function withNumberOfDays (int $day):static {
		return $this->state(fn() => [
			'day' => $day
		]);
	}
}
