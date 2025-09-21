<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\RegistredUserController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

Route::get('/',[JobController::class,'index']);

Route::get('/register',[RegistredUserController::class,'create']);
Route::post('/register',[RegistredUserController::class,'store']);

// // Name it LoginController or AuthController or SessionController
Route::get('/login',[SessionController::class,'create'])->name('login');
Route::post('/login',[SessionController::class,'store']);

Route::delete('/logout',[SessionController::class,'destroy']);