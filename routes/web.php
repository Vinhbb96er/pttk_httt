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
Route::get('/404', 'HomeController@pageNotFound')->name('404');

Route::group(['middleware' => 'auth'], function () {

    // staffs
    Route::group(['middleware' => 'staff_manager'], function () {
        Route::resource('/staffs', 'StaffController');

        Route::post('/ajax/change-status', 'StaffController@changeStatus')->name('change_status');

        Route::post('/ajax/search-staff', 'StaffController@search')->name('search_staff');

        Route::post('/ajax/delete-staffs', 'StaffController@deleteMulti')->name('delete_staff');
    });

    // patients
    Route::resource('/patients', 'PatientController');

    Route::post('/ajax/search-patients', 'PatientController@search')->name('search_patient');

    Route::post('/ajax/delete-patients', 'PatientController@deleteMulti')->name('delete_patient');

    // medical records
    Route::group(['middleware' => 'medicalrecord_manager'], function () {
        Route::resource('/medical-records', 'MedicalRecordController');

        Route::post('/ajax/search-medical-records', 'MedicalRecordController@search')->name('search_medical_record');
        
        Route::post('/ajax/delete-medical-records', 'MedicalRecordController@deleteMulti')->name('delete_medical_record');
    });

    // profile
    Route::resource('/profile', 'ProfileController');

    // report - patients
    Route::get('/reports/patients', [
        'uses' => 'ReportController@showPatient',
        'as' => 'reports.patients.index',
    ]);

    Route::post('/reports/patients', [
        'uses' => 'ReportController@statisticPatient',
        'as' => 'reports.patients.statistic',
    ]);

    Route::post('/reports/patients/export', [
        'uses' => 'ReportController@exportPatient',
        'as' => 'reports.patients.export',
    ]);

    // report -medicalrecord
    Route::group(['middleware' => 'medicalrecord_manager'], function () {
        Route::get('/reports/medicalrecords', [
            'uses' => 'ReportController@showMedicalRecord',
            'as' => 'reports.medicalrecords.index',
        ]);

        Route::post('/reports/medicalrecords', [
            'uses' => 'ReportController@statisticMedicalRecord',
            'as' => 'reports.medicalrecords.statistic',
        ]);

        Route::post('/reports/medicalrecords/export', [
            'uses' => 'ReportController@exportMedicalRecord',
            'as' => 'reports.medicalrecords.export',
        ]);
    });
});
