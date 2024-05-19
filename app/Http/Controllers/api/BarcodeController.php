<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barcode;

class BarcodeController extends Controller
{
    // scan barcode
    public function scanBarcode(Request $request)
    {
        $barcode = $request->barcode;
        $user = $request->user();

        $barcode = Barcode::where('barcode', $barcode)->whereDate('scan_date')->first();
        if ($barcode) {
            $user->update([
                'point' => $user->point + $barcode->point
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil mendapatkan point',
                'data' => $barcode
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Barcode tidak valid',
                'data' => null
            ]);
        }
    }
}
