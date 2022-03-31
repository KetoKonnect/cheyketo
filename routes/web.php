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
Route::get('/products/{category}', 'HomeController@ShopByCategory')->name('storeCategoryPage');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/myorders', 'HomeController@userOrders')->name('user.orders');
Route::get('/myorders/{order}', 'HomeController@viewOrder')->name('user.viewOrder');

//admin routes
Route::prefix('admin')->group(function () {
    Route::get('/', 'AdminController@index')->name('admin.home');
    Route::get('login', 'AdminController@showlogin')->name('admin.login');
    Route::post('login', 'AdminController@login');
    Route::get('home', 'AdminController@index')->middleware('auth.admin');
    // Category Routes
    Route::get('categories', 'CategoryController@index')->name('admin.categories.index'); // Show all categories to admin
    Route::get('category/create', 'CategoryController@create')->name('admin.category.create'); // Show a form to create a category
    Route::post('category/create', 'CategoryController@store')->name('admin.category.store'); // Save a newly created category
    Route::get('category/{category}/show', 'CategoryController@show')->name('admin.category.show'); // Show one category and a list of its products
    Route::get('category/{category}/edit', 'CategoryController@edit')->name('admin.category.edit'); // Edit a single category
    Route::post('category/{category}/update', 'CategoryController@update')->name('admin.category.update'); // Update a single category
    Route::post('category/{category}/destroy', 'CategoryController@destroy')->name('admin.category.destroy'); // Destroy a specific category
    Route::patch('category/add_product/{category}/{product}', 'CategoryController@addProduct')->name('admin.category.addProduct'); // Add a product to a specified category using PATCH method
    Route::patch('category/remove_product/{category}/{product}', 'CategoryController@removeProduct')->name('admin.category.removeProduct'); // Remove a product from a specified category using a PATCH method

    Route::get('products', 'AdminController@allProducts')->middleware('auth.admin')->name('admin.allProducts');
    Route::get('products/create', 'ProductController@create')->middleware('auth.admin')->name('admin.product.create');
    Route::post('products/create', 'ProductController@store')->middleware('auth.admin')->name('admin.product.store');
    Route::get('products/{product}', 'AdminController@getProduct')->middleware('auth.admin')->name('admin.viewProduct');
    Route::get('products/{product}/edit', 'AdminController@editProduct')->middleware('auth.admin')->name('admin.products.edit');
    Route::post('products/{product}/edit', 'AdminController@updateProduct')->middleware('auth.admin')->name('admin.product.update');
    Route::get('products/{product}/unavailable', 'AdminController@unavailable')->middleware('auth.admin')->name('admin.products.unavailable');
    Route::get('products/{product}/available', 'AdminController@available')->middleware('auth.admin')->name('admin.products.available');
    Route::get('products/{product}/delete', 'AdminController@delete')->middleware('auth.admin')->name('admin.product.delete');
    Route::get('products/{product}/update_thumbnail', 'AdminController@updateProductThumbnail')->middleware('auth.admin')->name('admin.product.updateImage');
    Route::post('products/{product}/save_thumbnail', 'AdminController@storeThumbnail')->middleware('auth.admin')->name('admin.product.storeThumbnail');

    Route::get('orders/{order}', 'AdminController@viewOrder')->middleware('auth.admin')->name('admin.viewOrder');
    Route::get('orders', 'AdminController@allOrders')->middleware('auth.admin')->name('admin.allOrders');
    Route::get('orders/{order}/update_status', 'AdminController@updateOrderStatus')->middleware('auth.admin')->name('admin.updateOrderStatus');

    Route::get('/api/products', 'ApiController@apiAllProducts')->middleware('auth.admin');
    Route::get('/api/products/{product}', 'AdminController@apiViewProduct')->middleware('auth.admin');
    Route::get('/api/orders', 'AdminController@apiAllOrders')->middleware('auth.admin');
    Route::get('/api/orders/{order}', 'AdminController@apiViewOrder')->middleware(('auth.admin'));

    Route::get('/api/orders/{order}/update_status', 'ApiController@updateOrderStatus')->middleware('auth.admin');
    Route::get('/api/products/{product}/delete', 'ApiController@deleteProduct')->middleware('auth.admin');
});

Route::get('/cart', 'CartController@index')->name('cart.view');
Route::post('/cart/add/{product}', 'CartController@update')->name('cart.add');
Route::post('/cart/remove/{index}', 'CartController@destroy')->name('cart.remove');
Route::post('/cart/addOne/{index}', 'CartController@addOne')->name('cart.addOne');
Route::post('/cart/removeOne/{index}', 'CartController@removeOne')->name('cart.removeOne');

Route::get('/checkout', 'CartController@showCheckout')->name('checkout');
Route::post('/checkout', 'CartController@checkout')->name('create_order');
Route::post('/createAddress', 'HomeController@createAddress')->name('address.create');
Route::post('/{user}/updateAddress', 'HomeController@updateAddress')->name('address.update');
