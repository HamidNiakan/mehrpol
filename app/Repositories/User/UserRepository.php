<?php

namespace App\Repositories\User;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface {
	public function getSubscriptions (): Collection {
		return $this->getQuery()
			->latest()
			->with([
				'subscriptions',
				'subscriptions.subscription',
				   ])
			->get();
	}
	
	protected function getQuery() {
		return User::query();
	}
}