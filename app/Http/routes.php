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




Route::get('/',['uses' => 'TaskController@index'] );

Route::resource('tasks','TaskController', ['parameters' => ['tasks' => 'taskid']] );

//Route::auth();

Route::get('/login',['uses'=> 'Auth\AuthController@showLoginForm']);
Route::post('/login',['uses'=> 'Auth\AuthController@login']);
Route::get('/logout',['uses'=> 'Auth\AuthController@logout']);

Route::get('/password/reset/{token?}',['uses'=> 'Auth\PasswordController@showResetForm']);
Route::post('/password/email',['uses'=> 'Auth\PasswordController@sendResetLinkEmail']);
Route::post('/password/reset',['uses'=> 'Auth\PasswordController@reset']);


Route::get('/home', 'HomeController@index');
