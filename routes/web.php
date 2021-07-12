<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Middleware\CheckLogin;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [LoginController::class, 'getLogin']
)->name('login');
Route::post('login', [LoginController::class, 'doLogin'])->name('login');

Route::get('forgotpass', [ForgotPasswordController::class, 'forgotPass'])->name('forgotpass');
Route::post('forgotpass', [ForgotPasswordController::class, 'doForgotPass'])->name('forgotpass');
Route::get('confirmforgotpass/{email}/{key}', [ForgotPasswordController::class, 'doConfirmPassword'])->name('doconfirmpass');
Route::post('resetpass/{email}/{key}', [ForgotPasswordController::class, 'resetPass'])->name('resetpass');

Route::get('register', "AuthController@getRegister")->name('register');
Route::get('profile', [AuthController::class, 'getProfile'])->name('profile');

Route::get('logout', [LogoutController::class, 'doLogout'])->name('logout');

//auth
Route::middleware([CheckLogin::class])->group(function () {
    Route::get('home', function () {
        return view('pages.home');
    })->name('home');

//admin user
    Route::resource('admin-user', UserController::class)->only(['index', 'create', 'store', 'update', 'edit', 'destroy']);

    Route::post('/admin-user/import', [UserController::class, 'import'])->name('admin-user.import');
//admin restaurant
    Route::resource('admin-restaurant', RestaurantController::class)->only(['index', 'create', 'store', 'update', 'edit', 'destroy']);
//admin category
    Route::resource('admin-category', CategoryController::class)->only(['index', 'create', 'store', 'update', 'edit', 'destroy']);

    Route::resource('admin-food', FoodController::class)->only(['index', 'create', 'store', 'update', 'edit', 'destroy']);

    Route::resource('admin-order', OrderController::class)->only(['index', 'show', 'update', 'edit', 'destroy']);

    Route::resource('admin-discount', DiscountController::class)->only(['index', 'create', 'store', 'update', 'edit', 'destroy']);

    Route::resource('admin-review', ReviewController::class)->only(['index', 'update', 'edit', 'destroy']);

    Route::resource('admin-topping', ToppingController::class)->only(['index', 'create', 'store', 'update', 'edit', 'destroy']);

    Route::resource('admin-statusOrder', OrderStatusController::class)->only(['index']);

});
//Route::get('addUser', function () {
//    return view('user.addUser');
//})->name('addUser'
//
//Route::get('editUser', function () {
//    return view('pages.edit');
//})->name('editUser');

//page

Route::get('index', function () {
    return view('layouts.master');
});


//Route::get('user', function () {
//    return view('pages.user');
//})->name('user');


Route::get('orders', function () {
    return view('pages.orders');
})->name('orders');

Route::get('sales', function () {
    return view('pages.sales');
})->name('sales');

Route::get('listMenu', function () {
    return view('pages.listMenu');
})->name('listMenu');
Route::get('addMenu', function () {
    return view('pages.addMenu');
})->name('addMenu');

Route::get('feedback', function () {
    return view('pages.feedback');
})->name('feedback');
//end page
