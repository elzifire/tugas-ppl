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
        
        //buatkan fitur search user berdasarkan nama atau email 
        if (request()->q != '') {
            $users = User::where('name', 'LIKE', '%' . request()->q . '%')
                ->orWhere('email', 'LIKE', '%' . request()->q . '%')
                ->paginate(10);
        }else  {
            $users = User::latest()->paginate(10);
        }
        
       
        return view('admin.user.index', compact('users'));
    }   

    // Mengambil semua pengguna yang bukan admin dan mengurutkannya berdasarkan poin tertinggi
    public function leaderboard()
    {
        //fitur seacrh
        if (request()->q != '') {
            $users = User::where('role_id', 2)
                ->where('name', 'LIKE', '%' . request()->q . '%')
                ->orWhere('email', 'LIKE', '%' . request()->q . '%')
                ->orderBy('point', 'desc')
                ->paginate(10);
        }else  {
            $users = User::where('role_id', 2)->orderBy('point', 'desc')->paginate(10);
        } 

        return view('admin.leaderboard.index', compact('users'));
    }



    // Menampilkan form pembuatan user
    public function create()
    {
        return view('admin.user.create');
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
        

}
