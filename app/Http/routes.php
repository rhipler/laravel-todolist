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

/*Route::get('/', function () {
    return view('welcome');
});*/

/*
Route::get('user', function() {
    return 'foo';
});*/

/*
Route::get('tasks', ['uses' => 'TaskController@index']  );

Route::get('tasks/{taskid}',  'TaskController@show');

Route::get('tasks/{taskid}/edit', 'TaskController@edit' );
*/
Route::get('/',['uses' => 'TaskController@index'] );

Route::resource('tasks','TaskController', ['parameters' => ['tasks' => 'taskid']] );
