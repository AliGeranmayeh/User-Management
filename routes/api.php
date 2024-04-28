<?php

use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// Route::post('register', [AuthenticationController::class, 'register'])->name('register');
Route::post('/login', [AuthenticationController::class, 'login'])->name('login');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('logout', [AuthenticationController::class, 'logout'])->name('logout');

    Route::middleware(['admin.check'])->group(function () {
        Route::get('users', [UserController::class,'index'])->name('users.index');
        Route::post('users', [UserController::class,'store'])->name('users.store');
        Route::patch('users/{user}', [UserController::class,'update'])->name('users.update');
        Route::delete('users/{user}', [UserController::class,'destroy'])->name('users.destroy');
        Route::get('users/{id}', [UserController::class,'show'])->name('users.show');
    });

});
