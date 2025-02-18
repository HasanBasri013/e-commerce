@extends('layouts.kasir')

@section('content')
<div class="container">
    <!-- Banner Statik -->

    <!-- Slider Banner -->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://picsum.photos/1200/400?random=1" class="d-block w-100" alt="Banner 1">
            </div>
            <div class="carousel-item">
                <img src="https://picsum.photos/1200/400?random=2" class="d-block w-100" alt="Banner 2">
            </div>
            <div class="carousel-item">
                <img src="https://picsum.photos/1200/400?random=3" class="d-block w-100" alt="Banner 3">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>


    <!-- Menampilkan kategori produk dengan ikon bulat dan tanpa keterangan -->
    <div class="row mt-4">
        @php
            $categories = [
                ['name' => 'Elektronik', 'icon' => 'fas fa-laptop'],
                ['name' => 'Fashion', 'icon' => 'fas fa-tshirt'],
                ['name' => 'Kecantikan', 'icon' => 'fas fa-spa'],
                ['name' => 'Makanan', 'icon' => 'fas fa-utensils'],
            ];
        @endphp

        <!-- Kategori -->
        <div class="d-flex justify-content-center flex-wrap">
            @foreach($categories as $category)
                <div class="col-3 col-md-2 mb-4 text-center">
                    <div class="category-icon rounded-circle bg-light d-flex justify-content-center align-items-center">
                        <i class="{{ $category['icon'] }} fa-3x text-dark"></i>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Menampilkan produk unggulan -->
    <div class="row mt-4">
        <h3>Produk Unggulan</h3>
        @php
            $products = [
                ['name' => 'Laptop HP', 'description' => 'Laptop terbaik dengan performa tinggi', 'price' => 5000000],
                ['name' => 'T-shirt', 'description' => 'T-shirt nyaman dengan desain menarik', 'price' => 150000],
                ['name' => 'Kamera DSLR', 'description' => 'Kamera dengan kualitas gambar terbaik', 'price' => 10000000],
                ['name' => 'Sneakers Nike', 'description' => 'Sepatu sneakers keren untuk semua kegiatan', 'price' => 800000],
            ];
        @endphp

        @foreach($products as $product)
            <div class="col-md-3">
                <div class="card">
                    <!-- Gambar produk dengan URL dummy -->
                    <img src="https://picsum.photos/300/200?random={{ rand(1, 100) }}" class="card-img-top" alt="{{ $product['name'] }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product['name'] }}</h5>
                        <p class="card-text">{{ \Str::limit($product['description'], 80) }}</p>
                        <p class="card-text">Rp {{ number_format($product['price'], 0, ',', '.') }}</p>
                        <a href="#" class="btn btn-primary">Beli Sekarang</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection

