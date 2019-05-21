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

//api topic
Route::post('topic/create', 'TopicController@create');
Route::get('topics', 'TopicController@index');
Route::put('topic/update/{topic}', 'TopicController@update');

Route::get('capacities', 'CapacityController@index');
Route::get('contents', 'ContentController@index');

//api course
Route::get('courses', 'CourseController@index');
Route::get('requeriments', 'CourseController@requeriments');
Route::post('course/create', 'CourseController@create');
Route::put('course/update/{course}', 'CourseController@update');
Route::get('natures', 'NatureController@index');
Route::get('areas', 'AreaController@index');
Route::get('terms', 'TermController@index');

//Capacity
Route::post('capacity/create', 'CapacityController@create');
Route::put('capacity/update/{capacity}', 'CapacityController@update');
Route::delete('capacity/delete/{capacity}', 'CapacityController@destroy');
//Content
Route::post('content/create', 'ContentController@create');
Route::put('content/update/{content}', 'ContentController@update');
Route::delete('content/delete/{content}', 'ContentController@destroy');
//Plan
Route::get('plans', 'PlanController@index');
