<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class LeaderboardController extends Controller
{
   //memanggil semua user yang bukan admin dan mengurutkannya berdasarkan poin tertinggi dan hanya menampilkan 10 data point tertinggi
    public function index()
    {
        $users = User::orderBy('point', 'desc')->take(10)->get();
        return response()->json([
            'success' => true,
            'message' => 'List Leaderboard',
            'data' => $users
        ]);
    }
}
