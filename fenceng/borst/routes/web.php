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
Route::get('login','SuteController@index');
//学生
//列表
Route::get('student/index','StudentController@index');
Route::get('student/add','StudentController@add');
Route::post('student/save','StudentController@save');
Route::get('student/del/{id}','StudentController@del')->name('student.del');