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
                <div class="col-md-3 mb-3 position-relative">
                    <div class="card">
                        <img src="{{ Storage::url($image) }}" class="card-img-top" alt="Image">
                        <!-- Tombol Hapus (X kecil) -->
                        <form action="{{ route('upload.delete', basename($image)) }}" method="POST" class="position-absolute top-0 end-0 p-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" style="border-radius: 50%; width: 30px; height: 30px; padding: 0;">
                                X
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
