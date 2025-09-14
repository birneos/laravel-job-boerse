<?php

use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;

Route::get('/',[JobController::class,'index']);

Route::get('/register',RegistredUserController::class,'create');
Route::post('/register',RegistredUserController::class,'store');

Route::get('/login',SessionController::class,'create');
Route::post('/login',SessionController::class,'store');

Route::delete('/logout',SessionController::class,'destroy');