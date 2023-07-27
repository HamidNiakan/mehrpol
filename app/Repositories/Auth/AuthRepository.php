<?php

namespace App\Repositories\Auth;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class AuthRepository implements AuthRepositoryInterface {
	
	
	const STATUS_CODE_UNAUTHENTICATED = 401;
	public function signUp ( array $data ):User {
		$user = new User();
		$user->fill($data);
		$user->password = Hash::make($data['password']);
		$user->save();
		return $user;
		
	}
	
	public function signIn ( array $credentials ):Model|int {
		$user = User::query()
			->where('mobile',$credentials['mobile'])
			->first();
		
		if (!$user || !Hash::check($credentials['password'],$user->password)) {
			return self::STATUS_CODE_UNAUTHENTICATED;
		}
		
		return $user;
	}
	
	public function getUser () {
		// TODO: Implement getUser() method.
	}
}