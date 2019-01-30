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
    return redirect()->route("todos");
});

Auth::routes();

Route::resource('todos', 'TodosController');
Route::get('/todo/{id}', 'TodosController@show')->name("todo");
Route::get('/todos', 'TodosController@index')->name("todos");
Route::post('/assign', 'TodosController@assign')->name("assign");
Route::resource('tasks', 'TasksController');
Route::resource('user_todo', 'User_todoController');

Route::get('/home', 'HomeController@index')->name('home');
