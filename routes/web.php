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

Route::get('/', 'App\Http\Controllers\Blogs\BlogController@index');
Route::get('/home', [App\Http\Controllers\Blogs\BlogController::class, 'dashboard'])->name('home');
Auth::routes();
Route::get('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');

Route::group(['middleware' => 'auth', 'prefix' => 'blog', 'namespace' => 'App\Http\Controllers\Blogs'], function () {
    Route::get('/create', 'BlogController@create')->name('create-blog');
    Route::post('/save', 'BlogController@save')->name('save-blog');
    Route::get('/list', 'BlogController@list')->name('blog-list');
    Route::get('/view/{id}', 'BlogController@view')->name('view-blog');
    Route::get('/edit/{id}', 'BlogController@edit')->name('edit-blog');
    Route::put('/update/{id}', 'BlogController@update')->name('update-blog');
    Route::get('/blog/{id}', 'BlogController@destroy')->name('delete-blog');
    Route::get('/search', 'BlogController@search')->name('search-blog');
});

Route::group(['middleware' => 'auth', 'prefix' => 'food', 'namespace' => 'App\Http\Controllers\Foods'], function () {
    Route::get('/create', 'FoodController@create')->name('create-food');
    Route::post('/save', 'FoodController@save')->name('save-food');
    Route::get('/list', 'FoodController@list')->name('food-list');
    Route::get('/buy/{id}', 'FoodController@buy')->name('buy-food');
    Route::post('/order', 'FoodController@order')->name('order');
    Route::get('/view-order', 'FoodController@viewOrder')->name('view-order');
    Route::get('/search', 'FoodController@search')->name('search-food');
    Route::get('/edit/{id}', 'FoodController@edit')->name('edit-food');
    Route::put('/update/{id}', 'FoodController@update')->name('update-food');
    Route::get('/food/{id}', 'FoodController@destroy')->name('delete-food');
});

Route::group(['middleware' => 'auth', 'prefix' => 'shopping', 'namespace' => 'App\Http\Controllers\Shopping'], function () {
    Route::get('/create', 'ShoppingController@create')->name('create-product');
    Route::post('/save', 'ShoppingController@save')->name('save-product');
    Route::get('/products', 'ShoppingController@index')->name('product-list');
    Route::get('/product/{slug}', 'ShoppingController@show')->name('show-product');
    Route::get('/view/{id}', 'ShoppingController@view')->name('view-product');
    Route::get('/edit/{id}', 'ShoppingController@edit')->name('edit-product');
    Route::put('/update/{id}', 'ShoppingController@update')->name('update-product');
    Route::get('/search', 'ShoppingController@search')->name('search-product');
    Route::get('/delete/{id}', 'ShoppingController@destroy')->name('delete-product');
});

Route::group(['middleware' => 'auth', 'prefix' => 'shopping', 'namespace' => 'App\Http\Controllers\Shopping'], function () {
    Route::get('/cart', 'CartController@index')->name('shopping-cart');
    Route::post('/cart', 'CartController@store');
    Route::delete('/cart/{id}', 'CartController@destroy')->name('delete-item');
    Route::post('/cart/saveForLater/{id}', 'CartController@saveForLater')->name('save-later-item');

    Route::delete('/saveForLater/{id}', 'SaveForLaterController@destroy')->name('delete-later-item');
    Route::post('/saveForLater/moveToCart/{id}', 'SaveForLaterController@moveToCart')->name('move-cart-item');
    Route::get('/checkout', 'CheckoutController@checkout')->name('checkout');
    Route::get('/success', 'CheckoutController@success')->name('success');
    Route::get('/cart/empty', function(){
        Cart::destroy();
    });
});

// Route::get('/execute-payment', 'App\Http\Controllers\PaymentController@execute')->name('execute-payment');

Route::get('/', [App\Http\Controllers\GroceryController::class, 'index']);
Route::resource('grocery', App\Http\Controllers\GroceryController::class);