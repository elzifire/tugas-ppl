<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\QuizCategory;
use Illuminate\Support\Facades\Storage;

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

    
    public function store(Request $request)
    {
        $this->validate($request,[
            'image' => 'image',
            'category_id' => 'required',
            'question' => 'required',
            'option_a' => 'required',
            'option_b' => 'required',
            'option_c' => 'required',
            'option_d' => 'required',
            'correct_answer' => 'required'
        ]);

            $image = $request->file('image');
           $image->storeAs('public/quiz', $image->hashName());

           Quiz::create([
            'image' => $image->hashName(),
            'category_id' => $request->category_id,
            'question' => $request->question,
            'option_a' => $request->option_a,
            'option_b' => $request->option_b,
            'option_c' => $request->option_c,
            'option_d' => $request->option_d,
            'correct_answer' => $request->correct_answer,
           ]);

           return redirect()->route('quizzes.index')->with(['success' => 'sukses']);
    }

    public function show($id)
    {
        // Temukan kuis berdasarkan ID
        $quiz = Quiz::find($id);

        // Tampilkan halaman detail kuis
        return view('admin.quizzes.show', compact('quiz'));
    }

    public function edit($id)
    {
        // Temukan kuis berdasarkan ID
        $quiz = Quiz::find($id);

        // Ambil semua kategori kuis
        $categories = QuizCategory::all();

        // Tampilkan form edit kuis
        return view('admin.quizzes.edit', compact('quiz', 'categories'));
    }

    

    // Method untuk menghapus kuis
    public function destroy($id)
    {
        // Temukan kuis berdasarkan ID
        $quiz = Quiz::findOrFail($id);

        // Hapus gambar terkait jika ada
        if ($quiz->image) {
            Storage::delete('public/quiz/' . $quiz->image);
        }

        // Hapus kuis
        $quiz->delete();

        // Redirect ke halaman index kuis
        return redirect()->route('quizzes.index')
            ->with('success', 'Kuis berhasil dihapus.');
    }
}
