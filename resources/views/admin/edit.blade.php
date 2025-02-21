@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Banner</h2>
        <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="image">Pilih Gambar Banner</label>
                <input type="text" class="form-control" id="image" name="image" value="{{ $banner->image }}" required>
            </div>

            <div class="form-group">
                <label for="description">Deskripsi Banner (Opsional)</label>
                <textarea class="form-control" id="description" name="description">{{ $banner->description }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Perbarui Banner</button>
        </form>
    </div>
@endsection
