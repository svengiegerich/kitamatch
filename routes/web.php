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

//Preference
Route::get('/preference/single/{preference}', 'PreferenceController@show');
// By Applicant
Route::get('/preference/applicant/{aID}', 'PreferenceController@showByApplicant');
Route::post('/preference/applicant/create/{aID}', 'PreferenceController@addByApplicant');
Route::delete('/preference/applicant/{prid}', function ($prid) {
    Preference::findOrFail($prid)->delete();

    return redirect('/preference/applicant/1');
});

Route::get('/preference/program/{pID}', 'PreferenceController@showByProgram');
Route::get('/preference/all', 'PreferenceController@all');


//Matchings
Route::get('/matching/all', 'MatchingController@all');
Route::get('/matching/json', 'MatchingController@createJson');
Route::get('/matching/get', 'MatchingController@findMatchings');