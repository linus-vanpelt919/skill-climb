<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/sanctum/csrf_token', function (Request $request) {
//     return $request->session()->token();
// })->middleware('web');

// Route::group(['middleware' => 'web'], function(){
//     Route::get('sanctum/csrf_token','App\Http\Controllers\AuthController@token');
// });

// Route::post('/logout', 'App\Http\Controllers\AuthController@logout')->middleware('auth:sanctum');

Route::group(['middleware' => 'api'], function(){
    Route::post('/login', 'App\Http\Controllers\AuthController@login');
    Route::post('/register', 'App\Http\Controllers\AuthController@create');
    Route::post('/logout', 'App\Http\Controllers\AuthController@logout');
    Route::get('/csrf_token','App\Http\Controllers\AuthController@token');
    Route::get('/tasks', 'App\Http\Controllers\TasksController@index');
    Route::post('/tasks', 'App\Http\Controllers\TasksController@store');
    Route::get('/tasks/{id}', 'App\Http\Controllers\TasksController@show');
    Route::put('/tasks/{id}', 'App\Http\Controllers\TasksController@update');
    Route::delete('/tasks/{id}', 'App\Http\Controllers\TasksController@destroy');
});


