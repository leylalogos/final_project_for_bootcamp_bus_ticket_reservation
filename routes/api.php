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
use App\Http\Controllers\PaymentController;

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
Route::middleware('auth:api')->group(function () {
    Route::post('buses', [BusController::class, 'store']);
    Route::put('buses/{bus}', [BusController::class, 'update']);
    Route::delete('buses/{bus}', [BusController::class, 'destroy']);

    Route::post('trips', [TripController::class, 'create']);
    Route::put('trips/{trip}', [TripController::class, 'update']);

    Route::post('cities', [CityController::class, 'create']);

    Route::post('comments', [CommentController::class, 'create']);

    Route::post('/trips/{trip}/seats', [ResevationController::class, 'create'])
        ->middleware('removeTempReserve');
    Route::get('/trips/{trip}/receipt', [ResevationController::class, 'showReceipt'])
        ->middleware('removeTempReserve');

    Route::get('/trips/{trip}/payment/start',[PaymentController::class,'pay']);
    Route::get('/trips/{trip}/payment/verify',[PaymentController::class,'verify'])->name('payment.verify');

});

Route::get('buses', [BusController::class, 'index']);
Route::get('trips', [TripController::class, 'index']);
Route::get('companies', [CompanyController::class, 'index']);
Route::get('cities', [CityController::class, 'index']);
Route::get('comments', [CommentController::class, 'index']);
//show seats for a trip
Route::get('/trips/{trip}/seats', [ResevationController::class, 'index'])
    ->middleware('removeTempReserve');

Route::middleware('auth:api')->get('profile', function () {
    return auth()->user();
});
