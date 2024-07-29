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
            // Validasi data kuis
            $this->validate($request, [
                'category_id' => 'required',
                'question' => 'required',
                'option_a' => 'required',
                'option_b' => 'required',
                'option_c' => 'required',
                'option_d' => 'required',
                'correct_answer' => 'required'
            ]);
    
            // upload image 
           $imageName = time().'.'.$request->image->extension();
           $request->image->move(public_path('images'), $imageName);
            
            // Inisialisasi data kuis
            $quiz = new Quiz;
            $quiz->category_id = $request->category_id;
            $quiz->question = $request->question;
            $quiz->option_a = $request->option_a;
            $quiz->option_b = $request->option_b;
            $quiz->option_c = $request->option_c;
            $quiz->option_d = $request->option_d;
            $quiz->correct_answer = $request->correct_answer;
                    
            $quiz->save();
    
            // Redirect ke halaman index kuis dengan pesan sukses
            return redirect()->route('quizzes.index')
                ->with('success', 'Kuis berhasil ditambahkan.');
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

    // buatkan method buat update kuis
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'question' => 'required',
            'option_a' => 'required',
            'option_b' => 'required',
            'option_c' => 'required',
            'option_d' => 'required',
            'correct_answer' => 'required'
        ]);

        // Temukan kuis berdasarkan ID
        $quiz = Quiz::findOrFail($id);

        // upload image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->storeAs('public/quiz', $image->hashName());
        }

        // Inisialisasi data kuis
        $quiz->category_id = $request->category_id;
        $quiz->question = $request->question;
        $quiz->option_a = $request->option_a;
        $quiz->option_b = $request->option_b;
        $quiz->option_c = $request->option_c;
        $quiz->option_d = $request->option_d;
        $quiz->correct_answer = $request->correct_answer;
        if ($request->hasFile('image')) {
            $quiz->image = $image->hashName();
        }
        $quiz->save();

        // Redirect ke halaman index kuis dengan pesan sukses
        return redirect()->route('quizzes.index')
            ->with('success', 'Kuis berhasil diupdate.');
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
