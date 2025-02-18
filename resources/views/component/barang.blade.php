@extends('layouts.app')

@section('content')
    <section class="container-fluid">
        <section class="card">
            <section class="card-header">
                <h3 class="card-title">Daftar Barang</h3>
            </section>
            <section class="card-body">
                <section id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <section class="row">
                        <section class="col-sm-12 col-md-6">
                            <!-- Button to trigger modal for adding barang -->
                            <a href="{{ route('component.create') }}" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addBarangModal">
                                <i class="fa fa-plus"></i> Tambah Barang
                            </a>
                        </section>
                        
                        <section class="col-sm-12 col-md-6">
                            <section id="example1_filter" class="dataTables_filter text-end">
                                <form action="{{ route('component.barang') }}" method="GET" id="search-form">
                                    <input type="search" name="search" id="search" class="form-control form-control-sm custom-search" placeholder="Search..." value="{{ request()->get('search') }}" aria-controls="example1">
                                </form>
                            </section>
                        </section>
                    </section>

                    <section class="row">
                        <section class="col-sm-12">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Satuan</th>
                                        <th>Harga Beli</th>
                                        <th>Harga Jual</th>
                                        <th>Kategori</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($barang as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $item->KodeBarang }}</td>
                                            <td>{{ $item->NamaBarang }}</td>
                                            <td>{{ $item->Satuan }}</td>
                                            <td>{{ number_format($item->HargaBeli, 2) }}</td>
                                            <td>{{ number_format($item->HargaJual, 2) }}</td>
                                            <td>{{ $item->Kategori }}</td>
                                            <td>
                                                <!-- Edit button with data attributes for each item -->
                                                <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editBarangModal"
                                                data-id="{{ $item->IDBarang }}"
                                                data-kode="{{ $item->KodeBarang }}"
                                                data-nama="{{ $item->NamaBarang }}"
                                                data-satuan="{{ $item->Satuan }}"
                                                data-hargaBeli="{{ $item->HargaBeli }}"
                                                data-hargaJual="{{ $item->HargaJual }}"
                                                data-kategori="{{ $item->Kategori }}"
                                                data-image="{{ json_encode($item->Gambar ? explode(',', $item->Gambar) : []) }}"> <!-- Kirim gambar sebagai array -->
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                            
                                                <form action="{{ route('barang.destroy', $item->IDBarang) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?')">
                                                        <i class="fa fa-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <section class="row">
                                <section class="col-sm-12 col-md-5">
                                    <section class="dataTables_info" id="example1_info">
                                        Showing {{ $barang->firstItem() }} to {{ $barang->lastItem() }} of {{ $barang->total() }} entries
                                    </section>
                                </section>
                                <section class="col-sm-12 col-md-7">
                                    <section class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                                        {{ $barang->links('pagination::bootstrap-4') }}
                                    </section>
                                </section>
                            </section>
                        </section>
                    </section>
                </section>
            </section>
        </section>
    </section>

@endsection

@section('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const editBarangModal = document.getElementById('editBarangModal');
    editBarangModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // Button that triggered the modal
        const id = button.getAttribute('data-id');
        const kode = button.getAttribute('data-kode');
        const nama = button.getAttribute('data-nama');
        const satuan = button.getAttribute('data-satuan');
        const hargaBeli = button.getAttribute('data-hargaBeli');
        const hargaJual = button.getAttribute('data-hargaJual');
        const kategori = button.getAttribute('data-kategori');
        const imageData = button.getAttribute('data-image'); // Get JSON string for images
        
        // Convert the image JSON string back to an array
        const images = JSON.parse(imageData);

        // Set the values of the fields in the modal
        document.getElementById('editKodeBarang').value = kode;
        document.getElementById('editNamaBarang').value = nama;
        document.getElementById('editSatuan').value = satuan;
        document.getElementById('editHargaBeli').value = hargaBeli;
        document.getElementById('editHargaJual').value = hargaJual;
        document.getElementById('editKategori').value = kategori;

        // Display images if available
        const existingImageSection = document.getElementById('existingImageSection');
        const existingImageContainer = document.getElementById('existingImageContainer');
        existingImageContainer.innerHTML = ''; // Clear previous images

        if (images.length > 0) {
            existingImageSection.style.display = 'block'; // Show the image section
            images.forEach(function(image) {
                const imageElement = document.createElement('img');
                imageElement.src = '{{ asset('images/barang/') }}' + image;  // Combine base URL with image path
                imageElement.alt = 'Existing Image';
                imageElement.classList.add('img-fluid');
                imageElement.style.maxWidth = '200px';
                existingImageContainer.appendChild(imageElement);
            });
        } else {
            existingImageSection.style.display = 'none'; // Hide the section if no images
        }

        // Update the form action with the correct update URL for this item
        const form = document.getElementById('editBarangForm');
        form.action = '/barang/' + id + '/update';  // Dynamically replace :id with actual ID
    });
});


    function showImagePreview(event) {
    const previewContainer = document.getElementById('previewContainer');
    previewContainer.innerHTML = '';  // Clear previous previews

    // Menampilkan elemen preview gambar
    const files = event.target.files;
    if (files.length > 0) {
        const imagePreview = document.getElementById('imagePreview');
        imagePreview.style.display = 'block';
        
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const reader = new FileReader();
            
            reader.onload = function(e) {
                const imgElement = document.createElement('img');
                imgElement.src = e.target.result;
                imgElement.classList.add('img-fluid', 'm-2');
                imgElement.style.maxWidth = '100px';

                // Append the image to the preview container
                previewContainer.appendChild(imgElement);
            }
            reader.readAsDataURL(file);
        }
    }
}

function showEditImagePreview(event) {
    const previewContainer = document.getElementById('editPreviewContainer');
    previewContainer.innerHTML = '';  // Clear previous previews

    // Display selected images in the preview container
    const files = event.target.files;
    if (files.length > 0) {
        const editImagePreview = document.getElementById('editImagePreview');
        editImagePreview.style.display = 'block';
        
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const reader = new FileReader();
            
            reader.onload = function(e) {
                const imgElement = document.createElement('img');
                imgElement.src = e.target.result;
                imgElement.classList.add('img-fluid', 'm-2');
                imgElement.style.maxWidth = '100px';

                // Append the image to the preview container
                previewContainer.appendChild(imgElement);
            }
            reader.readAsDataURL(file);
        }
    }
}
</script>
@endsection
