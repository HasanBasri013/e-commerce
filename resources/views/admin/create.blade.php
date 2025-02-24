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
                                <div class="image-thumbnail" style="cursor: pointer;" onclick="previewImage('{{ $image }}')">
                                    <img src="{{ Storage::url('uploads/' . $image) }}" alt="{{ $image }}" class="img-fluid" style="width: 100%; height: auto;" />
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- Display the selected image in the modal -->
                    <div class="form-group mt-3">
                        <label>Gambar yang dipilih</label>
                        <div id="selectedImagePreview" class="d-flex justify-content-center">
                            <img src="" alt="Gambar yang dipilih" id="selectedImage" class="img-fluid" style="max-width: 100px; display: none;" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" onclick="confirmSelection()">Pilih Gambar</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    var selectedImagePath = ""; // Store the selected image path

    // Fungsi untuk menampilkan pratinjau gambar yang dipilih
    function previewImage(imagePath) {
        // Tampilkan gambar yang dipilih dalam modal
        var imageUrl = "{{ Storage::url('uploads/') }}" + imagePath;
        document.getElementById('selectedImage').src = imageUrl;
        document.getElementById('selectedImage').style.display = 'block';

        // Simpan path gambar yang dipilih
        selectedImagePath = imagePath;
    }

    // Fungsi untuk mengonfirmasi pilihan gambar
    function confirmSelection() {
        if (selectedImagePath) {
            // Set nilai input dengan nama gambar yang dipilih
            document.getElementById('image').value = selectedImagePath.split('/').pop();

            // Menutup modal setelah gambar dipilih
            $('#imageModal').modal('hide');
        } else {
            alert('Silakan pilih gambar terlebih dahulu!');
        }
    }
</script>
@endpush
