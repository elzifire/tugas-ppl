<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\QuizAPIController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::get('users', [App\Http\Controllers\Api\UsersController::class, 'index']);
// Route::post('users', [App\Http\Controllers\Api\UsersController::class, 'store']);
// Route::get('users/{user}', [App\Http\Controllers\Api\UsersController::class, 'show']);
// Route::put('users/{user}', [App\Http\Controllers\Api\UsersController::class, 'update']);
// Route::delete('users/{user}', [App\Http\Controllers\Api\UsersController::class, 'destroy']);
Route::resource('/users',  \App\Http\Controllers\Api\UsersController::class);


// Route::get('/posts', [\App\Http\Controllers\Api\PostContoller::class, 'index']);

// route buat avatar
Route::get('/images', [\App\Http\Controllers\Api\ImageController::class, 'index']);

// route buat menampilkan quiz 
// Route::get('/quiz', [\App\Http\Controllers\Api\QuizController::class, 'index']);
Route::get('/quizzes', [\App\Http\Controllers\Api\QuizController::class, 'index'])->name('quizzes.index');
    