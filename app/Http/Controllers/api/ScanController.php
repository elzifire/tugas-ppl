<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barcode;
use App\Models\User;
use Carbon\Carbon;

class ScanController extends Controller
{
    public function scanBarcode(Request $request)
    {
        // Validasi input
        $request->validate([
            'code' => 'required|string'
        ]);

        // Cari barcode berdasarkan kode
        $barcode = Barcode::where('code', $request->code)->first();
        $pointScan = 50;

        if ($barcode) {
            // Ambil user berdasarkan auth
            $user = User::find($request->user()->id);
            $today = Carbon::now()->toDateString();

            // Periksa apakah user sudah melakukan scan hari ini
            if ($user->last_scanned_at != $today) {
                // Tambah poin dan update tanggal scan terakhir user
                $user->point += $pointScan;
                $user->last_scanned_at = $today;
                $user->save();

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
