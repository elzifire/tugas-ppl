<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ImageController extends Controller
{
    // menampilkan semua data
    public function index(): View
    {
        $images = Image::all();
        return view('admin.images.index', compact('images'));
    }

    public function create()
    {
        return view('admin.images.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'image'     => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/photos', $image->hashName());

        Image::create([
            'image'     => $image->hashName(),
            
        ]);

        return redirect()->route('images.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }


    public function destroy($id)
    {
        // find image by id
        $image = Image::findOrFail($id);

        // delete file in storage 
        Storage::delete('public/photos', $image->image);

        // delete from db
        $image->delete();

        // return to index
        return redirect()->route('images.index')->with(['success' => 'Data Berhasil Dihapus!']);
        
    }
}
