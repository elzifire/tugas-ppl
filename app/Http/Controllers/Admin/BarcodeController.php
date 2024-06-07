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

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $barcodes = Barcode::latest()->paginate(5);
        return view('admin.barcodes.index', compact('barcodes'));
    }

    public function show($id)
    {
        $barcode = Barcode::findOrFail($id);
        $qrCode = QrCode::size(300)->generate($barcode->code);
        return view('admin.barcodes.show', compact('barcode', 'qrCode'));
    }

    public function create()
    {
        $users = User::all();
        return view('admin.barcodes.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'expires_at' => 'required|date'
        ]);


        // $code = config('app.url') . '/' . uniqid();
         // Generate unique code for barcode
        $code = uniqid();
        $barcode = Barcode::create([
            'code' => $code,
            'expires_at' => Carbon::parse($request->expires_at)
        ]);

        return redirect()->route('admin.barcodes.show', $barcode->id)
                         ->with('success', 'Barcode generated successfully.');
    }

    

    public function showScanPage()
    {
        return view('admin.barcodes.scan');
    }

    
}