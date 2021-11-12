<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\TripController;

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

Route::post('users', [RegisterController::class, 'store']);
Route::post('session', [LoginController::class, 'login'])->name('login');
//bus crud
Route::middleware('auth:api')->post('buses', [BusController::class, 'store']);
Route::middleware('auth:api')->put('buses/{bus}', [BusController::class, 'update']);
Route::middleware('auth:api')->delete('buses/{bus}', [BusController::class, 'destroy']);

Route::middleware('auth:api')->post('trips', [TripController::class, 'create']);
Route::middleware('auth:api')->put('trips/{trip}', [TripController::class, 'update']);

