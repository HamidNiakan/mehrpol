<?php

namespace Database\Seeders;

use App\Models\Subscription;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subscriptions = [
			[
				'id' => 1,
				'title' => 'یکماهه',
				'day' => 30
			],
			[
				'id' => 2,
				'title' => 'دوماهه',
				'day' => 60
			]
		];
		
		foreach ($subscriptions as $item) {
			Subscription::query()
				->updateOrCreate(['id' => $item['id']],$item);
		}
    }
}
