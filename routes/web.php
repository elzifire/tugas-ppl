<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// halaman dashboard
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// avatar
Route::resource('/images', \App\Http\Controllers\Admin\ImageController::class);

// category quiz
Route::resource('/categories', \App\Http\Controllers\Admin\QuizCategoryController::class);

//quiz
Route::resource('/quizzes', \App\Http\Controllers\Admin\QuizController::class); 
