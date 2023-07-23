<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\SubscriptionController;
use App\Http\Controllers\API\UserSubscriptionController;
use Illuminate\Support\Facades\Route;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);


Route::group(['middleware' => 'auth:sanctum'], function () {
//    Route::get('user',[UserController::class,'userDetails']);
    Route::get('logout', [AuthController::class, 'logout']);

    Route::resource('subscription', SubscriptionController::class);
    Route::post('user-subscription', [UserSubscriptionController::class, 'createOrUpdate']);
    Route::delete('user-subscription/{userSubscriptionId}', [UserSubscriptionController::class, 'destroy']);
});
