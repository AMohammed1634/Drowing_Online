<?php

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
Route::get('/master',function (){
    return view ('masterView');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/categories','CategoryController@index')->name('categories');

Route::get('/categories/{cat}','CategoryController@show')->name('categories.cat');

Route::resource('/product','ProductController');

Route::post('/review/create/{product}','ReviewController@create')->name('review.create')->middleware('auth');
/*
Route::get('viewProfile/{id}','UserController@viewProfile')->name('viewProfile');
Route::post('addImageProfile/{id}', 'UserController@addImageProfile')->name('addImageProfile');
*/
Route::get('addToCart/{product}','ShoppingCartController@addToCart')->name('addToCart')->middleware('auth');

Route::get('shopping_cart','ShoppingCartController@shopping_cart')->name('shopping_cart')->middleware('auth');

Route::get('shopping_cart/destroy/{cart}','ShoppingCartController@destroy')->name('shopping_cart.destroy')->middleware('auth');

Route::get('shopping_cart/checkout','ShoppingCartController@checkout')->name('shopping_cart.checkout')->middleware('auth');

Route::get('incrementQTY/{cart}','ReviewController@incrementQTY')->middleware('auth');

Route::get('decrementQTY/{cart}','ReviewController@decrementQTY')->middleware('auth');

Route::post('makeOrder','OrderController@makeOrder')->name('makeOrder')->middleware('auth');

