@extends('layouts.kasir')

@section('content')
    <!-- Your page content here -->
    <div class="mb-4">
        <img src="path-to-your-banner.jpg" alt="Acer Promotion" class="img-fluid rounded">
    </div>

    <h2 class="mb-4">Produk Favorit</h2>
    <div class="row g-4">
        <!-- Product cards would go here -->
        <div class="col-6 col-md-4">
            <div class="card">
                <img src="path-to-product-image.jpg" class="card-img-top" alt="Product">
                <div class="card-body">
                    <h5 class="card-title">ACER MONITOR 23.8"</h5>
                    <p class="card-text">Rp 1.120.000</p>
                    <button class="btn btn-primary">+ Keranjang</button>
                </div>
            </div>
        </div>
        <!-- More product cards... -->
    </div>
@endsection

