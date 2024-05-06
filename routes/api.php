<?php

use App\Http\Controllers\Api\ReferralController;
use App\Http\Controllers\Api\UserController;
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
Route::middleware('auth:sanctum')->get('/patient/{id}', [UserController::class, 'index']);
Route::middleware('auth:sanctum')->get('/referral/{card}/{id}', [ReferralController::class, 'index']);
Route::middleware('auth:sanctum')->get('/referral/{card}/referrid/{id}', [ReferralController::class, 'show']);

Route::get('/referral', [ReferralController::class, 'apirefer']);

Route::middleware('auth:sanctum')->get('/referral/change/{card}/date/{date}/appointment', [ReferralController::class, 'change']);
Route::middleware('auth:sanctum')->patch('/referral/change/{card}/date/{date}/appointment/update', [ReferralController::class, 'update']);


