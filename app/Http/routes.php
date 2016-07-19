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


Route::get('/',['uses' => 'ProjectController@index'] );

//Route::resource('tasks','TaskController', ['parameters' => ['tasks' => 'taskid']] );

Route::get('tasks','TaskController@index');
Route::post('tasks','TaskController@store');
Route::get('tasks/create/{projectid}','TaskController@create');
Route::get('tasks/{taskid}','TaskController@show');
Route::put('tasks/{taskid}','TaskController@update');
Route::delete('tasks/{taskid}','TaskController@destroy');
Route::get('tasks/{taskid}/edit','TaskController@edit');
Route::get('/project/{projectid}/tasks','TaskController@listTasks');


//Route::auth();

Route::get('/login',['uses'=> 'Auth\AuthController@showLoginForm']);
Route::post('/login',['uses'=> 'Auth\AuthController@login']);
Route::get('/logout',['uses'=> 'Auth\AuthController@logout']);

Route::get('/password/reset/{token?}',['uses'=> 'Auth\PasswordController@showResetForm']);
Route::post('/password/email',['uses'=> 'Auth\PasswordController@sendResetLinkEmail']);
Route::post('/password/reset',['uses'=> 'Auth\PasswordController@reset']);


Route::get('/home', 'HomeController@index');


Route::get('/project','ProjectController@index');
Route::get('/project/create','ProjectController@create');
Route::post('/project','ProjectController@store');
Route::get('/project/{projectid}/edit','ProjectController@edit');
Route::put('/project/{projectid}','ProjectController@update');
Route::delete('/project/{projectid}','ProjectController@destroy');

