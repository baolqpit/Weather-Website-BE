<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\WeatherController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('send-otp', [UserController::class, 'sendMailToUser']);
Route::post('verify-otp', [UserController::class, 'verifyOTP']);

Route::post('store-weather-current', [WeatherController::class, 'store']);
Route::get('show-weather-list', [WeatherController::class, 'show']);