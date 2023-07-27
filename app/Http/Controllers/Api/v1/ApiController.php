<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\UserResource;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use function App\Helper\printResult;

class ApiController extends Controller
{
	
	public function __construct (public UserRepositoryInterface $repository) { }
	
	public function getUsersSubscriptions() {
		$users = $this->repository->getSubscriptions();
		
		$users = UserResource::collection($users);
		return printResult($users);
		
		
	}
}
