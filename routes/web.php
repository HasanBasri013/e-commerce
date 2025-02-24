<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\UploadController;




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
    Route::get('/admin/upload', [BarangController::class, 'index'])->name('admin.component.uploadbarang');
    Route::get('/admin/upload/tambahbarang', [BarangController::class, 'create'])->name('component.create');
    Route::post('/admin/upload/tambahbarang/simpan', [BarangController::class, 'store'])->name('component.store');
    Route::get('/admin/upload/edit/{id}', [BarangController::class, 'edit'])->name('component.edit');
    Route::put('/admin/upload/edit/{id}/update', [BarangController::class, 'update'])->name('component.update');

        // Route untuk menampilkan daftar banner
        Route::get('banners', [BannerController::class, 'index'])->name('banners.index');
        // Route untuk menampilkan form untuk menambah banner
        Route::get('banners/create', [BannerController::class, 'create'])->name('banners.create');
        // Route untuk menyimpan banner baru
        Route::post('banners', [BannerController::class, 'store'])->name('banners.store');
        // Route untuk menampilkan form edit banner
        Route::get('banners/{banner}/edit', [BannerController::class, 'edit'])->name('banners.edit');
        // Route untuk mengupdate banner yang sudah ada
        Route::put('banners/{banner}', [BannerController::class, 'update'])->name('banners.update');
        // Route untuk menghapus banner
        Route::delete('banners/{banner}', [BannerController::class, 'destroy'])->name('banners.destroy');
        // Route untuk meng-upload gambar
        Route::post('banners/upload', [BannerController::class, 'uploadImage'])->name('banners.uploadImage');
        
        Route::get('upload', [UploadController::class, 'index'])->name('upload.index');
        Route::post('upload', [UploadController::class, 'store'])->name('upload.store');

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
});



/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:manager'])->group(function () {
  
    Route::get('/manager/home', [HomeController::class, 'managerHome'])->name('manager.home');

});


