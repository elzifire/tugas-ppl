<?php
namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reward;
use App\Models\User;
use App\Models\RedeemReward;

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

    public function show($id)
    {
        $reward = Reward::find($id);
        if (!$reward) {
            return response()->json([
                'status' => 'error',
                'message' => 'Reward tidak ditemukan',
                'data' => null
            ]);
        }

        return response()->json([
            'status' => 'success',
            'data' => $reward
        ]);
    }

    public function redeemPoint(Request $request)
    {
        if ($request->user()->role_id != 2) {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda tidak bisa redeem point',
                'data' => null
            ]);
        }

        $reward = Reward::find($request->id);
        if (!$reward) {
            return response()->json([
                'status' => 'error',
                'message' => 'Reward tidak ditemukan',
                'data' => null
            ]);
        }

        $user = User::find($request->user()->id);

        if ($user->point >= $reward->point) {
            if ($reward->stock > 0) {
                $user->update([
                    'point' => $user->point - $reward->point
                ]);

                $reward->update([
                    'stock' => $reward->stock - 1
                ]);

                // Simpan riwayat redeem reward
                RedeemReward::create([
                    'user_id' => $user->id,
                    'reward_id' => $reward->id,
                    'point' => $reward->point
                ]);

                return response()->json([
                    'status' => 'success',
                    'message' => 'Berhasil redeem reward',
                    'data' => $reward
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Stok reward tidak mencukupi',
                    'data' => null
                ]);
            }
        } else if ($user->point < $reward->point){
            return response()->json([
                'status' => 'error',
                'message' => 'Point tidak cukup',
                'data' => null
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal redeem reward',
                'data' => null
            ]);
        }
    }

    public function history(Request $request)
    {
        $redeemRewards = RedeemReward::where('user_id', $request->user()->id)
                                     ->with('user')
                                     ->get();

        $data = $redeemRewards->map(function ($redeemReward) {
            return [
                'id' => $redeemReward->id,
                'user_name' => $redeemReward->user->name, 
                'reward_id' => $redeemReward->reward->name, 
                'point' => $redeemReward->point,
                'created_at' => $redeemReward->created_at,
                'updated_at' => $redeemReward->updated_at,
            ];
        });

        if ($data->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Riwayat redeem reward tidak ditemukan',
                'data' => null
            ], 404);
        }else{
            return response()->json([
                'status' => 'success',
                'data' => $data
            ], 200);
        }
    }
}
