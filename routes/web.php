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

Route::get('/', 'StaticController@opening')->name('opening');

Auth::routes();

Route::get('/home2', 'HomeController@index')->name('home2');
Route::get('/home', 'UserController@index')->name('home');
Route::get('/tasks', 'TaskController@index')->name('tasks');
Route::post('/tasks/create', 'TaskController@create')->name('task_create');

Route::get('/axios/tasks',function(){
	return App\Task::UserIdEqual(Auth::user()->id)->get();
});

Route::get('/axios/done_tasks',function(){
	return App\DoneTask::UserIdEqual(Auth::user()->id)->get();
});

Route::get('/axios/done_task', 'AxiosTasksController@get');
Route::post('/axios/done_task', 'AxiosTasksController@post');
