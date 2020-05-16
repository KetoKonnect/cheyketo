<?php

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


Route::get('/', 'HomeController@landing')->name('storefront');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/myorders', 'HomeController@userOrders')->name('user.orders');

//admin routes
Route::prefix('/admin')->group(function () {
    Route::get('login', 'AdminController@showlogin')->name('admin.login');
    Route::post('login', 'AdminController@login');
    Route::get('home', 'AdminController@index')->name('admin.home');
    Route::get('product/create', 'ProductController@create')->name('admin.product.create');
    Route::post('product/store', 'ProductController@store')->name('admin.product.store');
});

Route::get('/cart', 'CartController@index')->name('cart.view');
Route::post('/cart/add/{product}', 'CartController@update')->name('cart.add');
Route::post('/cart/remove/{index}', 'CartController@destroy')->name('cart.remove');
Route::post('/cart/addOne/{index}', 'CartController@addOne')->name('cart.addOne');
Route::post('/cart/removeOne/{index}', 'CartController@removeOne')->name('cart.removeOne');

Route::get('/checkout', 'CartController@showCheckout')->name('checkout');
Route::post('/checkout', 'CartController@checkout')->name('create_order');
Route::post('/createAddress', 'HomeController@createAddress')->name('address.create');
