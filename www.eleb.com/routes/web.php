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
Route::get('login','LoginController@index')->name('login');
Route::post('login','LoginController@store')->name('login');
Route::get('logout','LoginController@destroy')->name('logout');
Route::resource('users', 'UserController');
Route::get('/api/businessList','ApiController@businessList');
Route::post('/api/regist','ApiController@regist');
Route::post('/api/loginCheck','ApiController@loginCheck');
Route::get('/api/sms','ApiController@sms');
Route::get('/api/businessphp','ApiController@businessphp');
Route::post('/api/addAddress','ApiController@addAddress');
Route::get('/api/address','ApiController@address');

Route::post('/api/editAddress','ApiController@editAddress');
Route::get('/api/addressList','ApiController@addressList');

Route::post('/api/addCart','ApiController@addCart');
Route::get('/api/cart','ApiController@cart');
Route::post('/api/addorder','ApiController@addorder');

Route::post('/api/changePassword','ApiController@changePassword');
Route::get('/api/order','ApiController@order');

Route::post('/api/forgetPassword','ApiController@forgetPassword');
Route::get('/api/apiorderList','ApiController@apiorderList');
