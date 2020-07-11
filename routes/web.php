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

Route::get('/', 'Auth\LoginController@showLoginForm');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout');
Route::group(array('middleware' => ['Admin']), function () {

    Route::get('/home', 'Admin\HomeController@index');

    Route::get('activity/activitylist','Admin\ActivityController@getdata');
    Route::get('activity', 'Admin\ActivityController@index');
    Route::post('activity', 'Admin\ActivityController@store');
    Route::get('activity/delete/{id}','Admin\ActivityController@destroy');

    Route::get('activity_status/{id_activity}', 'Admin\ActivityStatusController@index');
    Route::get('activity_status/activitystatuslist/{id_activity}','Admin\ActivityStatusController@getdata');
    Route::post('activity_status/{id_activity}', 'Admin\ActivityStatusController@store');
    Route::get('activity_status/delete/{id}','Admin\ActivityStatusController@destroy');
});