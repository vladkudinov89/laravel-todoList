<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::prefix('v1')->group(function () {
    Route::get('/tasks', 'Api\TaskController@index');

    Route::post('/tasks', 'Api\TaskController@store');
    Route::put('/tasks/{id}', 'Api\TaskController@update');
    Route::delete('/tasks/{id}', 'Api\TaskController@destroy');

    Route::get('tasks/search' , 'Api\TaskController@search');
});


