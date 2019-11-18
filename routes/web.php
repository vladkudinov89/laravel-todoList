<?php

use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return redirect()->route('tasks.index');
//});

Route::get('/{any?}', function () {
    return view('layouts.app');
})->where('any', '^(?!api|dist|storage\b).+');


//Route::resource('tasks' , 'TaskController');

//Route::post('tasks/search' , 'TaskController@search')->name('tasks.search');
