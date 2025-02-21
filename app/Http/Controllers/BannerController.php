<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        return view('admin.index', compact('banners'));
    }

    public function create()
    {
        $imageFiles = Storage::disk('public')->files('uploads');
        $imageFiles = array_map(function ($file) {
            return basename($file); // Get only the filename
        }, $imageFiles);

        return view('admin.create', compact('imageFiles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->storeAs('uploads', $imageName, 'public');

        Banner::create([
            'image' => $imageName,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.banners.index')->with('success', 'Banner berhasil ditambahkan.');
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->storeAs('uploads', $imageName, 'public'); // Ensure it's stored in the 'public' disk

        return response()->json(['success' => true, 'image' => $imageName]);
    }

    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(Request $request, $id)
    {
        $banner = Banner::findOrFail($id);

        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete('uploads/' . $banner->image);

            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('uploads', $imageName, 'public');
            $banner->image = $imageName;
        }

        $banner->description = $request->description;
        $banner->save();

        return redirect()->route('admin.banners.index')->with('success', 'Banner berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);

        if (Storage::disk('public')->exists('uploads/' . $banner->image)) {
            Storage::disk('public')->delete('uploads/' . $banner->image);
        }

        $banner->delete();

        return redirect()->route('admin.banners.index')->with('success', 'Banner berhasil dihapus.');
    }
}
