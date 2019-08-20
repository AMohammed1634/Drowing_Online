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

/**
 * routes for User on System
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


/**
 * routes for admin on System
 */

Route::get('/dashboard','AdminController@lockscreen')->name('dashboard')->middleware('admin');
Route::get('/asd','AdminController@dashboard')->name('dashboard.asd')->middleware('admin');

Route::get('/dashboard/orders','AdminController@orders')->name('dashboard.orders')->middleware('admin');

Route::get('/dashboard/order/{order}','AdminController@singleOrder')->name('dashboard.order')->middleware('admin');

Route::get('/dashboard/sales','AdminController@sales')->name('dashboard.sales')->middleware('admin');

Route::get('/dashboard/registration','AdminController@registration')->name('dashboard.registration')->middleware('admin');
Route::get('/dashboard/registration/user/{user}','AdminController@userProfile')->name('dashboard.userProfile')->middleware('admin');

Route::get('/dashboard/admin','AdminController@admin')->name('dashboard.admin')->middleware('admin');

Route::get('/lockscreen','AdminController@lockscreen')->name('lockscreen')->middleware('admin');

Route::post('/lockscreen','AdminController@lockscreenLogin')->name('lockscreenLogin')->middleware('admin');

Route::post('/dashboard/search','AdminController@searchUser')->name('searchUser')->middleware('admin');

Route::put('/dashboard/registration/update/{user}','AdminController@update')->middleware('admin');
