@extends('layouts.app')

@section('content')
    <section class="container-fluid">
        <h4>Edit Barang</h4>
        <h6 class="text-muted" style="font-size: 0.875rem;">Pastikan produk tidak melanggar Hak Kekayaan Intelektual supaya produkmu tidak diturunkan. Pelajari S&K</h6>

        <!-- Form to update barang -->
        <form action="{{ route('component.update', $barang->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <section class="container-fluid border rounded p-4" style="border: 2px solid #ddd; background-color: #f9f9f9;">
                    <!-- Nama Barang -->
                    <h4>Informasi Barang</h4>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Contoh: Laptop (Jenis/Kategori Produk) + (Merk) + Ryzen 5 7000 (Keterangan)" value="{{ old('nama', $barang->nama) }}" required>
                        @error('nama')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Merk (Brand) Dropdown -->
                    <div class="mb-3">
                        <label for="merk" class="form-label">Merk Barang</label>
                        <select class="form-control" id="merk" name="merk" required>
                            <option value="">Pilih Merk</option>
                            <option value="Lenovo" {{ old('merk', $barang->merk) == 'Lenovo' ? 'selected' : '' }}>Lenovo</option>
                            <option value="HP" {{ old('merk', $barang->merk) == 'HP' ? 'selected' : '' }}>HP</option>
                            <option value="Asus" {{ old('merk', $barang->merk) == 'Asus' ? 'selected' : '' }}>Asus</option>
                            <option value="Dell" {{ old('merk', $barang->merk) == 'Dell' ? 'selected' : '' }}>Dell</option>
                            <option value="Acer" {{ old('merk', $barang->merk) == 'Acer' ? 'selected' : '' }}>Acer</option>
                            <option value="Apple" {{ old('merk', $barang->merk) == 'Apple' ? 'selected' : '' }}>Apple</option>
                        </select>
                        @error('merk')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Harga -->
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga Barang</label>
                        <input type="number" class="form-control" id="harga" name="harga" placeholder="Masukkan Harga" value="{{ old('harga', $barang->harga) }}" required>
                        @error('harga')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Kondisi Barang -->
                    <div class="mb-3">
                        <label for="kondisi" class="form-label">Kondisi Barang</label>
                        <div class="radio-buttons">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="condition" id="used" value="used" {{ old('condition', $barang->condition) == 'used' ? 'checked' : '' }}>
                                <label class="form-check-label" for="used">Bekas</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="condition" id="new" value="new" {{ old('condition', $barang->condition) == 'new' ? 'checked' : '' }}>
                                <label class="form-check-label" for="new">Baru</label>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Upload Gambar -->
            <section class="container-fluid border rounded p-4" style="border: 2px solid #ddd; background-color: #f9f9f9;">
                <label class="form-label">Unggah Gambar Barang</label>
                <div class="row">
                    @for ($i = 0; $i < 4; $i++)
                        <div class="col-md-3 mb-3">
                            <label class="image-upload-box d-flex align-items-center justify-content-center border rounded position-relative" style="width: 100%; height: 120px; cursor: pointer;">
                                <input type="file" name="gambar[]" class="d-none image-input" data-index="{{ $i }}" accept="image/*">
                                <div class="icon-placeholder text-center">
                                    <i class="fas fa-camera fa-2x text-muted"></i>
                                    <p class="small text-muted m-0">{{ $i == 0 ? 'Foto Utama' : 'Foto ' . ($i + 1) }}</p>
                                </div>
                                <!-- Tampilkan gambar yang sudah ada -->
                                @if (isset($barang->images[$i]))
                                    <img src="{{ asset('storage/' . $barang->images[$i]->image_path) }}" class="preview-image" style="max-width: 100%; max-height: 100%; position: absolute;">
                                @else
                                    <img src="" class="preview-image d-none" style="max-width: 100%; max-height: 100%; position: absolute;">
                                @endif
                                <span class="delete-image position-absolute top-0 end-0 p-1" style="cursor: pointer; background-color: rgba(255, 255, 255, 0.8); border-radius: 50%;">
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
                <textarea class="form-control" placeholder="Sepatu Sneakers Pria Tokostore Kanvas Hitam Seri C28B Model simple Nyaman Digunakan Tersedia warna hitam" id="deskripsi" name="deskripsi" required>{{ old('deskripsi', $barang->deskripsi) }}</textarea>
                @error('deskripsi')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="text-end">
                <!-- Cancel Button: Redirects to the entalase barang -->
                <a href="{{ route('admin.component.uploadbarang') }}" class="btn btn-danger">Cancel</a>

                <!-- Simpan Perubahan Button: Save the updated item -->
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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
