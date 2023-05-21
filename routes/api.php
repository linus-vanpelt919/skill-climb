<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\HasApiTokens;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', 'App\Http\Controllers\AuthController@logout');
    Route::get('/tasks', 'App\Http\Controllers\TasksController@index');
    Route::post('/tasks', 'App\Http\Controllers\TasksController@store');
    Route::get('/tasks/{id}', 'App\Http\Controllers\TasksController@show');
    Route::put('/tasks/{id}', 'App\Http\Controllers\TasksController@update');
    Route::delete('/tasks/{id}', 'App\Http\Controllers\TasksController@destroy');
    Route::get('/myPage', 'App\Http\Controllers\AuthController@show');
    Route::get('/show', 'App\Http\Controllers\AuthController@show');
});

Route::group(['middleware' => 'api'], function(){
    Route::get('/login', 'App\Http\Controllers\AuthController@index')->name('login');
    Route::post('/login', 'App\Http\Controllers\AuthController@login');
    Route::post('/register', 'App\Http\Controllers\AuthController@create');
});
