<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Auth\SignInRequest;
use App\Http\Requests\Api\v1\Auth\SignUpRequest;
use App\Http\Resources\v1\AuthResource;
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
		$data = [
			'user' => AuthResource::make($user),
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
			'user' => AuthResource::make($response),
			'token' => $this->generateApiToken($response)
		];
		return printResult($data);
		
	}
	
	
	public function getUser(Request $request) {
		
		$user = AuthResource::make($request->user());
		return printResult($user);
	}
	
	
	protected function generateApiToken(User $user): string {
		return $user->createToken(config('variables.api_token_key'))->plainTextToken;
	}
}
