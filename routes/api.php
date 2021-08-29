<?php

use App\Http\Controllers\API\AdminDelivery\AdminDiscountController;
use App\Http\Controllers\API\AdminDelivery\AdminMaterialsController;
use App\Http\Controllers\API\AdminDelivery\AdminOrderController;
use App\Http\Controllers\API\AdminDelivery\AdminRestaurantController;
use App\Http\Controllers\API\AdminDelivery\AdminStaffController;
use App\Http\Controllers\API\AdminDelivery\AdminStatisticController;
use App\Http\Controllers\API\AdminDelivery\CategoryController;
use App\Http\Controllers\API\AdminDelivery\FoodController;
use App\Http\Controllers\API\AdminDelivery\PushNotificationController;
use App\Http\Controllers\API\AdminDelivery\ReviewController;
use App\Http\Controllers\API\AppDelivery\DeliveryController;
use App\Http\Controllers\API\AppDelivery\ReviewsController;
use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\UploadImage;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AppDelivery\SliderController;
use App\Http\Controllers\API\AppDelivery\HomeComtroller;
use App\Http\Controllers\API\AppDelivery\AddressController;
use App\Http\Controllers\API\AppDelivery\ProfileController;
use App\Http\Controllers\API\AppDelivery\RestaurantController;
use App\Http\Controllers\API\AppDelivery\DiscountController;
use App\Http\Controllers\API\AppDelivery\OrderController;
use App\Http\Controllers\API\NotificationController;
use App\Http\Controllers\API\AppDelivery\SearchController;
use App\Http\Controllers\API\AdminDelivery\AdminAddressController;

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
Route::post('/sendNotification', [NotificationController::class, 'sendNotification']);

Route::middleware('auth:api')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    // home
    Route::get('/sliders', [SliderController::class, 'getSliders']);
    Route::get('/listfood', [HomeComtroller::class, 'getFood']);
    Route::get('/listrestaurants', [HomeComtroller::class, 'getRestaurant']);

    //profile
    Route::get('/getuser', [ProfileController::class, 'getUsers']);
    Route::post('/updateDelivery', [ProfileController::class, 'updateDelivery']);


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

    //search
    Route::get('/searchRestaurant', [SearchController::class, 'searchRestaurant']);
    Route::get('/searchFood', [SearchController::class, 'searchFood']);

    // card and order
    Route::post('/addorder', [OrderController::class, 'addOrder']);
    Route::get('/getcardorder', [RestaurantController::class, 'getFoodCard']);
    Route::post('/addcardorder', [RestaurantController::class, 'addCardOrder']);
    Route::get('/getcard', [RestaurantController::class, 'getCard']);
    Route::post('/deleteCard', [RestaurantController::class, 'deleteCard']);
    Route::post('/increaseQuantity', [RestaurantController::class, 'increaseQuantity']);
    Route::post('/decreaseQuantity', [RestaurantController::class, 'decreaseQuantity']);
    Route::get('/getOrder', [OrderController::class, 'getOrder']);
    Route::get('/getHistory', [OrderController::class, 'getHistory']);
    Route::get('/getdraftOrder', [OrderController::class, 'getdraftOrder']);
    Route::post('/deleteDraftOrder', [OrderController::class, 'deleteDraftOrder']);

    // notification
    Route::post('/saveNotification', [NotificationController::class, 'saveNotification']);
    Route::get('/getNotification', [NotificationController::class, 'getNotification']);

    //delivery
    Route::get('/getDelivery', [DeliveryController::class, 'getDelivery']);
    Route::get('/isDelivery', [DeliveryController::class, 'isDelivery']);
    Route::get('/historyDelivery', [DeliveryController::class, 'historyDelivery']);
    Route::post('/received', [DeliveryController::class, 'received']);
    Route::post('/changeDelivery', [DeliveryController::class, 'changeDelivery']);

    //review
    Route::post('/addReview', [ReviewsController::class, 'addReview']);
    Route::get('/reviewRestaurant', [ReviewsController::class, 'reviewRestaurant']);

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
    Route::get('/getDiscount', [AdminDiscountController::class, 'getDiscountVoucher']);
    Route::post('/addDiscountVoucher', [AdminDiscountController::class, 'addDiscountVoucher']);
    Route::get('/editDiscountVoucher', [AdminDiscountController::class, 'editDiscountVoucher']);
    Route::post('/updateDiscountVoucher', [AdminDiscountController::class, 'updateDiscountVoucher']);
    Route::post('/deleteDiscountVoucher', [AdminDiscountController::class, 'deleteDiscountVoucher']);

    Route::get('/getDiscountFood', [AdminDiscountController::class, 'getDiscountFood']);
    Route::post('/addDiscountFood', [AdminDiscountController::class, 'addDiscountFood']);
    Route::get('/editDiscountFood', [AdminDiscountController::class, 'editDiscountFood']);
    Route::post('/updateDiscountFood', [AdminDiscountController::class, 'updateDiscountFood']);
    Route::post('/deleteDiscountFood', [AdminDiscountController::class, 'deleteDiscountFood']);

    //admin profile and app delivery
    Route::post('/changeName', [ProfileController::class, 'changeName']);
    Route::post('/changeDob', [ProfileController::class, 'changeDob']);
    Route::post('/changeGender', [ProfileController::class, 'changeGender']);
    Route::post('/changeAvatar', [ProfileController::class, 'changeAvatar']);

    //admin restaurant
    Route::get('/getRestaurant', [AdminRestaurantController::class, 'getRestaurant']);
    Route::post('/changeImageRestaurant', [AdminRestaurantController::class, 'changeImageRestaurant']);

    //notify
    Route::get('/getNotify', [PushNotificationController::class, 'getNotify']);

    //admin statistic
    Route::get('/getSales', [AdminStatisticController::class, 'getSales']);
    Route::get('/getCancel', [AdminStatisticController::class, 'getCancel']);
    Route::get('/getSum', [AdminStatisticController::class, 'getSum']);
    Route::get('/getRevenue', [AdminStatisticController::class, 'getRevenue']);
    Route::get('/changeRevenue', [AdminStatisticController::class, 'changeRevenue']);

    Route::get('/getWarehouse', [AdminStatisticController::class, 'getWarehouse']);
    Route::get('/changeWarehouse', [AdminStatisticController::class, 'changeWarehouse']);

    //admin address
    Route::post('/updateAddressMap', [AdminAddressController::class, 'updateAddressMap']);


});

Route::post('/uploadImage  ', [UploadImage::class, 'uploadImage']);
Route::post('/uploadAvatar  ', [UploadImage::class, 'uploadAvatar']);


