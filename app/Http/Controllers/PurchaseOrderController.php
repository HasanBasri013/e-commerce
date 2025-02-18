<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderDetail;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    public function create()
    {
        return view('transaksi.po');
    }

    public function store(Request $request)
    {
        $request->validate([
            'po_number' => 'required|string|max:255',
            'po_date' => 'required|date',
            'supplier' => 'required|string|max:255',
            'total_amount' => 'required|numeric',
            'notes' => 'nullable|string',
            'items' => 'required|array',
            'items.*.id_barang' => 'required|integer|exists:barang,id', // Validasi ID Barang
            'items.*.qty' => 'required|numeric|min:1', // Validasi Quantity
            'items.*.subtotal' => 'required|numeric|min:0', // Validasi Subtotal
        ]);

        // Simpan header PO
        $po = PurchaseOrder::create([
            'po_number' => $request->po_number,
            'order_date' => $request->order_date,
            'supplier_name' => $request->supplier_name,
            'total_amount' => $request->total_amount,
            'notes' =>$request->note,
            'status' => 'Posted', // Menyimpan status default
        ]);

        // Simpan detail PO
        foreach ($request->items as $item) {
            $totalPrice = $item['quantity'] * $item['unit_price'];

            $po->details()->create([
                'purchase_order_id' => $po->id,
                'id_barang' => $item['id_barang'],
                'qty' => $item['qty'],
                'subtotal' => $item['subtotal']
            ]);
        }

        return redirect()->route('po.store');
    }
}
