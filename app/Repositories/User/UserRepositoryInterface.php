<?php

namespace App\Repositories\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface {
	
	public function getSubscriptions():Collection;
}