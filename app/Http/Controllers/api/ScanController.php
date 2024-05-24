<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barcode;
use Carbon\Carbon;

class ScanController extends Controller
{
    public function scanBarcode(Request $request)
    {
        $request->validate([
            'code' => 'required|string'
        ]);

        $barcode = Barcode::where('code', $request->barcode)->first();
        $pointScan = 50;

        if ($barcode) {
            $user = $request->user();
            $today = Carbon::now()->toDateString();

            // Check if the user has already scanned today
            if ($user->last_scanned_at != $today) {
                $user->update([
                    'point' => $user->point =+ $pointScan,
                    'last_scanned_at' => $today
                ]);

                return response()->json([
                    'status' => 'success',
                    'message' => 'Berhasil melakukan scan barcode',
                    'data' => $barcode
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Anda sudah melakukan scan hari ini.',
                    'data' => null
                ]);
            }
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Barcode tidak ditemukan',
                'data' => null
            ]);
        }
    }
}
