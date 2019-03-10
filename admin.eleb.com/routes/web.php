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
Route::resource('shopCategorys', 'ShopCategoryController');
Route::resource('shops', 'ShopController');
Route::resource('users', 'UserController');
Route::get('/status','ShopController@status')->name('shop.status');
Route::post('blog/save','BlogController@save');
Route::get('/status/edit/{id}','ShopController@statusa')->name('status.edit');
Route::get('/status/del/{id}','ShopController@del')->name('status.del');
Route::resource('admins','AdminController');
Route::get('login','LoginController@index')->name('login');
Route::post('login','LoginController@store')->name('login');
Route::get('logout','LoginController@destroy')->name('logout');
Route::get('admin/password/','AdminController@password')->name('admin.password');
Route::post('admin/save/{admin}','AdminController@save')->name('admin.save');
Route::get('user/password/{user}', 'UserController@password')->name('user.password');
Route::post('user/add/{user}', 'UserController@add')->name('user.add');
Route::resource('activitys','ActivityController');
Route::get('activity/for', 'ActivityController@for')->name('activity.for');
Route::get('activity/stop', 'ActivityController@stop')->name('activity.stop');
Route::get('activity/notstart', 'ActivityController@notstart')->name('activity.notstart');
Route::post('/upload','ShopCategoryController@upload')->name('upload');
    Route::resource('members','MemberController');
Route::get('me/kaiqi/{id}', 'MemberController@kaiqi')->name('me.kaiqi');
Route::post('me/keyword', 'MemberController@index')->name('me.keywrod');
Route::resource('permissions','PermissionController');
Route::resource('roles','RoleController');
Route::resource('navs','NavsController');
Route::get('layou/layo', 'NavsController@layo')->name('layou.layo');
Route::resource('events','EventController');
Route::get('eventmembers/show/{id}', 'Event_memberController@show')->name('eventmembers.show');
Route::get('es/kaijiang/{id}', 'EventController@kaijiang')->name('es.kaijiang');
Route::resource('eventprizes','Event_prizeController');