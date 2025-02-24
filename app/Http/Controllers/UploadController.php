<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    // Menampilkan halaman upload dan galeri gambar
    public function index()
    {
        $images = Storage::files('public/uploads');  // Menampilkan semua gambar yang ada di folder uploads
        return view('admin.upload', compact('images'));
    }

    // Menangani upload gambar
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Menyimpan gambar ke folder storage
            $imagePath = $request->file('image')->store('uploads', 'public');
        }

        // Redirect kembali ke halaman upload
        return redirect()->route('upload.index')->with('success', 'Gambar berhasil diupload!');
    }
}
