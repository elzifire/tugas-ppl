<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QuizCategory;
use App\Models\Quiz;
use App\Models\QuizAccess;
use Carbon\Carbon;

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

        // Ambil id pengguna dari request (asumsi Anda menggunakan autentikasi JWT atau sejenisnya)
        $userId = $request->user()->id;

        // Hitung akses kuis pengguna dalam 24 jam terakhir
        $accessCount = QuizAccess::where('user_id', $userId)
            ->where('created_at', '>=', Carbon::now()->subDay())
            ->count();

        // Jika akses melebihi 10 kali, kembalikan respon dengan status 429 (Too Many Requests)
        if ($accessCount >= 10) {
            return response()->json(['message' => 'Anda telah mencapai batas akses kuis harian'], 429);
        }

        // Catat akses kuis
        QuizAccess::create([
            'user_id' => $userId,
            'quiz_id' => $categoryId,
        ]);

        // Ambil semua kuis dari kategori yang diberikan
        $quizzes = Quiz::latest()->where('category_id', $categoryId)->get();

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

    //menampilkan QuizAccess yang sudah diakses oleh user bedasarkan user yang login pada 24 jam terakhir
    public function quizAccess(Request $request)
    {
        // Ambil akses kuis pengguna dalam 24 jam terakhir
        $accesses = QuizAccess::where('user_id', auth()->user()->id)
            ->where('created_at', '>=', Carbon::now()->subDay())
            ->get();

        // Kembalikan daftar akses kuis dalam bentuk respons JSON
       if ($accesses->isEmpty()) {
           return response()->json([
               'status' => 'error',
               'message' => 'Riwayat akses kuis tidak ditemukan',
               'data' => null
           ], 404);
       }else{
           return response()->json([
               'status' => 'success',
               'data' => $accesses
           ], 200);
       }
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
