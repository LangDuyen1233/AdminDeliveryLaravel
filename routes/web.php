<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Middleware\CheckLogin;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

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
Route::get('confirmforgotpass/{email}/{key}', [ForgotPasswordController::class, 'doConfirmPassword'])->name('doConfirmPassword');
Route::post('resetpass/{email}/{key}', [ForgotPasswordController::class, 'resetPass'])->name('resetpass');

Route::get('confirmforgotpassapp/{email}/{key}', [ForgotPasswordController::class, 'doConfirmPasswordApp'])->name('doConfirmPasswordApp');
Route::post('resetpassapp/{email}/{key}', [ForgotPasswordController::class, 'resetPassApp'])->name('resetpassapp');
Route::get('notifyApp', function () {
    return view('auth.notifyApp');
})->name('notifyApp');

Route::get('notify', function () {
    return view('auth.notify');
})->name('notify');

Route::get('register', "AuthController@getRegister")->name('register');

Route::get('logout', [LogoutController::class, 'doLogout'])->name('logout');

Route::get('policy.html', function () {
    return View('policy');
});


//auth
Route::middleware([CheckLogin::class])->group(function () {
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('updateProfile', [ProfileController::class, 'update'])->name('updateProfile');
    Route::get('changePass', [AuthController::class, 'index'])->name('changePass');
    Route::post('updatePass', [AuthController::class, 'update'])->name('updatePass');

    Route::get('home', [HomeController::class, 'index'])->name('home');

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

    Route::resource('admin-review', ReviewController::class)->only(['index', 'create', 'store', 'update', 'edit', 'destroy']);

    Route::resource('admin-topping', ToppingController::class)->only(['index', 'create', 'store', 'update', 'edit', 'destroy']);

    Route::resource('admin-statusOrder', OrderStatusController::class)->only(['index', 'create', 'store', 'update', 'edit', 'destroy']);

    Route::resource('admin-slides', SlidesController::class)->only(['index', 'create', 'store', 'update', 'edit', 'destroy']);

});
