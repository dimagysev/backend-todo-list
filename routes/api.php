<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Api')->group(function (){
    Route::middleware('auth:api')->group(function (){
        Route::patch('/todos/change/status-all', 'TodoController@changeStatusAll');
        Route::post('/todos/delete/completed', 'TodoController@destroyCompleted');
        Route::resource('todos','TodoController')->except(['create', 'edit', 'show']);
    });

    Route::post('/login', 'AuthController@login');
    Route::post('/register', 'AuthController@register');
    Route::post('/logout', 'AuthController@logout');
});



