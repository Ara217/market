<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');
Route::get('/market/comment/{id}', 'ProductsController@comment');
Route::post('/market/cart/delete', 'PaypalController@destroyCart');
Route::post('/market/cart/remove', 'PaypalController@removeFromCart');
Route::post('/market/addToCrat', 'PaypalController@addToCrat');
Route::get('/market/cart', 'PaypalController@cart');
Route::any('/market/checkout', 'PaypalController@getCheckout');
Route::get('/market/getDone', ['as'=>'getDone','uses'=>'PaypalController@getDone']);
Route::get('/market/getCancel', ['as'=>'getCancel','uses'=>'PaypalController@getCancel']);
Route::resource('/market', 'ProductsController');



