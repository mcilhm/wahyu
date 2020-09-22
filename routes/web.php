<?php

use Illuminate\Support\Facades\Route;
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

    Route::get('division/divisionlist', 'Admin\DivisionController@getdata');
    Route::get('division', 'Admin\DivisionController@index');
    Route::post('division', 'Admin\DivisionController@store');
    Route::get('division/{id}/department', 'Admin\DivisionController@getDepartment');
    Route::get('division/delete/{id}', 'Admin\DivisionController@destroy');

    Route::get('department/departmentlist', 'Admin\DepartmentController@getdata');
    Route::get('department', 'Admin\DepartmentController@index');
    Route::post('department', 'Admin\DepartmentController@store');
    Route::get('department/{id}/section', 'Admin\DepartmentController@getSection');
    Route::get('department/delete/{id}', 'Admin\DepartmentController@destroy');

    Route::get('section/sectionlist', 'Admin\SectionController@getdata');
    Route::get('section', 'Admin\SectionController@index');
    Route::post('section', 'Admin\SectionController@store');
    Route::get('section/delete/{id}', 'Admin\SectionController@destroy');

    Route::get('employee/employeelist', 'Admin\EmployeeController@getdata');
    Route::get('employee', 'Admin\EmployeeController@index');
    Route::post('employee', 'Admin\EmployeeController@store');
    Route::get('employee/delete/{id}', 'Admin\EmployeeController@destroy');

    Route::get('kelas/kelaslist', 'Admin\KelasController@getdata');
    Route::get('kelas', 'Admin\KelasController@index');
    Route::post('kelas', 'Admin\KelasController@store');
    Route::get('kelas/delete/{id}', 'Admin\KelasController@destroy');

    Route::get('position/positionlist', 'Admin\PositionController@getdata');
    Route::get('position', 'Admin\PositionController@index');
    Route::post('position', 'Admin\PositionController@store');
    Route::get('position/delete/{id}', 'Admin\PositionController@destroy');

    Route::get('education/educationlist', 'Admin\EducationController@getdata');
    Route::get('education', 'Admin\EducationController@index');
    Route::post('education', 'Admin\EducationController@store');
    Route::get('education/delete/{id}', 'Admin\EducationController@destroy');

    Route::get('role/rolelist', 'Admin\RoleController@getdata');
    Route::get('role', 'Admin\RoleController@index');
    Route::post('role', 'Admin\RoleController@store');
    Route::get('role/delete/{id}', 'Admin\RoleController@destroy');

    Route::get('activity/activitylist', 'Admin\ActivityController@getdata');
    Route::get('activity', 'Admin\ActivityController@index');
    Route::post('activity', 'Admin\ActivityController@store');
    Route::get('activity/delete/{id}', 'Admin\ActivityController@destroy');

    Route::get('activity_status/{id_activity}', 'Admin\ActivityStatusController@index');
    Route::get('activity_status/activitystatuslist/{id_activity}', 'Admin\ActivityStatusController@getdata');
    Route::post('activity_status/{id_activity}', 'Admin\ActivityStatusController@store');
    Route::get('activity_status/delete/{id}', 'Admin\ActivityStatusController@destroy');

    Route::get('activity_template/{id_activity}', 'Admin\ActivityTemplateController@index');
    Route::get('activity_template/activitytemplatelist/{id_activity}', 'Admin\ActivityTemplateController@getdata');
    Route::post('activity_template/{id_activity}', 'Admin\ActivityTemplateController@store');
    Route::get('activity_template/delete/{id}', 'Admin\ActivityTemplateController@destroy');

    Route::get('user/userlist', 'Admin\UserController@getdata');
    Route::get('user', 'Admin\UserController@index');
    Route::post('user', 'Admin\UserController@store');
    Route::get('user/delete/{id}', 'Admin\UserController@destroy');

    Route::get('submissionemployee/{status}/submissionlist', 'Admin\SubmissionEmployeeController@getdata');
    Route::get('submissionemployee/{status}/{id}', 'Admin\SubmissionEmployeeController@store');
    Route::get('submissionemployee/{status}', 'Admin\SubmissionEmployeeController@index');

    Route::get('submission/{id}/submissionlist', 'Admin\SubmissionController@getdata');
    Route::get('submission/{id}', 'Admin\SubmissionController@index');
    Route::post('submission/{id}', 'Admin\SubmissionController@store');
});
