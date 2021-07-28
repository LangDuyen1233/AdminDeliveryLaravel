<?php

use App\Http\Controllers\API\AdminDelivery\AdminDiscountController;
use App\Http\Controllers\API\AdminDelivery\AdminMaterialsController;
use App\Http\Controllers\API\AdminDelivery\AdminOrderController;
use App\Http\Controllers\API\AdminDelivery\AdminStaffController;
use App\Http\Controllers\API\AdminDelivery\CategoryController;
use App\Http\Controllers\API\AdminDelivery\FoodController;
use App\Http\Controllers\API\AdminDelivery\ReviewController;
use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\UploadImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AppDelivery\SliderController;
use App\Http\Controllers\API\AppDelivery\HomeComtroller;
use App\Http\Controllers\API\AppDelivery\AddressController;
use App\Http\Controllers\API\AppDelivery\ProfileController;
use App\Http\Controllers\API\AppDelivery\RestaurantController;

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
    Route::get('/listrestaurants', [HomeComtroller::class, 'getRestaurant']);
    Route::get('/listaddress', [AddressController::class, 'getAddress']);

    //restaurant
    Route::get('/listrestaurant', [RestaurantController::class, 'getRestaurant']);
    Route::get('/listfood', [RestaurantController::class, 'getFood']);

    Route::post('/addcardorder', [RestaurantController::class, 'addCardOrder']);
    Route::get('/getcard', [RestaurantController::class, 'getCard']);

    Route::post('/logout', [AuthController::class, 'logout']);

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

    //admin review
    Route::get('/getReview', [ReviewController::class, 'getReview']);

    //admin order
    Route::get('/getNewCard', [AdminOrderController::class, 'getNewCard']);

    //admin staff
    Route::get('/getStaff', [AdminStaffController::class, 'getStaff']);
    Route::post('/addStaff', [AdminStaffController::class, 'addStaff']);
    Route::get('/editStaff', [AdminStaffController::class, 'editStaff']);
    Route::post('/updateStaff', [AdminStaffController::class, 'updateStaff']);
    Route::post('/deleteStaff', [AdminStaffController::class, 'deleteStaff']);

    //admin materials
    Route::get('/getMaterials', [AdminMaterialsController::class, 'getMaterials']);
    Route::post('/addMaterials', [AdminMaterialsController::class, 'addMaterials']);
    Route::get('/editMaterials', [AdminMaterialsController::class, 'editMaterials']);
    Route::post('/updateMaterials', [AdminMaterialsController::class, 'updateMaterials']);
    Route::post('/deleteMaterials', [AdminMaterialsController::class, 'deleteMaterials']);

    //admin discount
    Route::get('/getDiscount', [AdminDiscountController::class, 'getDiscount']);
    Route::post('/addDiscount', [AdminDiscountController::class, 'addDiscount']);
    Route::get('/editDiscount', [AdminDiscountController::class, 'editDiscount']);
    Route::post('/updateDiscount', [AdminDiscountController::class, 'updateDiscount']);
    Route::post('/deleteDiscount', [AdminDiscountController::class, 'deleteDiscount']);

    //admin profile
    Route::post('/changeName', [ProfileController::class, 'changeName']);
    Route::post('/changeDob', [ProfileController::class, 'changeDob']);
    Route::post('/changeGender', [ProfileController::class, 'changeGender']);
    Route::post('/changeAvatar', [ProfileController::class, 'changeAvatar']);
});

Route::post('/uploadImage  ', [UploadImage::class, 'uploadImage']);
Route::post('/uploadAvatar  ', [UploadImage::class, 'uploadAvatar']);
