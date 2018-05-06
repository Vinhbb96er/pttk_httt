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

    // staffs
    Route::resource('/staffs', 'StaffController');

    Route::post('/ajax/change-status', 'StaffController@changeStatus')->name('change_status');

    Route::post('/ajax/search-staff', 'StaffController@search')->name('search_staff');

    Route::post('/ajax/delete-staffs', 'StaffController@deleteMulti')->name('delete_staff');

    // patients
    Route::resource('/patients', 'PatientController');

    Route::post('/ajax/search-patients', 'PatientController@search')->name('search_patient');

    Route::post('/ajax/delete-patients', 'PatientController@deleteMulti')->name('delete_patient');

    // medical records
    Route::resource('/medical-records', 'MedicalRecordController');

    Route::post('/ajax/search-medical-records', 'MedicalRecordController@search')->name('search_medical_record');
    
    Route::post('/ajax/delete-medical-records', 'MedicalRecordController@deleteMulti')->name('delete_medical_record');
});
