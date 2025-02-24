<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        // Mengambil semua banner dari database
        $banners = Banner::all();

        // Menambahkan URL gambar yang dapat diakses secara publik
        $banners->each(function ($banner) {
            $banner->image_url = Storage::url('uploads/' . $banner->image);
        });

        return view('admin.index', compact('banners'));
    }

    public function create()
    {
        // Ambil daftar file gambar yang sudah ada di folder 'uploads'
        $imageFiles = Storage::disk('public')->files('uploads');
        $imageFiles = array_map(function ($file) {
            return basename($file); // Ambil nama file saja
        }, $imageFiles);

        return view('admin.create', compact('imageFiles'));
    }

    public function store(Request $request)
    {
        // Validasi input (Hanya membutuhkan deskripsi karena gambar sudah ada)
        $request->validate([
            'image' => 'required|string|max:255', // Menyimpan nama gambar sebagai string
            'description' => 'nullable|string|max:255',
        ]);

        // Simpan data banner ke database
        Banner::create([
            'image' => $request->image,  // Simpan nama gambar
            'description' => $request->description,
        ]);

        return redirect()->route('admin.banners.index')->with('success', 'Banner berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $banner = Banner::findOrFail($id);

        // Validasi input (Hanya membutuhkan deskripsi karena gambar sudah ada)
        $request->validate([
            'image' => 'nullable|string|max:255',  // Nama gambar yang sudah dipilih
            'description' => 'nullable|string|max:255',
        ]);

        // Update gambar jika ada perubahan
        if ($request->has('image')) {
            $banner->image = $request->image;  // Update nama gambar
        }

        // Update deskripsi banner jika ada perubahan
        $banner->description = $request->description;
        $banner->save();

        return redirect()->route('admin.banners.index')->with('success', 'Banner berhasil diperbarui.');
    }

    public function edit($id)
    {
        $banner = Banner::findOrFail($id);

        // Tambahkan URL gambar yang dapat diakses secara publik
        $banner->image_url = Storage::url('uploads/' . $banner->image);

        return view('admin.banners.edit', compact('banner'));
    }

    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);

        // Hapus gambar dari penyimpanan jika ada
        if ($banner->image && Storage::disk('public')->exists('uploads/' . $banner->image)) {
            Storage::disk('public')->delete('uploads/' . $banner->image);
        }

        // Hapus banner dari database
        $banner->delete();

        return redirect()->route('admin.banners.index')->with('success', 'Banner berhasil dihapus.');
    }
}
