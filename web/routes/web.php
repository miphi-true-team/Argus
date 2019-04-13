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

Route::get('/profile',   'HomeController@profile')->name('profile');
Route::get('/home',      'HomeController@home')->name('home');
Route::get('/schedules', 'HomeController@schedule')->name('schedule');
Route::get('/cabinets',  'HomeController@cabinets')->name('cabinets');
Route::get('/groups',    'HomeController@groups')->name('groups');
Route::get('/journals',   'HomeController@journal')->name('journal');

/* Ajax routes */
Route::get('schedule/schedule_by_group/{id}', 'CRUD\ScheduleController@getSchedule')->name('scheduleByGroup');
Route::resource('/schedule', 'CRUD\ScheduleController');

Route::get('journal/getJournalByDate/{group}/{date}', 'CRUD\JournalController@getJournalByDate')->name('getJournalByDate');
Route::resource('/journal', 'CRUD\JournalController');