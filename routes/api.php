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
// route buat menambahkan point
Route::post('add-points', [AuthController::class, 'addPoints'])->middleware('auth:sanctum');  
// route buat menampilkan quiz 
Route::get('/quizzes', [\App\Http\Controllers\Api\QuizController::class, 'index'])->middleware('auth:sanctum');
Route::get('/quizzes/{id}', [\App\Http\Controllers\Api\QuizController::class, 'show'])->name('quizzes.show')->middleware('auth:sanctum');

// route buat daily reward
Route::get('/daily-reward', [\App\Http\Controllers\Api\MisiController::class, 'dailyReward'])->name('daily-reward')->middleware('auth:sanctum');

// route buat scan barcode
Route::post('/scan-barcode', [\App\Http\Controllers\Api\ScanController::class, 'scanBarcode'])->name('scan-barcode')->middleware('auth:sanctum');

// route buat redeem point
Route::post('/redeem-point', [\App\Http\Controllers\Api\RewardController::class, 'redeemPoint'])->name('redeem-point')->middleware('auth:sanctum');