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

    Route::get('division/divisionlist','Admin\DivisionController@getdata');
    Route::get('division', 'Admin\DivisionController@index');
    Route::post('division', 'Admin\DivisionController@store');
    Route::get('division/delete/{id}','Admin\DivisionController@destroy');


    Route::get('kelas/kelaslist','Admin\KelasController@getdata');
    Route::get('kelas', 'Admin\KelasController@index');
    Route::post('kelas', 'Admin\KelasController@store');
    Route::get('kelas/delete/{id}','Admin\KelasController@destroy');


    Route::get('department/departmentlist','Admin\DepartmentController@getdata');
    Route::get('department', 'Admin\DepartmentController@index');
    Route::post('department', 'Admin\DepartmentController@store');
    Route::get('department/delete/{id}','Admin\DepartmentController@destroy');


    Route::get('position/positionlist','Admin\PositionController@getdata');
    Route::get('position', 'Admin\PositionController@index');
    Route::post('position', 'Admin\PositionController@store');
    Route::get('position/delete/{id}','Admin\PositionController@destroy');


    Route::get('pendidikan/pendidikanlist','Admin\PendidikanController@getdata');
    Route::get('pendidikan', 'Admin\PendidikanController@index');
    Route::post('pendidikan', 'Admin\PendidikanController@store');
    Route::get('pendidikan/delete/{id}','Admin\PendidikanController@destroy');


    Route::get('seksi/seksilist','Admin\SeksiController@getdata');
    Route::get('seksi', 'Admin\SeksiController@index');
    Route::post('seksi', 'Admin\SeksiController@store');
    Route::get('seksi/delete/{id}','Admin\SeksiController@destroy');


    Route::get('employee/employeelist','Admin\EmployeeController@getdata');
    Route::get('employee', 'Admin\EmployeeController@index');
    Route::post('employee', 'Admin\EmployeeController@store');
    Route::get('employee/delete/{id}','Admin\EmployeeController@destroy');


    Route::get('activity/activitylist','Admin\ActivityController@getdata');
    Route::get('activity', 'Admin\ActivityController@index');
    Route::post('activity', 'Admin\ActivityController@store');
    Route::get('activity/delete/{id}','Admin\ActivityController@destroy');

    Route::get('activity_status/{id_activity}', 'Admin\ActivityStatusController@index');
    Route::get('activity_status/activitystatuslist/{id_activity}','Admin\ActivityStatusController@getdata');
    Route::post('activity_status/{id_activity}', 'Admin\ActivityStatusController@store');
    Route::get('activity_status/delete/{id}','Admin\ActivityStatusController@destroy');
});
