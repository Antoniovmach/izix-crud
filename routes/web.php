<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


 Route::get('/', function () {
     return view('welcome');
 });

//Route::get('/users', [UserController::class, 'index']);

Route::get('/createusers', [UserController::class, 'create']);

Route::get('/users', [UserController::class, 'index'])->name('users.index');




// Route::get('/userById/{id}', [UserController::class, 'showById']);


// Route::get('/userByEmail/{email}', [UserController::class, 'showByEmail']);
