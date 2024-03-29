<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use \App\Http\Controllers\Admin\ClientController;
use \App\Http\Controllers\Admin\CourierController;
use \App\Http\Controllers\Admin\OrderController;
use \App\Http\Controllers\Fulfillment\StockController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['api'], 'prefix' => 'auth'], function($router){
    Route::get('user', [AuthController::class, 'user']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
});

Route::middleware('auth:api')->group(function() {
    Route::apiResource('clients', ClientController::class);
    Route::apiResource('couriers', CourierController::class);
    Route::apiResource('orders', OrderController::class);

    /* Роуты для фулфилмента */
    Route::apiResource('stock', StockController::class);
});



