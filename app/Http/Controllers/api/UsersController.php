<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use File;

class UsersController extends Controller
{
    // Menampilkan semua user
    public function index()
    {
        $users = User::all();
        return response()->json(['users' => $users], 200);
    }

    // Menyimpan user baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk file gambar
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Simpan gambar jika ada
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $imagePath = '/images/' . $imageName;
        } else {
            $imagePath = ''; // Jika tidak ada gambar yang diunggah
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->image = $imagePath; // Simpan path gambar ke dalam kolom 'image'
        $user->save();

        return response()->json(['user' => $user], 201);
    }

    // Menampilkan detail user
    public function show(User $user)
    {
        return response()->json(['user' => $user], 200);
    }

    
    // Menghapus user
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['message' => 'User deleted successfully'], 200);
    }
}
