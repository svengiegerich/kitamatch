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
//Root
Route::get('/', 'HomeController@index', function(){
   return View::make("welcome");
});
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
Route::get('/applicant/add/{gid}', 'ApplicantController@add');
Route::post('/applicant/add/{gid}', 'ApplicantController@create');
Route::get('/applicant/{applicant}', 'ApplicantController@show');
Route::post('/applicant/{applicant}', 'ApplicantController@edit');
Route::delete('/applicant/{applicant}', 'ApplicantController@delete');
Route::get('applicant/setPriority/{aID}', 'ApplicantController@setPriority');

//Program
Route::get('/program', 'ProgramController@all');
Route::get('/program/all', 'ProgramController@all');
Route::delete('/program/{program}', 'ProgramController@delete');
Route::get('/program/add/{proid}', 'ProgramController@addByProvider');
Route::post('/program/add/{proid}', 'ProgramController@createByProvider');
Route::get('/program/{pID}', 'ProgramController@show');
Route::post('/program/{pID}', 'ProgramController@edit');

//Preference
Route::get('/preference/single/{preference}', 'PreferenceController@show');
// -By Applicant
Route::get('/preference/applicant/{aID}', 'PreferenceController@showByApplicant');
Route::post('/preference/applicant/{aID}', 'PreferenceController@addByApplicant');
Route::post('/preference/applicant/reorder/{aID}', 'PreferenceController@reorderByApplicantAjax');
Route::post('/preference/applicant/delete/{aID}', 'PreferenceController@deleteByApplicantAjax');
Route::delete('/preference/applicant/{prID}', 'PreferenceController@deleteByApplication');
// -By Program - coordinated
Route::get('/preference/program/{pID}', 'PreferenceController@showByProgram');
Route::post('/preference/program/{pID}', 'PreferenceController@addByProgram');
Route::delete('/preference/program/{prID}', 'PreferenceController@deleteByProgram');
// -By Program - uncoordinated
Route::post('/preference/program/uncoordinated/offer/{pID}', 'PreferenceController@addOfferUncoordinatedProgram');
Route::post('/preference/program/uncoordinated/waitlist/{pID}', 'PreferenceController@addWaitlistUncoordinatedProgram');
Route::post('/preference/program/uncoordinated/reorder/{pID}', 'PreferenceController@reorderWaitlistByProgramAjax');
Route::post('/preference/program/uncoordinated/upoffer', 'PreferenceController@updateOfferUncoordinatedProgram');
Route::delete('/preference/program/uncoordinated/{aID}', 'PreferenceController@deleteByProgram');

// -All
Route::get('/preference/all', 'PreferenceController@all');

//Guardian
Route::get('/guardian/all', 'GuardianController@all');
Route::get('/guardian/{gID}', 'GuardianController@show');
Route::post('/guardian/{gID}', 'GuardianController@edit');
//tmp: post or get?! CSR in email?!
Route::post('/guardian/verify/{gID}', 'GuardianController@verify');

//Provider
Route::get('/provider/{proid}', 'ProviderController@show');
Route::post('/provider/{proid}', 'ProviderController@edit');

//Matchings
Route::get('/matching/all', 'MatchingController@all');
Route::get('/matching/json', 'MatchingController@createJson');
Route::get('/matching/get', 'MatchingController@findMatchings');

//Criteria
Route::get('/criteria/{p_id}', 'CriteriumController@showByProvider');
Route::post('/criteria', 'CriteriumController@editAjax');
//for uncoordinated progams with no provider, create fake provider
Route::get('/criteria/program/{programId}', 'CriteriumController@showByProgram');

//Admin
Route::get('/admin/', 'AdminController@index');
Route::get('/admin/dashboard', 'AdminController@index');
