<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'po_number', 
        'order_date', 
        'supplier_name', 
        'total_amount'
    ];

    public function details()
    {
        return $this->hasMany(PurchaseOrderDetail::class);
    }
}
