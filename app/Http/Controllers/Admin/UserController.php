<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // Menampilkan semua user
    public function index()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    // Menampilkan form pembuatan user
    public function create()
    {
        return view('admin.user.create');
    }

    // Menyimpan user baru ke dalam database
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk file gambar
        ]);

        // Upload image
        $image = $request->file('image');
        $imagePath = $image->storeAs('public/users', $image->hashName());

        // Create new user
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->image = $imagePath;
        $user->save();

        return redirect()->route('user.index')->with('success', 'User created successfully');
    }

    // Menampilkan form edit user
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    // Mengupdate data user ke dalam database
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
                'role' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk file gambar
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->role = $request->role;

        // Jika ada gambar yang diupload
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            Storage::delete($user->image);

            // Upload gambar baru
            $image = $request->file('image');
            $imagePath = $image->storeAs('public/users', $image->hashName());
            $user->image = $imagePath;
        }

        $user->save();

        return redirect()->route('user.index')->with('success', 'User updated successfully');
    }

    // Menghapus user dari database
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Hapus gambar user
        Storage::delete($user->image);

        $user->delete();

        return redirect()->route('user.index')->with('success', 'User deleted successfully');
    }

}
