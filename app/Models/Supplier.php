<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    // Define the table name if it doesn't follow Laravel's convention
    protected $table = 'suppliers';
    protected $primaryKey = 'IDSupplier'; 
    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'KodeSupplier',
        'NamaSupplier',
        'Alamat',
        'NoTelp',
        'Email',
        'Kontak',
    ];
    public $timestamps = false;
}