<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

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

Route::get('/getSmsBalance', [Controllers\SmsController::class, 'getBalance']);

Route::get('/allSms', [Controllers\SmsController::class, 'fetchAllSms']);

Route::post('/sendSingleSms', [Controllers\SmsController::class, 'sendSingleSms']);

Route::post('/sendBulkSms', [Controllers\SmsController::class, 'sendBulkSms']);

Route::get('/getSmsBalance', [Controllers\SmsController::class, 'getSmsBalance']);


