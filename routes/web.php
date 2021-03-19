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

Auth::routes();

Route::get('/', 'StaticController@opening');
Route::get('/home', 'UserController@index');
// Route::get('/home2', 'HomeController@index');

//Axios
Route::get('/tasks', 'TaskController@get');
Route::post('/tasks/create', 'TaskController@create');
Route::delete('/tasks/delete', 'TaskController@delete');
Route::post('/done_task', 'DoneTaskController@post');
