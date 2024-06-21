<?php

use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\TagController;
use App\Http\Controllers\Api\v1\TodoController;
use App\Http\Controllers\Api\v1\TodoListController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/user', [AuthController::class, 'getUser'])->middleware('auth:sanctum');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});

Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'todo-lists'], function () {
    Route::post('/', [TodoListController::class, 'create']);
    Route::get('/', [TodoListController::class, 'list']);
});

Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'todos'], function () {
    Route::get('/filter', [TodoController::class, 'filterByTags']);
    Route::post('/', [TodoController::class, 'create']);
    Route::post('/{todoId}', [TodoController::class, 'editImage']);
    Route::delete('/{todoId}', [TodoController::class, 'deleteImage']);
    Route::get('/search', [TodoController::class, 'searchByTitle']);
});

Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'tags'], function () {
    Route::get('/', [TagController::class, 'list']);
});

