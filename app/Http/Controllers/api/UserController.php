<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    // Mengupdate data user ke dalam database
    public function update(Request $request, $id)
    {
        // validate form
        $this->validate($request, [
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

        //return response with message
        return response()->json([
            'success' => true,
            'message' => 'User updated successfully',
            'data' => $user
        ]);
    }
}
