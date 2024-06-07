<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\QuizCategory;
use Illuminate\Support\Facades\Storage;

class QuizController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    // Method untuk menampilkan semua kuis
    public function index(Request $request)
    {
        $category_id = $request->input('category_id');
        
        // Ambil semua kategori
        $categories = QuizCategory::all();

        // Ambil kuis berdasarkan kategori yang dipilih, jika ada
        $quizzesQuery = Quiz::query();
        if ($category_id) {
            $quizzesQuery->where('category_id', $category_id);
        }
        $quizzes = $quizzesQuery->paginate(10);

        // Kirim data kuis dan kategori ke view
        return view('admin.quizzes.index', compact('quizzes', 'categories', 'category_id'));
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
            $this->validate($request, [
                // 'image' => 'nullable|image',
                'category_id' => 'required',
                'question' => 'required',
                'option_a' => 'required',
                'option_b' => 'required',
                'option_c' => 'required',
                'option_d' => 'required',
                'correct_answer' => 'required'
            ]);

            // upload image
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image->storeAs('public/quiz', $image->hashName());
            }

            // $image = $request->file('image');
            // $image->storeAs('public/quiz', $image->hashName());
    
            // Inisialisasi data kuis
            $quizData = Quiz::create([
                'category_id' => $request->category_id,
                'question' => $request->question,
                'option_a' => $request->option_a,
                'option_b' => $request->option_b,
                'option_c' => $request->option_c,
                'option_d' => $request->option_d,
                'correct_answer' => $request->correct_answer,
                'image' => $image->hashName(),
            ]);

            

            if($quizData){
                // Redirect ke halaman index kuis dengan pesan sukses
                return redirect()->route('quizzes.index')
                    ->with('success', 'Kuis berhasil ditambahkan.');
            } else {
                // Redirect ke halaman index kuis dengan pesan error
                return redirect()->route('quizzes.index')
                    ->with('error', 'eror');
            }
        }

    // Method untuk menampilkan detail kuis
    public function show($id)
    {
        // Temukan kuis berdasarkan ID
        $quiz = Quiz::findOrFail($id);

        // Tampilkan halaman detail kuis
        return view('admin.quizzes.show', compact('quiz'));
    }

    // Method untuk menampilkan form edit kuis
    public function edit($id)
    {
        // Temukan kuis berdasarkan ID
        $quiz = Quiz::findOrFail($id);

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

        // Redirect ke halaman index kuis dengan pesan sukses
        return redirect()->route('quizzes.index')
            ->with('success', 'Kuis berhasil dihapus.');
    }
}
?>
