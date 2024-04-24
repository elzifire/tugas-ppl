<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostContoller extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(5);
        return view('admin.post.index', compact('posts'));
    }
}
