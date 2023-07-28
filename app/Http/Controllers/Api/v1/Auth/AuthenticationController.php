<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Enums\User\DeviceTypeEnums;
use App\Events\AssigningSubscriptionToUserAndroidEvent;
use App\Events\AssigningSubscriptionToUserIosEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Auth\SignInRequest;
use App\Http\Requests\Api\v1\Auth\SignUpRequest;
use App\Http\Resources\v1\UserResource;
use App\Listeners\AssigningSubscriptionToUserIosListener;
use App\Models\User;
use App\Repositories\Auth\AuthRepository;
use App\Repositories\Auth\AuthRepositoryInterface;
use Illuminate\Http\Request;
use function App\Helper\printResult;

class AuthenticationController extends Controller
{
	
	public function __construct (public AuthRepositoryInterface $repository) { }
	
	public function signUp(SignUpRequest $request) {
		
		$user = $this->repository->signUp($request->toArray());
		if ($user->device_type == DeviceTypeEnums::Android) {
			event(new AssigningSubscriptionToUserAndroidEvent($user));
		} else {
			event(new AssigningSubscriptionToUserIosEvent($user));
		}
		$data = [
			'user' => UserResource::make($user->load('subscriptions')) ,
			'token' => $this->generateApiToken($user)
		];
		return printResult($data);
		
	}
	
	
	public function signIn(SignInRequest $request) {
		$response = $this->repository->signIn($request->toArray());
		
		if (is_numeric($response) && $response == AuthRepository::STATUS_CODE_UNAUTHENTICATED) {
			$message = __('auth.These credentials do not match our records');
			return printResult([],$message,401);
		}
		$data = [
			'user' => UserResource::make($response->load('subscriptions')) ,
			'token' => $this->generateApiToken($response)
		];
		return printResult($data);
		
	}
	
	
	public function getUser(Request $request) {
		
		$user = UserResource::make($request->user()->load('subscriptions'));
		return printResult(['user' =>$user]);
	}
	
	
	protected function generateApiToken(User $user): string {
		return $user->createToken(config('variables.api_token_key'))->plainTextToken;
	}
}
