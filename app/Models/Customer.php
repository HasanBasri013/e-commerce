<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    use HasFactory;

    // Define the table name if it doesn't follow Laravel's convention
    protected $table = 'customers';
    protected $primaryKey = 'IDCustomer'; 
    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'KodeCustomer',
        'NamaCustomer',
        'Alamat',
        'NoTelp',
        'Email',
        'Kontak',
    ];
    
    public $timestamps = false;
}
