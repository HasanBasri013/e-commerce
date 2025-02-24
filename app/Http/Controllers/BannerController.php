<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class BannerController extends Controller
{
    public function index()
    {
        // Mengambil semua banner dari database
        $banners = Banner::all();

        // Menambahkan URL gambar yang dapat diakses secara publik
        $banners->each(function ($banner) {
            $banner->image_url = Storage::url($banner->image); // Menggunakan Storage URL
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
        // Validasi input
        $request->validate([
            'image' => 'required|string|max:255', // Pastikan nama gambar adalah string
            'description' => 'nullable|string|max:255',
        ]);
    
        // Check if the image exists in the 'uploads' directory
        $imagePath = 'uploads/' . $request->image;
        if (!Storage::disk('public')->exists($imagePath)) {
            return redirect()->back()->withErrors(['image' => 'Gambar tidak ditemukan di folder uploads.']);
        }
    
        // Save the banner to the database
        Banner::create([
            'image' => $imagePath,  // Simpan path gambar lengkap di database
            'description' => $request->description,
        ]);
    
        // Redirect with success message
        return redirect()->route('banners.index')->with('success', 'Banner berhasil ditambahkan.');
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
            // Cek jika gambar yang dipilih benar-benar ada di folder 'uploads'
            $imagePath = 'uploads/' . $request->image;
            if (!Storage::disk('public')->exists($imagePath)) {
                return redirect()->back()->withErrors(['image' => 'Gambar tidak ditemukan di folder uploads.']);
            }
            $banner->image = $imagePath;  // Update path gambar
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
        $banner->image_url = Storage::url($banner->image);

        return view('admin.banners.edit', compact('banner'));
    }

    public function destroy($id)
    {
        // Find the banner by its ID
        $banner = Banner::findOrFail($id);
        
        // Log gambar yang akan dihapus
        Log::info('Banner akan dihapus: ', ['image' => $banner->image]);
    
        // Hanya menghapus entri database, bukan gambar
        $banner->delete();
        
        // Mengembalikan respons setelah menghapus entri database
        return redirect()->route('banners.index')->with('success', 'Banner berhasil dihapus.');
    }
    

}
