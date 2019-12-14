<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::get('/courses',  array('middleware' => 'cors', 'uses' => 'ApiController@courses'));
// Route::get('/course/{id}', array('middleware' => 'cors', 'uses' => 'ApiController@course'));
// Route::get('/question', array('middleware' => 'cors', 'uses' => 'ApiController@testQuestion'));
// Route::post('/savedsearch', array('middleware' => 'cors', 'uses' => 'ApiController@savedSearch'));
// Route::post('/search', array('middleware' => 'cors', 'uses' => 'ApiController@search'));
// Route::post('/savecourse', array('middleware' => 'cors', 'uses' => 'ApiController@saveCourse'));
// Route::post('/createcourse', array('middleware' => 'cors', 'uses' => 'ApiController@createCourse'));
// Route::put('/updatecourse/{id}', array('middleware' => 'cors', 'uses' => 'ApiController@updateCourse'));
// Route::get('/communityengagement', array('middleware' => 'cors', 'uses' => 'ApiController@communityEngagement'));

// Route::post('login', array('middleware' => 'cors', 'uses' => 'AuthController@login'));
// Route::post('register', array('middleware' => 'cors', 'uses' => 'AuthController@register'));
// Route::group(['middleware' => 'auth:api'], function(){
// 	Route::get('logout', array('middleware' => 'cors', 'uses' =>  'AuthController@logout'));
// 	Route::post('details', array('middleware' => 'cors', 'uses' => 'AuthController@details'));
// });



Route::get('/courses', 'ApiController@courses');
Route::get('/course/{id}','ApiController@course');
Route::get('/question','ApiController@testQuestion');
Route::post('/savedsearch','ApiController@savedSearch');
Route::post('/search','ApiController@search');
Route::post('/savecourse','ApiController@saveCourse');
Route::post('/createcourse','ApiController@createCourse');
Route::put('/updatecourse/{id}','ApiController@updateCourse');
Route::get('/communityengagement','ApiController@communityEngagement');

Route::post('login','AuthController@login');
Route::post('register','AuthController@register');
Route::group(['middleware' => 'auth:api'], function(){
	Route::get('logout', 'AuthController@logout');
	Route::post('details','AuthController@details');
});