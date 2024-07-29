<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class LeaderboardController extends Controller
{
   //memanggil semua user yang bukan admin dan mengurutkannya berdasarkan poin tertinggi dan hanya menampilkan 10 data point tertinggi
    public function index()
    {
        $users = User::where('role_id', 2)->orderBy('point', 'desc')->take(10)->get();
        return response()->json([
            'success' => true,
            'message' => 'List Leaderboard',
            'data' => $users
        ]);
    }

    //menghitung peringkat user berdasarkan point yang dimiliki
    // public function rank()
    // {
    //     $users = User::where('role_id', 2)->orderBy('point', 'desc')->get();
    //     $rank = 1;
    //     foreach ($users as $key => $user) {
    //         if ($user->id == auth()->user()->id) {
    //             break;
    //         }
    //         $rank++;
    //     }
    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Your Rank',
    //         'data' => $rank
    //     ]);
    // }
}
