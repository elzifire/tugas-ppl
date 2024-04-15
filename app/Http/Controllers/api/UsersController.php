<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }
    
    public function store(Request $request)
    {
        $user = User::create($request->all());
    
        return response()->json($user, 201);
    }
    
    public function show(User $user)
    {
        return response()->json($user);
    }
    
    public function update(Request $request, User $user)
    {
        $user->update($request->all());
    
        return response()->json($user);
    }
    
    public function destroy(User $user)
    {
        $user->delete();
    
        return response()->json(null, 204);
    }
}
