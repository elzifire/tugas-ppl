<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QuizCategory;
use Carbon\Carbon;

class QuizCategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    // Method untuk menampilkan semua kategori kuis
    public function index()
    {
        // Ambil semua kategori kuis dari database
        $categories = QuizCategory::all();

        // Kirim data kategori kuis ke view
        return view('admin.categories.index', compact('categories'));
    }

    // Method untuk menampilkan form tambah kategori kuis
    public function create()
    {
        // Tampilkan form tambah kategori kuis
        return view('admin.categories.create');
    }

    // Method untuk menyimpan kategori kuis baru
    public function store(Request $request)
    {
        // Validasi data input dari form
        $request->validate([
            'name' => 'required|unique:quiz_categories|max:255',
        ]);

        // $date = Carbon::now(); 

        // Simpan kategori kuis baru ke database
        QuizCategory::create($request->all());

        // Redirect ke halaman index kategori kuis
        return redirect()->route('categories.index')
                         ->with('success','Kategori kuis berhasil ditambahkan.');
    }

    // Method untuk menampilkan detail kategori kuis
    public function show($id)
    {
        // Temukan kategori kuis berdasarkan ID
        $category = QuizCategory::find($id);

        // Tampilkan halaman detail kategori kuis
        return view('admin.categories.show', compact('category'));
    }

    // Method untuk menampilkan form edit kategori kuis
    public function edit($id)
    {
        // Temukan kategori kuis berdasarkan ID
        $category = QuizCategory::find($id);

        // Tampilkan form edit kategori kuis
        return view('admin.categories.edit', compact('category'));
    }

    // Method untuk menyimpan perubahan pada kategori kuis
    public function update(Request $request, $id)
    {
        // Validasi data input dari form
        $request->validate([
            'name' => 'required|unique:quiz_categories,name,'.$id,
        ]);

        // Temukan kategori kuis berdasarkan ID dan perbarui data
        QuizCategory::find($id)->update($request->all());

        // Redirect ke halaman index kategori kuis
        return redirect()->route('categories.index')
                         ->with('success','Kategori kuis berhasil diperbarui.');
    }

    // Method untuk menghapus kategori kuis
    public function destroy($id)
    {
        // Temukan kategori kuis berdasarkan ID dan hapus
        QuizCategory::find($id)->delete();

        // Redirect ke halaman index kategori kuis
        return redirect()->route('categories.index')
                         ->with('success','Kategori kuis berhasil dihapus.');
    }
}
