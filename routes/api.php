<?php

use App\Http\Controllers\API\AdminDelivery\CategoryController;
use App\Http\Controllers\API\AdminDelivery\FoodController;
use App\Http\Controllers\API\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AppDelivery\SliderController;
use App\Http\Controllers\API\AppDelivery\HomeComtroller;
use App\Http\Controllers\API\AppDelivery\AddressController;
use App\Http\Controllers\API\AppDelivery\ProfileController;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/registerSocial', [AuthController::class, 'registerSocial']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/loginowner', [AuthController::class, 'loginOwner']);
Route::get('/confirmemail/{email}/{key}', [AuthController::class, 'confirmEmail'])->name('confirmemail');

Route::middleware('auth:api')->group(function () {
    Route::get('/sliders', [SliderController::class, 'getSliders']);
    Route::get('/listfood', [HomeComtroller::class, 'getFood']);
    Route::get('/getuser', [ProfileController::class, 'getUsers']);
    Route::get('/listrestaurant', [HomeComtroller::class, 'getRestaurant']);
    Route::get('/listaddress', [AddressController::class, 'getAddress']);
    Route::post('/logout', [AuthController::class, 'logout']);

    //admin
    Route::get('/getCategory', [CategoryController::class, 'getCategory']);
    Route::post('/addCategory', [CategoryController::class, 'addCategory']);

    //admin food
    Route::get('/getFood', [FoodController::class, 'getFood']);
    Route::post('/addFood', [FoodController::class, 'addFood']);
    Route::get('/editFood', [FoodController::class, 'editFood']);

    //admin topping
    Route::get('/getTopping', [FoodController::class, 'getTopping']);
    Route::post('/addTopping', [FoodController::class, 'addTopping']);

});


