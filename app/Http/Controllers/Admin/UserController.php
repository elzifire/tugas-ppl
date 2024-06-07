<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    // Menampilkan semua user
    public function index()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    // menampilkan leaderboard berdasarkan point tertinggi dan role = admin tidak boleh tampil
    public function leaderboard()
    {
        $users = User::where('role', 'pengunjung')->orderBy('point', 'desc')->get();
        return view('admin.leaderboard.index', compact('users'));
    }



    // Menampilkan form pembuatan user
    public function create()
    {
        return view('admin.user.create');
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
        // validate form
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // get user by id
        $user = User::findOrFail($id);

        // check if image uploaded
        if ($request->hasFile('image')) {
            // upload new image
            $image = $request->file('image');
            $image->storeAs('public/users', $image->hashName());

            // delete old image
            Storage::delete($user->image);

            // update user with new image
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'image' => $image->hashName(),
            ]);
           
        } else {
            // update user without image
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);
        
        }

            //return redict with message
           if ($user) {
            
            return redirect()->route('user.index')->with('success', 'User updated successfully');
           }else{
            return redirect()->route('user.index')->with('danger', 'User failed to update');
           }

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
