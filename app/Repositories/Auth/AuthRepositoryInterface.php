<?php

namespace App\Repositories\Auth;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

interface AuthRepositoryInterface {
	
	public function signUp(array $data):User;
	
	public function signIn(array $credentials): int|Model;
	
	public function getUser();
}