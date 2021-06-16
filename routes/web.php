<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

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

Route::get('/', function () {
    return view('welcome');
});
//auth
Route::get('login', "Auth\LoginController@getLogin")->name('login');
Route::post('login', "Auth\LoginController@doLogin");

Route::get('register', "AuthController@getRegister")->name('register');
//Route::get('login', function (){
//    return view(('auth.login'));
//});
Route::get('profile', "AuthController@getProfile")->name('profile');
//end auth

//page
Route::get('index', function () {
    return view('layouts.master');
});
Route::get('home', function () {
    return view('pages.home');
})->name('home');

Route::get('user', function () {
    return view('pages.users');
})->name('user');

Route::get('addUser', function () {
    return view('pages.addUser');
})->name('addUser');

Route::get('editUser', function () {
    return view('pages.edit');
})->name('editUser');

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
