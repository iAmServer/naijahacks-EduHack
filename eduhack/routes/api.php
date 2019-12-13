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

Route::get('/courses', 'ApiController@courses');
Route::get('/course/{id}', 'ApiController@course');
Route::get('/question', 'ApiController@testQuestion');
Route::post('/savedsearch', 'ApiController@savedSearch');
Route::post('/search', 'ApiController@search');
Route::post('/savecourse', 'ApiController@saveCourse');
Route::post('/createcourse', 'ApiController@createCourse');
Route::put('/updatecourse/{id}', 'ApiController@updateCourse');
Route::get('/communityengagement', 'ApiController@communityEngagement');

