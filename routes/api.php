<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\logs\LogController;
use App\Http\Controllers\Api\Subscription\SubscriptionController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('check-Login', [LogController::class, 'checkLogin']);

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [LoginController::class, 'Login']);
});


Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::group(['prefix' => 'subscriptions'], function () {

        Route::get('/', [SubscriptionController::class, 'index']);
    });
    Route::group(['prefix' => 'generator-subscriptions'], function () {

        Route::post('/store', [SubscriptionController::class, 'store']);
    });

    Route::group(['prefix' => 'generator-receipts'], function () {

        Route::post('/store', [SubscriptionController::class, 'storeGeneratorReceipt']);
    });

    Route::group(['prefix' => 'reading-generator'], function () {

        Route::post('/store', [SubscriptionController::class, 'storeGeneratorReceipt']);
    });
});
