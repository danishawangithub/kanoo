<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\TransactionController;
use App\Http\Controllers\API\Store\GiftkardController;
use App\Http\Controllers\API\Store\ProductController;
use App\Http\Controllers\API\Store\CategoryController;
use App\Http\Controllers\API\Store\TagController;
use App\Http\Controllers\API\Store\AttributeController;
use App\Http\Controllers\API\FundController;
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

//Store Modules Routes start from here
Route::controller(GiftkardController::class)->prefix("store/giftkards")->group(function () {
    Route::get('index', 'index'); 
    Route::post('store', 'store');  
    Route::get('view/{id}', 'show');
    Route::get('edit/{id}', 'edit');    
    Route::get('delete/{id}', 'destroy');  
    Route::post('update/{id}', 'update');  
});

Route::controller(ProductController::class)->prefix("store/products")->group(function () {
    Route::get('index', 'index'); 
    Route::post('store', 'store');  
    Route::get('view/{id}', 'show');  
    Route::get('edit/{id}', 'edit');  
    Route::get('delete/{id}', 'destroy');  
    Route::post('update/{id}', 'update');  
});

Route::controller(CategoryController::class)->prefix("store/categories")->group(function () {
    Route::get('index', 'index'); 
    Route::post('store', 'store');  
    Route::get('view/{id}', 'show');  
    Route::get('edit/{id}', 'edit');  
    Route::get('delete/{id}', 'destroy');  
    Route::post('update/{id}', 'update'); 
});

Route::controller(TagController::class)->prefix("store/tags")->group(function () {
    Route::get('index', 'index'); 
    Route::post('store', 'store');  
    Route::get('view/{id}', 'show');  
    Route::get('edit/{id}', 'edit');  
    Route::get('delete/{id}', 'destroy');  
    Route::post('update/{id}', 'update'); 
});


Route::controller(AttributeController::class)->prefix("store/attributes")->group(function () {
    Route::get('index', 'index'); 
    Route::post('store', 'store');  
    Route::get('view/{id}', 'show');  
    Route::get('edit/{id}', 'edit');  
    Route::get('delete/{id}', 'destroy');  
    Route::post('update/{id}', 'update'); 
});
//Store Modulue routes ends here.

Route::controller(FundController::class)->prefix("funds")->group(function () {
    Route::get('index', 'index'); 
    Route::post('store', 'store');  
    Route::get('view/{id}', 'show');  
    Route::get('edit/{id}', 'edit');  
    Route::get('delete/{id}', 'destroy');  
    Route::post('update/{id}', 'update'); 
});