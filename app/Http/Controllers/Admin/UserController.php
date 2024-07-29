<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Status;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;

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

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $statuses = Status::all();
        $roles = Role::all();
        return view('admin.user.edit', compact('user', 'statuses', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validasi input
        $validator = Validator::make($request->all(), [
            'status_id' => 'nullable|exists:statuses,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Mengupdate data user 
        $user->status_id = $request->input('status_id');
        $user->save();

        if ($user) {
            return redirect()->route('user.index')->with('success', 'User berhasil diupdate');
        } else {
            return redirect()->route('user.index')->with('error', 'User gagal diupdate');
        }
    }

}
