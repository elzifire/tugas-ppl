<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QuizCategory;
use App\Models\Quiz;

class QuizController extends Controller
{
    public function index(Request $request)
    {
        // Ambil id kategori dari request
        $categoryId = $request->input('category_id');

        // Temukan kategori berdasarkan id
        $category = QuizCategory::find($categoryId);

        // Jika kategori tidak ditemukan, kembalikan respon dengan status 404
        if (!$category) {
            return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
        }

        // Ambil semua kuis dari kategori yang diberikan
        $quizzes = Quiz::where('category_id', $categoryId)->get();

        // Random urutan kuis
        $shuffledQuizzes = $quizzes->shuffle();

        // Bagi hasil random menjadi grup-grup yang masing-masing berisi 10 kuis
        $chunkedQuizzes = $shuffledQuizzes->chunk(10);

        // Konversi setiap grup menjadi array
        $result = $chunkedQuizzes->map(function ($chunk) {
            return $chunk->values();
        });

        // Kembalikan daftar kuis dalam bentuk respons JSON
        return response()->json(['quizzes' => $result]);
    }

    public function categoryQuiz()
    {
        // Ambil semua kategori kuis
        $categories = QuizCategory::all();

        // Kembalikan daftar kategori kuis dalam bentuk respons JSON
        return response()->json(['categories' => $categories]);
    }

    public function show(Request $request)
    {
        // Ambil id kuis dari request
        $quizId = $request->route('id');

        // Temukan kuis berdasarkan id
        $quiz = Quiz::find($quizId);

        // Jika kuis tidak ditemukan, kembalikan respon dengan status 404
        if (!$quiz) {
            return response()->json(['message' => 'Kuis tidak ditemukan'], 404);
        }

        // Kembalikan detail kuis dalam bentuk respons JSON
        return response()->json(['quiz' => $quiz]);
    }

}
