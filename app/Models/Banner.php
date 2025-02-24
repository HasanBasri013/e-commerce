<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Banner extends Model
{
    use HasFactory;

    // Menentukan kolom yang dapat diisi
    protected $fillable = ['image', 'description'];

    // Accessor untuk mendapatkan URL gambar lengkap
    public function getImageUrlAttribute()
    {
        return Storage::url($this->image); // Kembalikan URL gambar yang lengkap dari 'image' field
    }

    // Mutator untuk menyimpan gambar ketika gambar diunggah
    public function setImageAttribute($value)
    {
        if (is_object($value)) {
            // Jika gambar diunggah (berupa objek file), simpan dengan nama yang unik
            $imageName = uniqid(time() . '_') . '.' . $value->extension();
            $value->storeAs('uploads', $imageName, 'public');
            // Simpan nama gambar yang diunggah di database (path relatif)
            $this->attributes['image'] = 'uploads/' . $imageName;
        } elseif (is_string($value)) {
            // Jika gambar adalah string (path file), simpan path tersebut
            $this->attributes['image'] = $value;
        }
    }

    // Fungsi untuk menghapus gambar ketika banner dihapus
}
