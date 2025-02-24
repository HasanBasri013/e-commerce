@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Upload Gambar</h2>
        <!-- Form Upload -->
        <form action="{{ route('upload.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="image">Pilih Gambar</label>
                <input type="file" class="form-control" id="image" name="image" required>
            </div>
            <button type="submit" class="btn btn-primary">Upload Gambar</button>
        </form>

        <hr>

        <h3>Galeri Gambar</h3>
        <div class="row">
            @foreach ($images as $image)
                <div class="col-md-3 mb-3">
                    <div class="card">
                        <img src="{{ Storage::url($image) }}" class="card-img-top" alt="Image">
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
