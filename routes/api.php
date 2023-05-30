<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\HasApiTokens;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TasksController;

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
        return $request->user() ? response()->json(['isLoggedIn' => true]) : response()->json(['isLoggedIn' => false]);
    });
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/myPage', [AuthController::class, 'show']);
    Route::get('/show', [AuthController::class, 'show']);
    Route::get('/profile',[TasksController::class, 'show']);
    Route::get('/tasks', [TasksController::class, 'index']);
    Route::post('/tasks', [TasksController::class, 'store']);
    Route::get('/tasks/{id}',[TasksController::class, 'show']);
    Route::patch('/tasks/{task}', [TasksController::class, 'update']);
    Route::delete('/tasks/{id}', [TasksController::class, 'destroy']);
});


Route::group(['middleware' => 'api'], function(){
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'create']);
});
