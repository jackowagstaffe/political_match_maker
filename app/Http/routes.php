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

Route::get('/page/{page_id}', ['as' => 'page', function ($page_id) {
	if (!is_numeric($page_id)) {
		throw new \Exception('Not a valid page id');
	}
	$view_data = ['page_id' => $page_id];

    return view('pages/page_' . $page_id, $view_data);
}]);
