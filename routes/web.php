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

Route::get('/sendmail/{id}', 'UserController@sendmail');

Route::get('/post', 'UserController@post');

Route::get('/book', 'BookController@index');
Route::get('/book/save', 'BookController@store');

Route::get('/customer/{type}/discount', 'UserController@discount');
Route::get('/customer/{type}/bonus', 'UserController@bonus');

//Route::group(['middleware' => 'auth'], function () {
    Route::resource('/promotions', 'PromotionController');
//});
