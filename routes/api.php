<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ResevationController;

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

//auth route
Route::post('users', [RegisterController::class, 'store']);
Route::post('session', [LoginController::class, 'login'])->name('login');
//bus crud route
Route::middleware('auth:api')->post('buses', [BusController::class, 'store']);
Route::middleware('auth:api')->put('buses/{bus}', [BusController::class, 'update']);
Route::middleware('auth:api')->delete('buses/{bus}', [BusController::class, 'destroy']);
Route::get('buses', [BusController::class, 'index']);
//trip crud route
Route::middleware('auth:api')->post('trips', [TripController::class, 'create']);
Route::middleware('auth:api')->put('trips/{trip}', [TripController::class, 'update']);
Route::get('trips', [TripController::class, 'index']);
//company user route
Route::get('companies', [CompanyController::class, 'index']);
//city route
Route::middleware('auth:api')->post('cities', [CityController::class, 'create']);
Route::get('cities', [CityController::class, 'index']);

Route::middleware('auth:api')->get('profile', function () {
    return auth()->user();
});
//comments route
Route::get('comments', [CommentController::class, 'index']);
Route::middleware('auth:api')->post('comments', [CommentController::class, 'create']);

Route::middleware('removeTempReserve')->get('/trips/{trip}/seats', [ResevationController::class, 'index']);
Route::middleware(['auth:api', 'removeTempReserve'])->post('/trips/{trip}/seats', [ResevationController::class, 'create']);
