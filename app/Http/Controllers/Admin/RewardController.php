<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reward;

class RewardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $rewards = Reward::latest()->paginate(10);
        return view('admin.reward.index', compact('rewards'));
    }

    public function show($id)
    {
        $reward = Reward::find($id);
        return view('admin.reward.show', compact('reward'));
    }

    public function create()
    {
        return view('admin.reward.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'point' => 'required',
            'stock' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/rewards', $image->hashName()); 

        Reward::create([
            'name' => $request->name,
            'point' => $request->point,
            'stock' => $request->stock,
            'description' => $request->description,
            'image' => $image->hashName(),
        ]);

        
            return redirect()->route('admin.rewards.index')->with('success', 'Data berhasil ditambahkan');
        
    }

    public function edit($id)
    {
        $reward = Reward::find($id);
        return view('admin.reward.edit', compact('reward'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'point' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $reward = Reward::find($id);

        if ($request->file('image')) {
            $image = $request->file('image');
            $image_name = time() . '.' . $image->extension();
            $image->storeAs('public/rewards', $image_name);
        } else {
            $image_name = $reward->image;
        }

        $reward->update([
            'name' => $request->name,
            'point' => $request->point,
            'image' => $image_name
        ]);

        if ($reward) {
            return redirect()->route('admin.reward.index')->with('success', 'Data berhasil diubah');
        } else {
            return redirect()->route('admin.reward.index')->with('error', 'Data gagal diubah');
        }
    }

    public function destroy($id)
    {
        $reward = Reward::find($id);
        $reward->delete();

        if ($reward) {
            return redirect()->route('admin.reward.index')->with('success', 'Data berhasil dihapus');
        } else {
            return redirect()->route('admin.reward.index')->with('error', 'Data gagal dihapus');
        }
    }
}
