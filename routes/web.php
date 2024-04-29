<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\TestController;
Route::get('/test', [TestController::class, 'testORM']);

//User routers
use App\Http\Controllers\UserController;
Route::post('/api/v1/users/create', [UserController::class, 'createdUser']);
Route::post('/api/v1/users/login', [UserController::class, 'login']);
