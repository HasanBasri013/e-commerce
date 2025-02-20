<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'harga', 'condition', 'merk', 'deskripsi'];

    public function images()
    {
        return $this->hasMany(BarangImage::class);
    }
}
