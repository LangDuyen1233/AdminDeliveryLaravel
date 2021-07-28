<?php

use App\Http\Controllers\API\AdminDelivery\CategoryController;
use App\Http\Controllers\API\AdminDelivery\FoodController;
use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\UploadImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AppDelivery\SliderController;
use App\Http\Controllers\API\AppDelivery\HomeComtroller;
use App\Http\Controllers\API\AppDelivery\AddressController;
use App\Http\Controllers\API\AppDelivery\ProfileController;
use App\Http\Controllers\API\AppDelivery\RestaurantController;
use App\Http\Controllers\API\AppDelivery\DiscountController;
use App\Http\Controllers\API\AppDelivery\OrderController;

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
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/sliders', [SliderController::class, 'getSliders']);
    Route::get('/listfood', [HomeComtroller::class, 'getFood']);
    Route::get('/getuser', [ProfileController::class, 'getUsers']);
    Route::get('/listrestaurants', [HomeComtroller::class, 'getRestaurant']);
    Route::get('/listaddress', [AddressController::class, 'getAddress']);
    Route::get('/address', [AddressController::class, 'getAddressUser']);

    //restaurant
    Route::get('/listrestaurant', [RestaurantController::class, 'getRestaurant']);
    Route::get('/listfood', [RestaurantController::class, 'getFood']);

    Route::post('/addcardorder', [RestaurantController::class, 'addCardOrder']);
    Route::get('/getcard', [RestaurantController::class, 'getCard']);

    Route::get('/getcardorder', [RestaurantController::class, 'getFoodCard']);

    Route::get('/listdiscount', [DiscountController::class, 'getDiscount']);

    Route::post('/addorder', [OrderController::class, 'addOrder']);

    //admin
    Route::get('/getCategory', [CategoryController::class, 'getCategory']);
    Route::post('/addCategory', [CategoryController::class, 'addCategory']);

    //admin food
    Route::get('/getFood', [FoodController::class, 'getFood']);
    Route::post('/addFood', [FoodController::class, 'addFood']);
    Route::get('/editFood', [FoodController::class, 'editFood']);
    Route::post('/updateFood', [FoodController::class, 'updateFood']);
    Route::post('/deleteFood', [FoodController::class, 'deleteFood']);

    //admin topping
    Route::get('/getTopping', [FoodController::class, 'getTopping']);
    Route::post('/addTopping', [FoodController::class, 'addTopping']);
    Route::get('/editTopping', [FoodController::class, 'editTopping']);
    Route::post('/updateTopping', [FoodController::class, 'updateTopping']);
    Route::post('/deleteTopping', [FoodController::class, 'deleteTopping']);
});

Route::post('/uploadImage  ', [UploadImage::class, 'uploadImage']);
