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
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

//Auth
Route::auth();
Route::get('/logout', function () {
   Auth::logout();
   return redirect('/');
});
Auth::routes();

//Applicant
Route::get('/applicant', 'ApplicantController@all');
Route::get('/applicant/all', 'ApplicantController@all');
Route::delete('/applicant/{applicant}', 'ApplicantController@delete');

Route::get('/applicant/add/{gid}', 'ApplicantController@add');
//Route::get('/applicant/add', 'ApplicantController@add');
Route::post('/applicant/add/{gid}', 'ApplicantController@create');

Route::get('/applicant/{applicant}', 'ApplicantController@show');
Route::post('/applicant/{applicant}', 'ApplicantController@edit');

//Program
Route::get('/program', 'ProgramController@all');
Route::get('/program/all', 'ProgramController@all');
Route::delete('/program/{program}', 'ProgramController@delete');

Route::get('/program/add/{proid}', 'ProgramController@add');
Route::post('/program/add/{proid}', 'ProgramController@create');

Route::get('/program/{pID}', 'ProgramController@show');
Route::post('/program/{pID}', 'ProgramController@edit');

//Preference
Route::get('/preference/single/{preference}', 'PreferenceController@show');
// -By Applicant
Route::get('/preference/applicant/{aID}', 'PreferenceController@showByApplicant');
Route::post('/preference/applicant/{aID}', 'PreferenceController@addByApplicant');
Route::delete('/preference/applicant/{prID}', 'PreferenceController@deleteByApplication');
// -By Program - coordinated
Route::get('/preference/program/{pID}', 'PreferenceController@showByProgram');
Route::post('/preference/program/{pID}', 'PreferenceController@addByProgram');
Route::delete('/preference/program/{prID}', 'PreferenceController@deleteByProgram');
// -By Program - uncoordinated
Route::post('/preference/program/uncoordinated/{pID}', 'PreferenceController@addUncoordinatedProgram');
Route::delete('/preference/program/uncoordinated/{aID}', 'PreferenceController@deleteByProgram');

// -All 
Route::get('/preference/all', 'PreferenceController@all');

//Guardian
Route::get('/guardian/{gID}', 'GuardianController@show');
Route::post('/guardian/{gID}', 'GuardianController@edit');

//Provider
Route::get('/provider/{proID}', 'ProviderController@show');
Route::post('/provdier/{proID}', 'ProviderController@edit');

//Matchings
Route::get('/matching/all', 'MatchingController@all');
Route::get('/matching/json', 'MatchingController@createJson');
Route::get('/matching/get', 'MatchingController@findMatchings');
