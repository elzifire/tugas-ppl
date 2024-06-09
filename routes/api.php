<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\api\UserController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// register
Route::post('register', [AuthController::class, 'register']);
// login
Route::post('login', [AuthController::class, 'login']);
// logout
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
// get user details
Route::get('user-details', [AuthController::class, 'userDetails'])->middleware('auth:sanctum');
// update user by id
Route::put('/users/{id}', [UserController::class, 'update'])->middleware('auth:sanctum');

// route buat menambahkan point
Route::post('add-points', [AuthController::class, 'addPoints'])->middleware('auth:sanctum');
// route buat menampilkan quiz 
Route::get('/quizzes', [\App\Http\Controllers\Api\QuizController::class, 'index'])->middleware('auth:sanctum');
// route buat menampilkan quiz berdasarkan id
Route::get('/quizzes/{id}', [\App\Http\Controllers\Api\QuizController::class, 'show'])->name('quizzes.show')->middleware('auth:sanctum');

// route buat daily reward
Route::get('/daily-reward', [\App\Http\Controllers\Api\MisiController::class, 'dailyReward'])->name('daily-reward')->middleware('auth:sanctum');

// route buat scan barcode
Route::post('/scan-barcode', [\App\Http\Controllers\Api\ScanController::class, 'scanBarcode'])->name('scan- barcode')->middleware('auth:sanctum');

// route buat redeem point
Route::post('/redeem-point', [\App\Http\Controllers\Api\RewardController::class, 'redeemPoint'])->name('redeem-point')->middleware('auth:sanctum');

// route buat leaderboard
Route::get('/leaderboard', [\App\Http\Controllers\Api\LeaderboardController::class, 'index'])->name('leaderboard')->middleware('auth:sanctum');