<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    // Method to show the homepage view (admin component)
    public function index()
    {
        // Fetch all barang along with their images
        $barangs = Barang::with('images')->get();

        // Return the view with the barang data
        return view('admin.component.uploadbarang', compact('barangs'));
    }
   // Edit method: show the form to edit an existing barang
public function edit($id)
{
    // Ambil data barang berdasarkan ID, termasuk gambar-gambarnya
    $barang = Barang::with('images')->findOrFail($id);

    // Tampilkan view edit dengan data barang
    return view('admin.component.updateupload', compact('barang')); // corrected 'barangs' to 'barang'
}

// Update method: handle the update process for a barang
public function update(Request $request, $id)
{
    // Validasi input
    $request->validate([
        'nama' => 'required|string|max:255',
        'harga' => 'required|numeric',
        'condition' => 'required|in:used,new',
        'deskripsi' => 'required|string',
        'gambar.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk gambar
    ]);

    // Ambil data barang berdasarkan ID
    $barang = Barang::findOrFail($id);

    // Update data barang
    $barang->update([
        'nama' => $request->nama,
        'harga' => $request->harga,
        'condition' => $request->condition,
        'deskripsi' => $request->deskripsi,
    ]);

    // Handle update gambar (jika ada gambar baru diunggah)
    if ($request->hasFile('gambar')) {
        // Hapus gambar lama (opsional)
        foreach ($barang->images as $image) {
            Storage::delete($image->image_path); // Hapus file dari storage
            $image->delete(); // Hapus record dari database
        }

        // Simpan gambar baru
        foreach ($request->file('gambar') as $file) {
            $path = $file->store('public/images'); // Simpan gambar ke storage
            BarangImage::create([
                'barang_id' => $barang->id, // corrected component_id to barang_id
                'image_path' => str_replace('public/', '', $path), // Simpan path relatif
            ]);
        }
    }

    // Redirect ke halaman entalase barang dengan pesan sukses
    return redirect()->route('admin.component.uploadbarang')->with('success', 'Barang berhasil diperbarui!');
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
            'gambar.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image files
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
    
        // If the "Simpan & Lanjut" button was clicked
        if ($request->has('save_continue')) {
            return redirect()->route('component.create')->with('success', 'Barang berhasil disimpan. Tambahkan barang lain.');
        }
    
        // If the "Simpan Barang" button was clicked
        if ($request->has('save')) {
            return redirect()->route('admin.component.uploadbarang')->with('success', 'Barang berhasil disimpan.');
        }
    
        // Default save logic (in case of form submission without specific button pressed)
        return redirect()->route('admin.component.uploadbarang')->with('success', 'Barang berhasil disimpan.');
    }
    
}
