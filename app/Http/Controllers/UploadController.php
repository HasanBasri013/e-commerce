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
            // Mendapatkan nama asli file
            $imageName = $request->file('image')->getClientOriginalName();
    
            // Menyimpan gambar ke folder storage dengan nama asli
            $imagePath = $request->file('image')->storeAs('uploads', $imageName, 'public');
        }
    
        // Redirect kembali ke halaman upload
        return redirect()->route('upload.index')->with('success', 'Gambar berhasil diupload!');
    }
    public function destroy($image)
    {
        // Menghapus file gambar dari folder 'uploads'
        $imagePath = 'uploads/' . $image;
        if (Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);  // Hapus gambar
        }

        // Redirect ke halaman sebelumnya setelah gambar dihapus
        return redirect()->route('upload.index')->with('success', 'Gambar berhasil dihapus.');
    }
    
}
