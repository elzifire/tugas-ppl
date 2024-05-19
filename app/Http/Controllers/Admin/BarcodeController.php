<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barcode;
use \Milon\Barcode\Facades\DNS1DFacade as DNS1D;
use \Milon\Barcode\Facades\DNS2DFacade as DNS2D;
class BarcodeController extends Controller
{
    public function index()
    {
        $barcodes = Barcode::all();
        // $barcode = DNS1D::getBarcodeHTML('4445645656', 'EAN13');
        
        $barcode = DNS2D::getBarcodeHTML('4445645656', 'QRCODE');
        return view('admin.barcodes.index', compact('barcodes' , 'barcode'));
    }
    
    public function create()
    {
        return view('admin.barcodes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'barcode' => 'required',
            'point' => 'required',
        ]);

        Barcode::create([
            'barcode' => $request->barcode,
            'point' => $request->point,
            'status' => 'active',
            'scan_date' => null,
            'user_id' => null
        ]);

        return redirect()->route('barcodes.index')->with('success', 'Barcode berhasil ditambahkan');
    }
}
