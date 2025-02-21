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
    Route::get('/admin/upload', [BarangController::class, 'index'])->name('admin.component.uploadbarang');
    Route::get('/admin/upload/tambahbarang', [BarangController::class, 'create'])->name('component.create');
    Route::post('/admin/upload/tambahbarang/simpan', [BarangController::class, 'store'])->name('component.store');
    Route::get('/admin/upload/edit/{id}', [BarangController::class, 'edit'])->name('component.edit');
    Route::put('/admin/upload/edit/{id}/update', [BarangController::class, 'update'])->name('component.update');
});



/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:manager'])->group(function () {
  
    Route::get('/manager/home', [HomeController::class, 'managerHome'])->name('manager.home');

});


