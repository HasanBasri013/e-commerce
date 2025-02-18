<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PurchaseOrderController;



Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

/*------------------------------------------
--------------------------------------------
All Normal Users Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:user'])->group(function () {
  
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});
  
/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:admin'])->group(function () {
  
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');
});
Route::get('/upload', [BarangController::class, 'showHome'])->name('admin.component.uploadbarang');
Route::get('/upload/tambahbarang', [BarangController::class, 'create'])->name('component.create');
Route::post('/upload/tambahbarang/simpan', [BarangController::class, 'store'])->name('component.store');
  
// Route::get('/barang', [BarangController::class, 'barang'])->name('component.barang');
// Route::get('/barang/modal', [BarangController::class, 'getBarangModal'])->name('component.barang.modal');
// // For the modal AJAX call
// Route::post('/barang/store', [BarangController::class, 'store'])->name('barang.store');
// Route::put('/barang/{IDBarang}/update', [BarangController::class, 'update'])->name('barang.update');
// Route::delete('/barang/{IDBarang}/destroy', [BarangController::class, 'destroy'])->name('barang.destroy');

Route::get('/supplier', [SupplierController::class, 'index'])->name('component.supplier');
Route::get('/suppliers/modal', [SupplierController::class, 'getSuppliersForModal'])->name('component.supplier.modal'); // For the modal AJAX call
Route::post('/supplier/store', [SupplierController::class, 'store'])->name('supplier.store');
Route::put('/supplier/{IDSupplier}/update', [SupplierController::class, 'update'])->name('supplier.update');
Route::delete('/supplier/{IDSupplier}/destroy', [SupplierController::class, 'destroy'])->name('supplier.destroy');

Route::get('/customer', [CustomerController::class, 'index'])->name('component.customer');
Route::post('/customer/store', [CustomerController::class, 'store'])->name('customer.store');
Route::put('/customer/{IDCustomer}/update', [CustomerController::class, 'update'])->name('customer.update');
Route::delete('/customer/{IDCustomer}/destroy', [CustomerController::class, 'destroy'])->name('customer.destroy');

Route::get('po/create', [PurchaseOrderController::class, 'create'])->name('transaksi.po');
Route::post('po', [PurchaseOrderController::class, 'store'])->name('po.store');
Route::resource('purchase_order', PurchaseOrderController::class);

/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:manager'])->group(function () {
  
    Route::get('/manager/home', [HomeController::class, 'managerHome'])->name('manager.home');
});


