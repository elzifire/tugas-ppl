<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\QuizCategory;

class QuizController extends Controller
{
    // Method untuk menampilkan semua kuis
    public function index()
    {
        // Ambil semua kuis dari database
        $quizzes = Quiz::all();

        // Kirim data kuis ke view
        return view('admin.quizzes.index', compact('quizzes'));
    }

    // Method untuk menampilkan form tambah kuis
    public function create()
    {
        // Ambil semua kategori kuis
        $categories = QuizCategory::all();

        // Tampilkan form tambah kuis
        return view('admin.quizzes.create', compact('categories'));
    }

    // Method untuk menyimpan kuis baru
    public function store(Request $request)
    {
        // Validasi data input dari form
        $request->validate([
            'category_id' => 'required',
            'question' => 'required',
            'option_a' => 'required',
            'option_b' => 'required',
            'option_c' => 'required',
            'option_d' => 'required',
            'correct_answer' => 'required',
        ]);

        // Simpan kuis baru ke database
        Quiz::create($request->all());

        // Redirect ke halaman index kuis
        return redirect()->route('quizzes.index')
                         ->with('success','Kuis berhasil ditambahkan.');
    }

    // Method untuk menampilkan detail kuis
    public function show($id)
    {
        // Temukan kuis berdasarkan ID
        $quiz = Quiz::find($id);

        // Tampilkan halaman detail kuis
        return view('admin.quizzes.show', compact('quiz'));
    }

    // Method untuk menampilkan form edit kuis
    public function edit($id)
    {
        // Temukan kuis berdasarkan ID
        $quiz = Quiz::find($id);

        // Ambil semua kategori kuis
        $categories = QuizCategory::all();

        // Tampilkan form edit kuis
        return view('admin.quizzes.edit', compact('quiz', 'categories'));
    }

    // Method untuk menyimpan perubahan pada kuis
    public function update(Request $request, $id)
    {
        // Validasi data input dari form
        $request->validate([
            'category_id' => 'required',
            'question' => 'required',
            'option_a' => 'required',
            'option_b' => 'required',
            'option_c' => 'required',
            'option_d' => 'required',
            'correct_answer' => 'required',
        ]);

        // Temukan kuis berdasarkan ID dan perbarui data
        Quiz::find($id)->update($request->all());

        // Redirect ke halaman index kuis
        return redirect()->route('quizzes.index')
                         ->with('success','Kuis berhasil diperbarui.');
    }

    // Method untuk menghapus kuis
    public function destroy($id)
    {
        // Temukan kuis berdasarkan ID dan hapus
        Quiz::find($id)->delete();

        // Redirect ke halaman index kuis
        return redirect()->route('quizzes.index')
                         ->with('success','Kuis berhasil dihapus.');
    }
}
