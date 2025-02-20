@extends('layouts.app')

@section('content')
    <section class="container-fluid">
        <h4>Tambah Barang</h4>
        <h6 class="text-muted" style="font-size: 0.875rem;">Pastikan produk tidak melanggar Hak Kekayaan Intelektual supaya produkmu tidak diturunkan. Pelajari S&K</h6>

        <!-- Form to create new barang -->
        <form action="{{ route('component.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <section class="container-fluid border rounded p-4" style="border: 2px solid #ddd; background-color: #f9f9f9;">
                    <!-- Nama Barang -->
                    <h4>Informasi Barang</h4>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Contoh: Laptop (Jenis/Kategori Produk) + (Merk) + Ryzen 5 7000 (Keterangan)" value="{{ old('nama') }}" required>
                        @error('nama')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Merk Laptop Dropdown -->
                    <div class="mb-3">
                        <label for="merk" class="form-label">Merk Laptop</label>
                        <select class="form-control" id="merk" name="merk" required>
                            <option value="">Pilih Merk</option>
                            <option value="Lenovo" {{ old('merk') == 'Lenovo' ? 'selected' : '' }}>Lenovo</option>
                            <option value="HP" {{ old('merk') == 'HP' ? 'selected' : '' }}>HP</option>
                            <option value="Asus" {{ old('merk') == 'Asus' ? 'selected' : '' }}>Asus</option>
                            <option value="Dell" {{ old('merk') == 'Dell' ? 'selected' : '' }}>Dell</option>
                            <option value="Acer" {{ old('merk') == 'Acer' ? 'selected' : '' }}>Acer</option>
                            <option value="Apple" {{ old('merk') == 'Apple' ? 'selected' : '' }}>Apple</option>
                            <!-- Add more options as needed -->
                        </select>
                        @error('merk')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Harga -->
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga Barang</label>
                        <input type="number" class="form-control" id="harga" name="harga" placeholder="Masukkan Harga" value="{{ old('harga') }}" required>
                        @error('harga')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Kondisi Barang -->
                    <div class="mb-3">
                        <label for="kondisi" class="form-label">Kondisi Barang</label>
                        <div class="radio-buttons">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="condition" id="used" value="used">
                                <label class="form-check-label" for="used">
                                    Bekas
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="condition" id="new" value="new">
                                <label class="form-check-label" for="new">
                                    Baru
                                </label>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <section class="container-fluid border rounded p-4" style="border: 2px solid #ddd; background-color: #f9f9f9;">
                <label class="form-label">Unggah Gambar Barang</label>
                <div class="row">
                    @for ($i = 0; $i < 4; $i++)
                        <div class="col-md-3 mb-3">
                            <label class="image-upload-box d-flex align-items-center justify-content-center border rounded position-relative" style="width: 100%; height: 120px; cursor: pointer;">
                                <input type="file" name="gambar[]" class="d-none image-input" data-index="{{ $i }}" accept="image/*" multiple>
                                <div class="icon-placeholder text-center">
                                    <i class="fas fa-camera fa-2x text-muted"></i> 
                                    <p class="small text-muted m-0">{{ $i == 0 ? 'Foto Utama' : 'Foto ' . ($i + 1) }}</p>
                                </div>
                                <img src="" class="preview-image d-none" style="max-width: 100%; max-height: 100%; position: absolute;">
                                <span class="delete-image d-none position-absolute top-0 end-0 p-1" style="cursor: pointer; background-color: rgba(255, 255, 255, 0.8); border-radius: 50%;">
                                    <i class="fas fa-times text-danger"></i>
                                </span>
                            </label>
                        </div>
                    @endfor
                </div>
                @error('gambar')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </section>

            <!-- Deskripsi -->
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi Barang</label>
                <textarea class="form-control" 
                    placeholder="Sepatu Sneakers Pria Tokostore Kanvas Hitam Seri C28B
                    Model simple
                    Nyaman Digunakan
                    Tersedia warna hitam"
                    id="deskripsi" name="deskripsi" required>{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="text-end">
                <!-- Cancel Button: Redirects to the upload.index route -->
                <a href="{{ route('admin.component.uploadbarang') }}" class="btn btn-danger">Cancel</a>

                <!-- Simpan & Lanjut Button: Save the item and continue adding another one -->
                <button type="submit" name="save_continue" class="btn btn-success">Simpan & Lanjutkan</button>

                <!-- Simpan Barang Button: Save the item and redirect to the upload.index route -->
                <button type="submit" name="save" class="btn btn-primary">Simpan Barang</button>
            </div>

        </form>
    </section>

    <script>
        document.querySelectorAll('.image-input').forEach(input => {
            input.addEventListener('change', function (event) {
                let files = event.target.files;
                let imageBoxes = document.querySelectorAll('.image-upload-box');
                let previewImages = document.querySelectorAll('.preview-image');
                let deleteButtons = document.querySelectorAll('.delete-image');
    
                // Cek jika lebih dari 4 gambar yang dipilih
                if (files.length > 4) {
                    alert("Anda hanya dapat memilih maksimal 4 gambar.");
                    return;
                }
    
                // Loop untuk menampilkan preview gambar yang dipilih
                for (let i = 0; i < files.length; i++) {
                    let file = files[i];
                    let reader = new FileReader();
    
                    reader.onload = function (e) {
                        let previewImage = previewImages[i];
                        let iconPlaceholder = imageBoxes[i].querySelector('.icon-placeholder');
                        let deleteButton = deleteButtons[i];
    
                        // Set gambar yang dipilih ke dalam preview
                        previewImage.src = e.target.result;
                        previewImage.classList.remove('d-none');
                        iconPlaceholder.classList.add('d-none');
                        deleteButton.classList.remove('d-none');
    
                        // Tambahkan event listener untuk tombol hapus
                        deleteButton.addEventListener('click', function (e) {
                            e.preventDefault();
                            e.stopPropagation();
                            previewImage.src = '';
                            previewImage.classList.add('d-none');
                            iconPlaceholder.classList.remove('d-none');
                            deleteButton.classList.add('d-none');
                            input.value = ''; // Clear the input file
                        });
                    }
    
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endsection
