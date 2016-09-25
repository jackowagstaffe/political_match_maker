<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Questionnaire
Route::get('/page/{page_id}', 'QuestionnaireController@page')->name('page');

// Routes for collecting data
// (may be disabled to prevent accidentally going over api limit)
Route::get('/get/mps', 'CollectController@getMps');
Route::get('/get/mp-info', 'CollectController@getMpInfo');

// Mp view info
Route::get('/mp/{mp}', 'MemberController@view');
