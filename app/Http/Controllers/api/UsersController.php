<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    // Menampilkan semua user
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    // Menampilkan form pembuatan user
    public function create()
    {
        // Logika tidak diperlukan dalam API
    }

    // Menyimpan user baru ke dalam database
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk file gambar
            
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/users', $image->hashName());

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'image' => $image->hashName(), // Simpan path gambar
            
        ]);

        return response()->json(['message' => 'User created successfully']);
    }
}
