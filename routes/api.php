<?php

use App\Http\Controllers\api\auth\LoginController;
use App\Http\Controllers\api\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function(){

  Route::prefix('auth')->name('auth.')->group(function(){
    Route::post('login', [LoginController::class, 'login'])->name('login');
  });

  Route::middleware('auth:sanctum')->group(function(){
    Route::get('users', [UsersController::class, 'index'])->name('users.index');
  });


});
