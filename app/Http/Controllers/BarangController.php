<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    // Method to show the homepage view (admin component)
    public function showHome()
    {
        return view('admin.component.uploadbarang'); // Display 'uploadbarang' view
    }

    // Method to display the form to create a new barang
    public function create()
    {
        return view('admin.component.createupload');
    }

    // Method to handle storing barang data and uploading images
    public function store(Request $request)
    {
        // Validate incoming request
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'condition' => 'required|in:new,used',
            'deskripsi' => 'required|string',
            'gambar.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
        ]);

        // Store Barang data in the database
        $barang = Barang::create([
            'nama' => $validated['nama'],
            'harga' => $validated['harga'],
            'condition' => $validated['condition'],
            'deskripsi' => $validated['deskripsi'],
        ]);

        // Check if the request contains images and save them
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $image) {
                // Store the image and get its path
                $path = $image->store('barang_images', 'public');
                
                // Store the image record in the database
                BarangImage::create([
                    'barang_id' => $barang->id,
                    'image_path' => $path,
                ]);
            }
        }

        // Redirect the user with a success message
        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan');
    }
}
