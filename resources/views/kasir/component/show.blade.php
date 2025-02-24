@extends('layouts.kasir')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 col-sm-6">
            <!-- Main Product Image -->
            <h3 class="d-inline-block d-sm-none">{{ $product->nama }}</h3>
            <div class="col-12">
                <img id="main-image" src="{{ Storage::url($product->images[0]->image_path) }}" class="product-image" alt="{{ $product->nama }}">
            </div>
            
            <!-- Thumbnail Images -->
            <div class="col-12 product-image-thumbs mt-3">
                @foreach ($product->images as $image)
                    <div class="product-image-thumb">
                        <img src="{{ Storage::url($image->image_path) }}" alt="Product Image" class="thumb-image">
                    </div>
                @endforeach
            </div>
        </div>
        
        <div class="col-12 col-sm-6">
            <h4>Deskripsi Produk</h4>
            <p>{{ $product->deskripsi }}</p>
            
            <!-- Product Price -->
            <div class="bg-gray py-2 px-3 mt-4">
                <h2 class="mb-0">Rp {{ number_format($product->harga, 0, ',', '.') }}</h2>
            </div>

            <!-- Add to Cart and Wishlist Buttons -->
            <div class="mt-4">
                <button class="btn btn-primary btn-lg btn-flat">
                    <i class="fas fa-cart-plus fa-lg mr-2"></i> Add to Cart
                </button>
                <button class="btn btn-default btn-lg btn-flat">
                    <i class="fas fa-heart fa-lg mr-2"></i> Add to Wishlist
                </button>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // JavaScript/jQuery to handle thumbnail click event and change the main image
    $(document).ready(function(){
        $(".thumb-image").click(function(){
            var newSrc = $(this).attr("src"); // Get the source of the clicked thumbnail
            $("#main-image").attr("src", newSrc); // Update the main image source
        });

        // Optional: Add active class to the clicked thumbnail for visual feedback
        $(".thumb-image").click(function(){
            $(".product-image-thumb").removeClass("active"); // Remove active class from all
            $(this).parent().addClass("active"); // Add active class to clicked thumbnail's parent
        });
    });
</script>
@endsection
@endsection
