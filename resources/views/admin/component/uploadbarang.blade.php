@extends('layouts.app')

@section('content')
    <section class="container-fluid">
        <!-- Button to add barang -->
        <div class="mb-4">
            <a href="{{ route('component.create') }}" class="btn btn-primary">Tambah Barang</a>
        </div>

        <!-- Row with wrapped items -->
        <div class="row flex-wrap">
            @foreach ($barangs as $barang)
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="card h-100"> <!-- Added h-100 to ensure equal card height -->
                        <!-- Menampilkan gambar barang pertama jika ada -->
                        @if($barang->images->count() > 0)
                            <img src="{{ asset('storage/' . $barang->images->first()->image_path) }}" class="card-img-top" alt="Barang" style="object-fit: cover; height: 200px;">
                        @else
                            <img src="{{ asset('images/default-image.jpg') }}" class="card-img-top" alt="Barang" style="object-fit: cover; height: 200px;">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $barang->nama }}</h5>
                            <p class="card-text">{{ $barang->deskripsi }}</p>
                            <p class="card-text">Harga: Rp {{ number_format($barang->harga, 0, ',', '.') }}</p>
                            <p class="card-text">Kondisi: {{ ucfirst($barang->condition) }}</p>
                            <div class="mt-auto">
                                <!-- Edit Button with Bootstrap Icon -->
                                <a href="#" class="btn btn-warning">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
