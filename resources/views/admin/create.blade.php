@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Tambah Banner</h2>
        <form action="{{ route('banners.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="image">Pilih Gambar Banner</label>
                <input type="text" class="form-control" id="image" name="image" readonly required placeholder="Pilih gambar..." />
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#imageModal">
                    Pilih Gambar
                </button>
            </div>

            <div class="form-group">
                <label for="description">Deskripsi Banner (Opsional)</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Banner</button>
        </form>
    </div>

    <!-- Modal untuk memilih gambar -->
    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Pilih Gambar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        @foreach($imageFiles as $image)
                            <div class="col-md-3 mb-3">
                                <div class="image-thumbnail" style="cursor: pointer;" onclick="selectImage('{{ $image }}')">
                                    <img src="{{ Storage::url('images/' . $image) }}" alt="{{ $image }}" class="img-fluid" style="width: 100%; height: auto;" />
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    // Fungsi untuk memilih gambar
    function selectImage(image) {
        // Set nilai input dengan nama gambar yang dipilih
        document.getElementById('image').value = image;
        
        // Menutup modal setelah gambar dipilih
        $('#imageModal').modal('hide');
    }
</script>
@endpush
