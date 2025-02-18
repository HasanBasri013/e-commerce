<!-- Modal for Adding Barang -->
<div class="modal fade" id="addBarangModal" tabindex="-1" aria-labelledby="addBarangModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBarangModalLabel">Tambah Barang Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for creating a new barang -->
                <form method="POST" action="{{ route('barang.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <!-- Image Upload Section -->
                        <div class="col-md-4">
                            <div class="mb-3">
                                <div class="image-preview border rounded mb-3" style="width: 200px; height: 200px; position: relative;">
                                    <img id="main-preview" src="#" alt="Preview" class="img-fluid d-none" style="width: 100%; height: 100%; object-fit: cover;">
                                    <div id="placeholder" class="d-flex justify-content-center align-items-center h-100">
                                        <span class="text-muted">Foto</span>
                                    </div>
                                </div>

                                <div class="d-flex gap-2">
                                    @for ($i = 0; $i < 3; $i++)
                                    <div class="position-relative" style="width: 50px; height: 50px;">
                                        <input type="file" 
                                            name="product_images[]" 
                                            class="image-input"
                                            accept="image/*"
                                            style="display: none;"
                                            onchange="previewImage(this, {{ $i }})">
                                        <button type="button" 
                                            class="btn btn-outline-secondary rounded-circle w-100 h-100"
                                            onclick="this.previousElementSibling.click()">
                                            <i class="bi bi-plus"></i>
                                        </button>
                                        <img class="preview-thumbnail d-none position-absolute top-0 start-0 w-100 h-100 rounded-circle" 
                                            style="object-fit: cover;" 
                                            data-index="{{ $i }}">
                                    </div>
                                    @endfor
                                </div>
                            </div>
                        </div>

                        <!-- Form Fields -->
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="KodeBarang" class="form-label">Kode Barang</label>
                                <input type="text" 
                                    class="form-control @error('KodeBarang') is-invalid @enderror" 
                                    id="KodeBarang" 
                                    name="KodeBarang" 
                                    value="{{ old('KodeBarang') }}" 
                                    required>
                                @error('KodeBarang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="NamaBarang" class="form-label">Nama Barang</label>
                                <input type="text" 
                                    class="form-control @error('NamaBarang') is-invalid @enderror" 
                                    id="NamaBarang" 
                                    name="NamaBarang" 
                                    value="{{ old('NamaBarang') }}" 
                                    required>
                                @error('NamaBarang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="Satuan" class="form-label">Satuan</label>
                                <input type="text" 
                                    class="form-control @error('Satuan') is-invalid @enderror" 
                                    id="Satuan" 
                                    name="Satuan" 
                                    value="{{ old('Satuan') }}" 
                                    required>
                                @error('Satuan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="HargaBeli" class="form-label">Harga Beli</label>
                                <input type="number" 
                                    class="form-control @error('HargaBeli') is-invalid @enderror" 
                                    id="HargaBeli" 
                                    name="HargaBeli" 
                                    value="{{ old('HargaBeli') }}" 
                                    required>
                                @error('HargaBeli')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="HargaJual" class="form-label">Harga Jual</label>
                                <input type="number" 
                                    class="form-control @error('HargaJual') is-invalid @enderror" 
                                    id="HargaJual" 
                                    name="HargaJual" 
                                    value="{{ old('HargaJual') }}" 
                                    required>
                                @error('HargaJual')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="Kategori" class="form-label">Kategori</label>
                                <input type="text" 
                                    class="form-control @error('Kategori') is-invalid @enderror" 
                                    id="Kategori" 
                                    name="Kategori" 
                                    value="{{ old('Kategori') }}" 
                                    required>
                                @error('Kategori')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
