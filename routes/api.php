<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/review/{product}' , 'ReviewController@getReviewsAPI');

Route::get('/products','APIController@AllProducts');

Route::get('/products/{product}','APIController@Product');

Route::post('/products/create','APIController@createProduct');

Route::apiResource("user","APIController");
