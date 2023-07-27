<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\Auth\AuthenticationController;
use App\Http\Controllers\Api\v1\ApiController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(AuthenticationController::class)
	->group(function () {
		Route::post('signUp','signUp');
		Route::post('signIn','signIn');
		Route::middleware('auth:sanctum')->post('user','getUser');
	});
Route::controller(ApiController::class)
	->group(function () {
		Route::get('users/subscriptions','getUsersSubscriptions');
	});

