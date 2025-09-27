<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\RegistredUserController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::get('/',[JobController::class,'index']);

Route::get('/jobs/create',[JobController::class,'create'])->middleware('auth');
Route::post('/jobs',[JobController::class,'store'])->middleware('auth');

Route::get('/search',SearchController::class);

Route::get('/tags/{tag:name}',TagController::class);  // /tags/frontend <-- looking for tag with name 'frontend'

//Route::get('/tags/{tag}',TagController::class);

/**
 * Only guests can access these routes
 * Only authenticated users can access logout route
 * 
 * Instead of using 'guest' and 'auth' middleware on each route
 * we can group them together
 * 
 * @see https://laravel.com/docs/10.x/routing#route-groups
 */
Route::middleware('guest')->group(function(){
  
  Route::get('/register',[RegistredUserController::class,'create']);
  Route::post('/register',[RegistredUserController::class,'store']);

  // // Name it LoginController or AuthController or SessionController
  Route::get('/login',[SessionController::class,'create'])->name('login');
  Route::post('/login',[SessionController::class,'store']);

});


Route::delete('/logout',[SessionController::class,'destroy'])->middleware('auth');