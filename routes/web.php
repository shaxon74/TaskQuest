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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home2', 'HomeController@index')->name('home2');
Route::get('/home', 'UserController@index')->name('home');
Route::get('/tasks', 'TaskController@index')->name('tasks');
Route::post('/tasks/create', 'TaskController@create')->name('task_create');
