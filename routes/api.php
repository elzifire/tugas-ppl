<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
    

});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('user-details', [AuthController::class, 'userDetails'])->middleware('auth:sanctum');
Route::put('update-profile', [AuthController::class, 'updateProfile'])->middleware('auth:sanctum');
Route::put('update-user', [AuthController::class, 'update'])->middleware('auth:sanctum'); 
Route::post('add-points', [AuthController::class, 'addPoints'])->middleware('auth:sanctum');  
// route buat menampilkan quiz 
Route::get('/quizzes', [\App\Http\Controllers\Api\QuizController::class, 'index'])->name('quizzes.index')->middleware('auth:sanctum');
    