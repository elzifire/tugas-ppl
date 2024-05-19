<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reward;
use App\Models\User;

class RewardController extends Controller
{
    public function index()
    {
        $reward = Reward::all();
        return response()->json([
            'status' => 'success',
            'data' => $reward
        ]);
    }

    public function redeemPoint(Request $request)
    {
        $reward = Reward::find($request->id);
        $user = User::find($request->user()->id);
        

        if ($user->point >= $reward->point) {
            $user->update([
                'point' => $user->point - $reward->point
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil redeem reward',
                'data' => $reward
            ]);
        } else if ($user->point < $reward->point) {
            return response()->json([
                'status' => 'error',
                'message' => 'Point tidak cukup',
                'data' => null
            ]);
        }else {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal redeem reward',
                'data' => null
            ]);
        }
    }
}
