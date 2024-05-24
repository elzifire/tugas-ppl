<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\BarcodeController;
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

Route::resource('/user', \App\Http\Controllers\Admin\UserController::class);

// route buat menambahkan barcode
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/barcodes', [BarcodeController::class, 'index'])->name('barcodes.index');
    Route::get('/barcodes/create', [BarcodeController::class, 'create'])->name('barcodes.create');
    Route::post('/barcodes', [BarcodeController::class, 'store'])->name('barcodes.store');
    Route::get('/barcodes/{id}', [BarcodeController::class, 'show'])->name('barcodes.show');
});

    

