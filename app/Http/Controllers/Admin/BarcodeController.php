<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barcode;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class BarcodeController extends Controller
{

    public function index()
    {
        $barcodes = Barcode::all();
        return view('admin.barcodes.index', compact('barcodes'));
    }

    public function create()
    {
        $users = User::all();
        return view('admin.barcodes.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'expires_at' => 'required|date'
        ]);

        $user = User::find($request->user_id);
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $code = config('app.url') . '/' . uniqid(); // Generate unique code for barcode
        $barcode = Barcode::create([
            'code' => $code,
            'user_id' => $user->id,
            'expires_at' => Carbon::parse($request->expires_at)
        ]);

        return redirect()->route('admin.barcodes.show', $barcode->id)
                         ->with('success', 'Barcode generated successfully.');
    }

    public function show($id)
    {
        $barcode = Barcode::findOrFail($id);
        $qrCode = QrCode::size(300)->generate($barcode->code);
        return view('admin.barcodes.show', compact('barcode', 'qrCode'));
    }

    public function showScanPage()
    {
        return view('admin.barcodes.scan');
    }

    public function processScan(Request $request)
    {
        $request->validate([
            'barcode' => 'required|string'
        ]);

        $barcode = Barcode::where('code', $request->barcode)->first();

        if ($barcode && $barcode->expires_at->isFuture()) {
            $user = auth()->user();
            $today = now()->toDateString();

            if ($user->last_scanned_at != $today) {
                $user->increment('points', 50);
                $user->last_scanned_at = $today;
                $user->save();

                return redirect()->route('barcodes.scan')->with('success', 'Points added successfully!');
            } else {
                return redirect()->route('barcodes.scan')->with('error', 'You have already scanned today.');
            }
        }

        return redirect()->route('barcodes.scan')->with('error', 'Barcode not found or expired.');
    }
}