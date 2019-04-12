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
Auth::routes();

Route::get('/', 'MainController@index')->name('index');
Route::get('/home', 'HomeController@home')->name('home');
Route::get('/cabinets', 'HomeController@cabinets')->name('cabinets');
Route::get('/groups', 'HomeController@groups')->name('groups');

Route::get('schedule/schedule_by_group/{id}', 'CRUD\ScheduleController@getSchedule')->name('scheduleByGroup');
Route::resource('/schedule', 'CRUD\ScheduleController');