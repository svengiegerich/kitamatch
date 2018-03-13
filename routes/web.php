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


Route::get('foo', function () {
    return 'Hello World';
});

//Root
Route::get('/', 'ApplicantController@index');

//Applicant
Route::get('/applicant', 'ApplicantController@index');
Route::get('/applicant/all', 'ApplicantController@all');
Route::get('/applicant/create', 'ApplicantController@create');
Route::get('/applicant/{applicant}', 'ApplicantController@show');
Route::get('/applicant/{applicant}/edit', 'ApplicantController@edit');
Route::put('/applicant/{applicant}', 'ApplicantController@update');

//Program

//Prefernece
Route::get('/preference/{preference}', 'PreferenceController@show');
Route::get('/preference/applicant/{applicantID}', 'PreferenceController@showByApplicant');
Route::get('/preference/all', 'PreferenceController@all');
