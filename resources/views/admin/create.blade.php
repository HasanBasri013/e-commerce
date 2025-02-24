@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Tambah Banner</h2>
        <form action="{{ route('banners.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="image">Pilih Gambar Banner</label>
                <select class="form-control" id="image" name="image" required>
                    <option value="" disabled selected>Pilih gambar...</option>
                    @foreach($imageFiles as $image)
                        <option value="{{ $image }}">{{ $image }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="description">Deskripsi Banner (Opsional)</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Banner</button>
        </form>
    </div>
@endsection
