@extends('layouts.app')

@section('content')
    <section class="container-fluid">
        <!-- Button to add barang -->
        <div class="mb-4">
            <a href="{{route('component.create')}}" class="btn btn-primary">Tambah Barang</a>
        </div>

        <!-- Row with wrapped items -->
        <div class="row flex-wrap">
            <!-- Example of an item, repeat this for multiple items -->
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card">
                    <img src="your-image-url.jpg" class="card-img-top" alt="Barang">
                    <div class="card-body">
                        <h5 class="card-title">Nama Barang</h5>
                        <p class="card-text">Deskripsi Barang</p>
                    </div>
                </div>
            </div>
            <!-- Add more items as necessary -->
        </div>
    </section>
@endsection
