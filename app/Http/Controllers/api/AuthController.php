<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['point'] = 25;
        $input['role_id'] = 2; // 2 adalah role 'user'
        $input['status_id'] = 1; // 1 adalah status 'active'
        $user = User::create($input);

        $success['token'] = $user->createToken('auth_token')->plainTextToken;
        $success['name'] = $user->name;

        return response()->json([
            'success' => true,
            'message' => 'User registered successfully and get 25 point.',
            'data' => $success
        ]);
    }
    
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $auth = Auth::User();
            $success['token'] = $auth->createToken('auth_token')->plainTextToken;            
            $success['name'] = $auth->name;
            $success['email'] = $auth->email;
            
            return response()->json([
                'message' => 'Login sukses',
                'data' => $success
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Cek email dan password lagi',
                'data' => null
            ], 401);
        }
    }

    public function userDetails(Request $request)
    {
        // get user yang sedang login lalu itu peringkat user berdasarkan point yang dimiliki
        $user = Auth::user();
        $users = User::where('role_id', 2)->orderBy('point', 'desc')->get();
        $rank = 1;
        foreach ($users as $key => $user) {
            if ($user->id == auth()->user()->id) {
                break;
            }
            $rank++;
        }

        $result = [
            'name' => $user->name,
            'email' => $user->email,
            'point' => $user->point,
            'rank' => $rank,
            'image' => $user->image,
        ]; 

        return response()->json([
            'success' => true,
            'message' => 'User details',
            'data' => $result,
        ]);
       
    }

    
    // update user by id with upload image
    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('public/images');
            $user->image = $path;
        }

        $user->name = $request->name;
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'User berhasil diupdate',
            'data' => $user
        ]);
    }
    

    public function addPoints(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'points' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user->point += $request->points;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Points added successfully.',
            'data' => $user
        ]);
    }


    public function logout(Request $request)
    {
        // get user yang sedang login
        $user = Auth::user();
        // hapus token yang sedang digunakan
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();

        // kembalikan response
        return response()->json([
            'success' => true,
            'message' => 'Logout berhasil',
            'data' => null
        ]);

    }    

    

}