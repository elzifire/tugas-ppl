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

// route buat menampilkan kategori quiz
Route::get('/category-quiz', [\App\Http\Controllers\Api\QuizController::class, 'categoryQuiz'])->name('category-quiz')->middleware('auth:sanctum');

// route buat menghitung peringkat user bedasarkan point yang dimiliki
Route::get('/rank', [\App\Http\Controllers\Api\LeaderboardController::class, 'rank'])->name('rank')->middleware('auth:sanctum');

// route buat menampilkan reward
Route::get('/rewards', [\App\Http\Controllers\Api\RewardController::class, 'index'])->name('rewards')->middleware('auth:sanctum');

// route buat menampilkan reward berdasarkan id
Route::get('/rewards/{id}', [\App\Http\Controllers\Api\RewardController::class, 'show'])->name('rewards.show')->middleware('auth:sanctum');

// route buat menampilkan riwayat redeem reward
Route::get('/redeem-rewards', [\App\Http\Controllers\Api\RewardController::class, 'redeemPoint'])->name('redeem-rewards')->middleware('auth:sanctum');

// update user by id with image
// Route::put('/users/{id}', [UserController::class, 'update'])->middleware('auth:sanctum');