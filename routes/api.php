<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\TransactionController;
use App\Http\Controllers\API\Store\GiftkardController;
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




Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
});


Route::controller(TransactionController::class)->prefix('transactions')->group(function () {
    Route::get('index', 'index');
});

Route::controller(GiftkardController::class)->prefix("giftkard")->group(function () {
    Route::get('index', 'index'); 
    Route::post('store', 'store');  
    Route::get('view/{id}', 'show');  
    Route::get('delete/{id}', 'destroy');  
    Route::post('update/{id}', 'update');  
});



