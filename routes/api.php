<?php

use App\Http\Controllers\API\AdminDelivery\AdminDiscountController;
use App\Http\Controllers\API\AdminDelivery\AdminMaterialsController;
use App\Http\Controllers\API\AdminDelivery\AdminOrderController;
use App\Http\Controllers\API\AdminDelivery\AdminRestaurantController;
use App\Http\Controllers\API\AdminDelivery\AdminStaffController;
use App\Http\Controllers\API\AdminDelivery\CategoryController;
use App\Http\Controllers\API\AdminDelivery\FoodController;
use App\Http\Controllers\API\AdminDelivery\PushNotificationController;
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
Route::post('/loginAndRegisterPhone', [AuthController::class, 'loginAndRegisterPhone']);
Route::post('/loginowner', [AuthController::class, 'loginOwner']);
Route::get('/confirmemail/{email}/{key}', [AuthController::class, 'confirmEmail'])->name('confirmemail');
Route::post('/checkUser', [AuthController::class, 'checkUser']);
Route::post('/loginPhone', [AuthController::class, 'loginPhone']);
Route::post('/updateUid', [AuthController::class, 'updateUid']);

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/sliders', [SliderController::class, 'getSliders']);
    Route::get('/listfood', [HomeComtroller::class, 'getFood']);
    Route::get('/getuser', [ProfileController::class, 'getUsers']);
    Route::get('/listrestaurants', [HomeComtroller::class, 'getRestaurant']);

    //address
    Route::get('/listaddress', [AddressController::class, 'getAddress']);
    Route::get('/address', [AddressController::class, 'getAddressUser']);
    Route::post('/addAddress', [AddressController::class, 'addAddress']);
    Route::post('/updateAddress', [AddressController::class, 'updateAddress']);
    Route::post('/deleteAddress', [AddressController::class, 'deleteAddress']);
    Route::post('/updateLocation', [AddressController::class, 'updateLocation']);
    Route::get('/getAddressFromId', [AddressController::class, 'getAddressFromId']);

    //restaurant
    Route::get('/listrestaurant', [RestaurantController::class, 'getRestaurant']);
    Route::get('/listfood', [RestaurantController::class, 'getFood']);

    //discount
    Route::get('/listdiscount', [DiscountController::class, 'getDiscount']);

    // card and order
    Route::post('/addorder', [OrderController::class, 'addOrder']);
    Route::get('/getcardorder', [RestaurantController::class, 'getFoodCard']);
    Route::post('/addcardorder', [RestaurantController::class, 'addCardOrder']);
    Route::get('/getcard', [RestaurantController::class, 'getCard']);


    Route::get('/getOrder', [OrderController::class, 'getOrder']);
    Route::get('/getHistory', [OrderController::class, 'getHistory']);
    Route::get('/getdraftOrder', [OrderController::class, 'getdraftOrder']);
    Route::post('/deleteDraftOrder', [OrderController::class, 'deleteDraftOrder']);

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
    Route::post('/cancelOrder', [AdminOrderController::class, 'cancelOrder']);
    Route::post('/prepareOrder', [AdminOrderController::class, 'prepareOrder']);
    //
    Route::get('/getPrepareCard', [AdminOrderController::class, 'getPrepareCard']);
    Route::post('/deliveryByRestaurant', [AdminOrderController::class, 'deliveryByRestaurant']);
    Route::post('/deliveryByUser', [AdminOrderController::class, 'deliveryByUser']);

    Route::get('/getDeliveringCard', [AdminOrderController::class, 'getDeliveringCard']);
    Route::post('/delivered', [AdminOrderController::class, 'delivered']);

    Route::get('/getDeliveredCard', [AdminOrderController::class, 'getDeliveredCard']);

    Route::get('/getHistoryCard', [AdminOrderController::class, 'getHistoryCard']);

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
    Route::post('/addDiscountVoucher', [AdminDiscountController::class, 'addDiscountVoucher']);
    Route::get('/editDiscountVoucher', [AdminDiscountController::class, 'editDiscountVoucher']);
    Route::post('/updateDiscountVoucher', [AdminDiscountController::class, 'updateDiscountVoucher']);
    Route::post('/deleteDiscountVoucher', [AdminDiscountController::class, 'deleteDiscountVoucher']);

    //admin profile
    Route::post('/changeName', [ProfileController::class, 'changeName']);
    Route::post('/changeDob', [ProfileController::class, 'changeDob']);
    Route::post('/changeGender', [ProfileController::class, 'changeGender']);
    Route::post('/changeAvatar', [ProfileController::class, 'changeAvatar']);

    //admin restaurant
    Route::get('/getRestaurant', [AdminRestaurantController::class, 'getRestaurant']);
    Route::post('/changeImageRestaurant', [AdminRestaurantController::class, 'changeImageRestaurant']);

    //notify
    Route::get('/getNotify',[PushNotificationController::class,'getNotify']);

});

Route::post('/uploadImage  ', [UploadImage::class, 'uploadImage']);
Route::post('/uploadAvatar  ', [UploadImage::class, 'uploadAvatar']);


Route::post('send-notification', [App\Http\Controllers\NotificationController::class, 'send']);

