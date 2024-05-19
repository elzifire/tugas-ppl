<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Misi;

class MisiController extends Controller
{
    public function index()
    {
        $misi = Misi::all();
        return response()->json([
            'status' => 'success',
            'data' => $misi
        ]);
    }

    public function dailyReward(Request $request)
    {
        $date = date('Y-m-d');

        $misi = Misi::where('type', 'daily')->where('start_date', '<=', $date)->where('end_date', '>=', $date)->first();
        if ($misi) {
            $user = User::find($request->user()->id);
            $user->update([
                'point' => $user->point + $misi->point
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil mendapatkan reward',
                'data' => $misi
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Tidak ada reward yang bisa didapatkan',
                'data' => null
            ]);
        }
    }
}
