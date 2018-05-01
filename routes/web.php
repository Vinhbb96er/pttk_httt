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

Route::get('/', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('/staffs', 'StaffController');

    Route::post('/ajax/change-status', 'StaffController@changeStatus')->name('change_status');

    Route::post('/ajax/search-staff', 'StaffController@search')->name('search_staff');

    Route::post('/ajax/delete-staffs', 'StaffController@deleteMulti')->name('delete-staffs');
});
