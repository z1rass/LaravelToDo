<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/hello', 'App\Http\Controllers\HelloController@index');


Route::get('/todo', 'App\Http\Controllers\TaskController@index');

Route::post('/todo/add', 'App\Http\Controllers\TaskController@add');

Route::post('/todo/update', 'App\Http\Controllers\TaskController@update');
