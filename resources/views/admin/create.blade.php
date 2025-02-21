@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Tambah Banner</h2>
        <form action="{{ route('banners.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="image">Pilih Gambar Banner</label>
                <div class="input-group">
                    <select class="form-control" id="image" name="image" required>
                        <option value="">Pilih Gambar...</option>
                        @foreach($imageFiles as $image)
                            <option value="{{ $image }}">{{ $image }}</option>
                        @endforeach
                    </select>
                    <button type="button" class="btn btn-info" id="openModal">Upload Gambar</button>
                </div>
            </div>

            <div class="form-group">
                <label for="description">Deskripsi Banner (Opsional)</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Banner</button>
        </form>
    </div>

    <!-- Modal untuk Upload Gambar -->
    <div class="modal" tabindex="-1" role="dialog" id="uploadModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload Gambar Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="uploadForm" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="uploadImage">Pilih Gambar</label>
                            <input type="file" class="form-control" id="uploadImage" name="image" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Upload Gambar</button>
                    </form>
                    <div id="uploadMessage" class="mt-3"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Menampilkan modal upload
        $('#openModal').click(function() {
            $('#uploadModal').modal('show');
        });

        // Meng-handle upload gambar
        $('#uploadForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: '{{ route("banners.uploadImage") }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        $('#uploadMessage').html('<div class="alert alert-success">Gambar berhasil diupload</div>');
                        // Menambahkan gambar yang baru diupload ke dropdown
                        $('#image').append(new Option(response.image, response.image));
                        $('#uploadModal').modal('hide');
                    }
                },
                error: function() {
                    $('#uploadMessage').html('<div class="alert alert-danger">Terjadi kesalahan saat mengupload gambar</div>');
                }
            });
        });
    </script>
@endsection
