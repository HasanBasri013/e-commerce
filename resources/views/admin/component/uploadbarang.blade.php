@extends('layouts.app')

@section('content')
    <section class="container-fluid">
        <h4 class="mb-4 text-center text-primary" style="font-family: 'Arial', sans-serif; font-weight: bold;">Entalase Barang</h4>
        
        <!-- Button to add barang -->
        <section class="container-fluid mb-4">
            <div class="text-end">
                <a href="{{ route('component.create') }}" class="btn btn-success px-4 py-2 rounded-3 shadow-sm">
                    <i class="bi bi-plus-circle"></i> Tambah Barang
                </a>
            </div>
        </section>
        
        <!-- Card container -->
        <section class="container-fluid">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3"> <!-- Set to 4 columns on medium screens -->
                @foreach ($barangs as $barang)
                    <div class="col">
                        <div class="card shadow-sm rounded-3 border-0 overflow-hidden" style="height: 300px;"> <!-- Fixed height for uniform size -->
                            <!-- Menampilkan gambar barang pertama jika ada -->
                            @if($barang->images->count() > 0)
                                <img src="{{ asset('storage/' . $barang->images->first()->image_path) }}" class="card-img-top" alt="Barang" style="object-fit: cover; height: 200px;"> <!-- Fixed height for image -->
                            @else
                                <img src="{{ asset('images/default-image.jpg') }}" class="card-img-top" alt="Barang" style="object-fit: cover; height: 200px;"> <!-- Fixed height for image -->
                            @endif
                            
                            <div class="card-body d-flex flex-column p-3"> <!-- Added padding -->
                                <h5 class="card-title text-truncate" style="font-size: 1rem; font-weight: bold; color: #333;">{{ $barang->nama }}</h5>
                
                                <div class="d-flex justify-content-between align-items-center mt-1">
                                    <p class="card-text text-end text-warning fw-bold">Rp {{ number_format($barang->harga, 0, ',', '.') }}</p>
                                    <a href="{{ route('component.edit', $barang->id) }}" class="btn btn-warning btn-sm d-flex align-items-center px-3 py-1 rounded-3 shadow-sm">
                                        <i class="bi bi-pencil-square me-2"></i> Edit
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </section>
@endsection
