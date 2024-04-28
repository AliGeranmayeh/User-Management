<?php

use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\QuestionBankController;

/* |-------------------------------------------------------------------------- | API Routes |-------------------------------------------------------------------------- | | Here is where you can register API routes for your application. These | routes are loaded by the RouteServiceProvider within a group which | is assigned the "api" middleware group. Enjoy building your API! | */


// Route::post('register', [AuthenticationController::class, 'register'])->name('register');
Route::post('/login', [AuthenticationController::class , 'login'])->name('login');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('logout', [AuthenticationController::class , 'logout'])->name('logout');

    Route::middleware(['admin.check'])->group(function () {
            Route::get('users', [UserController::class , 'index'])->name('users.index');
            Route::post('users', [UserController::class , 'store'])->name('users.store');
            Route::patch('users/{user}', [UserController::class , 'update'])->name('users.update');
            Route::delete('users/{user}', [UserController::class , 'destroy'])->name('users.destroy');
            Route::get('users/{id}', [UserController::class , 'show'])->name('users.show');


            Route::post('users/{user}/goals', [GoalController::class , 'store'])->name('goal.store');
            Route::middleware(['ownership.check'])->group(function () {
                    Route::get('users/{user}/goals/{goal}', [GoalController::class , 'show'])->name('goal.show');
                    Route::patch('users/{user}/goals/{goal}', [GoalController::class , 'update'])->name('goal.update');
                    Route::delete('users/{user}/goals/{goal}', [GoalController::class , 'delete'])->name('goal.delete');

                }
                );


                Route::get('goals/{goal}/tasks/{task}', [TaskController::class , 'show'])->name('task.show');
                Route::post('goals/{goal}/tasks', [TaskController::class , 'store'])->name('task.store');
                Route::patch('goals/{goal}/tasks/{task}', [TaskController::class , 'update'])->name('task.update');
                Route::delete('goals/{goal}/tasks/{task}', [TaskController::class , 'delete'])->name('task.delete');

                Route::get('goals/{goal}/reviews/{review}', [ReviewController::class , 'show'])->name('review.show');
                Route::post('goals/{goal}/reviews', [ReviewController::class , 'store'])->name('review.store');
                Route::patch('goals/{goal}/reviews/{review}', [ReviewController::class , 'update'])->name('review.update');
                Route::delete('goals/{goal}/reviews/{review}', [ReviewController::class , 'delete'])->name('review.delete');
            }
            );

            Route::get('questions', [QuestionBankController::class , 'index'])->name('questions.index');
            Route::post('questions', [QuestionBankController::class , 'store'])->name('questions.store');
            Route::patch('questions/{question}', [QuestionBankController::class , 'update'])->name('question.update');
            Route::delete('questions/{question}', [QuestionBankController::class , 'destroy'])->name('question.destroy');
            Route::get('questions/{question}', [QuestionBankController::class , 'show'])->name('question.show');
        });
