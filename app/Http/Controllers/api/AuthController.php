<?php

namespace App\Http\Controllers\Api;

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
        $input['point'] = 50;
        $user = User::create($input);

        $success['token'] = $user->createToken('auth_token')->plainTextToken;
        $success['name'] = $user->name;

        return response()->json([
            'success' => true,
            'message' => 'User registered successfully and get 50 point.',
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
                'success' => true,
                'message' => 'Login sukses',
                'data' => $success
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Cek email dan password lagi',
                'data' => null
            ]);
        }
    }

    public function userDetails(Request $request)
    {
        $user = Auth::user();

        return response()->json([
            'success' => true,
            'message' => 'Detail user berhasil diambil',
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