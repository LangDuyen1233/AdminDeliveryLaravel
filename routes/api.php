<?php

use App\Http\Controllers\API\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AppDelivery\SliderController;
use App\Http\Controllers\API\AppDelivery\HomeComtroller;
use App\Http\Controllers\API\AppDelivery\AddressController;
use App\Http\Controllers\API\AppDelivery\ProfileController;
use App\Http\Controllers\API\AppDelivery\RestaurantController;
use App\Http\Controllers\API\AppDelivery\UploadImage;

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
Route::get('/confirmemail/{email}/{key}', [AuthController::class, 'confirmEmail'])->name('confirmemail');

Route::middleware('auth:api')->group(function () {
    Route::get('/sliders', [SliderController::class, 'getSliders']);
    Route::get('/listfood', [HomeComtroller::class, 'getFood']);
    Route::get('/getuser', [ProfileController::class, 'getUsers']);
    Route::get('/listrestaurants', [HomeComtroller::class, 'getRestaurant']);
    Route::get('/listaddress', [AddressController::class, 'getAddress']);

    //restaurant
    Route::get('/listrestaurant', [RestaurantController::class, 'getRestaurant']);
    Route::get('/listfood', [RestaurantController::class, 'getFood']);

    Route::post('/addcardorder', [RestaurantController::class, 'addCardOrder']);
    Route::get('/getcard', [RestaurantController::class, 'getCard']);

    Route::post('/uploadImage', [UploadImage::class, 'upload']);

    Route::post('/logout', [AuthController::class, 'logout']);

});


