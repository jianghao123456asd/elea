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

Route::resource('users', 'UserController');
Route::get('login','LoginController@index')->name('login');
Route::post('login','LoginController@store')->name('login');
Route::get('logout','LoginController@destroy')->name('logout');
Route::get('user/password/','UserController@password')->name('user.password');
Route::post('user/save/{user}','UserController@save')->name('save.password');
Route::get('user/if','UserController@if')->name('user.if');
Route::get('user/index','UserController@index')->name('user.index');
Route::resource('menucategories', 'menucategorieController');
Route::resource('menus', 'menuController');
Route::post('menu/keyword','MenuController@index')->name('menus.keyword');
Route::resource('shops', 'ShopController');

Route::resource('activitys', 'ActivityController');
Route::resource('Ordermans', 'OrdermanController');
Route::get('Ordermans/fahuo/{id}','OrdermanController@fahuo')->name('Ordermans.fahuo');
Route::get('Ordermans/show/{id}','OrdermanController@show')->name('Ordermans.show');
Route::get('Ordermans/stop/{id}','OrdermanController@stop')->name('Ordermans.stop');
Route::get('Or/tj','OrdermanController@tj')->name('Or.tj');
Route::get('/Or/yue','OrdermanController@yue')->name('Ordermans.yue');
Route::get('/Or/caizhou','OrdermanController@menu')->name('Ordermans.caizhou');
Route::resource('events','EventController');
Route::get('/Or/caiyue','OrdermanController@menyue')->name('Ordermans.yue');
Route::get('/et/zj/{id}','EventController@zhongjiang')->name('et.zj');