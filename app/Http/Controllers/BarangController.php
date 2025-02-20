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
        // Fetch barang data including images
        $barang = Barang::with('images')->findOrFail($id);

        // Return the view with barang data
        return view('admin.component.updateupload', compact('barang'));
    }

    // Update method: handle the update process for a barang
    public function update(Request $request, $id)
    {
        // Validate input data
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'condition' => 'required|in:used,new',
            'merk' => 'required|string|max:255',  // Added validation for 'merk'
            'deskripsi' => 'required|string',
            'gambar.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate images
        ]);

        // Find the barang by ID
        $barang = Barang::findOrFail($id);

        // Update the barang data including merk
        $barang->update([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'condition' => $request->condition,
            'merk' => $request->merk,  // Update merk
            'deskripsi' => $request->deskripsi,
        ]);

        // Handle image update if new images are uploaded
        if ($request->hasFile('gambar')) {
            // Delete existing images
            foreach ($barang->images as $image) {
                Storage::delete($image->image_path);
                $image->delete();
            }

            // Store new images
            foreach ($request->file('gambar') as $file) {
                $path = $file->store('public/images');
                BarangImage::create([
                    'barang_id' => $barang->id,
                    'image_path' => str_replace('public/', '', $path),
                ]);
            }
        }

        // Redirect to the barang page with success message
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
            'merk' => 'required|string|max:255',  // Validate merk field
            'deskripsi' => 'required|string',
            'gambar.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image files
        ]);

        // Create a new barang record
        $barang = Barang::create([
            'nama' => $validated['nama'],
            'harga' => $validated['harga'],
            'condition' => $validated['condition'],
            'merk' => $validated['merk'],  // Store merk
            'deskripsi' => $validated['deskripsi'],
        ]);

        // Check if images were uploaded and store them
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $image) {
                $path = $image->store('barang_images', 'public');
                
                BarangImage::create([
                    'barang_id' => $barang->id,
                    'image_path' => $path,
                ]);
            }
        }

        // Handle "Simpan & Lanjutkan" button action
        if ($request->has('save_continue')) {
            return redirect()->route('component.create')->with('success', 'Barang berhasil disimpan. Tambahkan barang lain.');
        }

        // Handle "Simpan Barang" button action
        if ($request->has('save')) {
            return redirect()->route('admin.component.uploadbarang')->with('success', 'Barang berhasil disimpan.');
        }

        // Default save logic
        return redirect()->route('admin.component.uploadbarang')->with('success', 'Barang berhasil disimpan.');
    }
}
