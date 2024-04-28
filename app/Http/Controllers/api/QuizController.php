<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QuizCategory;
use App\Models\Quiz;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

        // Kembalikan daftar kuis dalam bentuk respons JSON
        return response()->json(['quizzes' => $quizzes]);
    }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
