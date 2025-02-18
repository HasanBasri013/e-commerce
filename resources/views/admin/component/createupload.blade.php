@extends('layouts.app')

@section('content')
    <section class="container-fluid">
        <h4>Tambah Barang</h4>
        <h6 class="text-muted" style="font-size: 0.875rem;">Pastikan produk tidak melanggar Hak Kekayaan Intelektual supaya produkmu tidak diturunkan. Pelajari S&K</h6>


        <!-- Form to create new barang -->
        <form action="#" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
            <section class="container-fluid border rounded p-4" style="border: 2px solid #ddd; background-color: #f9f9f9;">
            <!-- Nama Barang -->
            <h4>Informasi Barang</h4>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Barang</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Contoh: Lapotop (Jenis/Kategori Produo) + (Merk) + Ryzen 5 7000 (Keteranagan) " value="{{ old('nama') }}" required>
                @error('nama')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Harga -->
            <div class="mb-3">
                <label for="harga" class="form-label">Harga Barang</label>
                <input type="number" class="form-control" id="harga" name="harga" placeholder="Masukan Harga" value="{{ old('harga') }}" required>
                @error('harga')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
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
            <!-- Upload Gambar -->
            <div class="mb-3">
                <section class="container-fluid border rounded p-4" style="border: 2px solid #ddd; background-color: #f9f9f9;">
                    <label class="form-label">Unggah Gambar Barang</label>
                    <div class="row">
                        @for ($i = 0; $i < 4; $i++)
                            <div class="col-md-4 mb-3">
                                <label class="image-upload-box d-flex align-items-center justify-content-center border rounded position-relative" style="width: 100%; height: 120px; cursor: pointer;">
                                    <input type="file" name="gambar[]" class="d-none image-input" data-index="{{ $i }}" accept="image/*">
                                    <div class="icon-placeholder text-center">
                                        <i class="fas fa-camera fa-2x text-muted"></i> 
                                        <p class="small text-muted m-0">{{ $i == 0 ? 'Foto Utama' : 'Foto ' . ($i + 1) }}</p>
                                    </div>
                                    <img src="" class="preview-image d-none" style="max-width: 100%; max-height: 100%; position: absolute;">
                                </label>
                            </div>
                        @endfor
                    </div>
                    @error('gambar')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </section>
            </div>
            

               <!-- Deskripsi -->
               <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi Barang</label>
                <textarea class="form-control" 
                    placeholder="Sepatu Sneakers Pria Tokostore Kanvas Hitam Seri C28B
            
            - Model simple
            - Nyaman Digunakan
            - Tersedia warna hitam
            - Sole PVC (injection shoes) yang nyaman dan awet untuk digunakan sehari-hari
            
            Bahan:
            - Upper: Semi Leather (kulit tidak pecah-pecah)
            - Sole: Premium Rubber Sole
            
            Ukuran:
            - 39 : 25,5 cm
            - 40 : 26 cm
            - 41 : 26.5 cm
            - 42 : 27 cm
            - 43 : 27.5 - 28 cm
            
            Edisi terbatas dari Tokostore dengan model baru dan trendy untukmu. Didesain untuk bisa dipakai dalam berbagai acara. Sangat nyaman 
            saat dipakai sehingga dapat menunjang penampilan dan kepercayaan dirimu. Beli sekarang sebelum kehabisan!"
                    id="deskripsi" name="deskripsi" required>{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="text-end">
                <button type="submit" class="btn btn-danger">Cancel</button>
                <button type="submit" class="btn btn-success">Simpan & Lanjutkan</button>
                <button type="submit" class="btn btn-primary">Simpan Barang</button>
            </div>
            
        </form>
    </section>

    <script>
        document.querySelectorAll('.image-upload-box').forEach(box => {
            box.addEventListener('click', function () {
                this.querySelector('.image-input').click();
            });
        });

        document.querySelectorAll('.image-input').forEach(input => {
            input.addEventListener('change', function (event) {
                let file = event.target.files[0];
                if (file) {
                    let reader = new FileReader();
                    reader.onload = function (e) {
                        let previewImage = input.closest('.image-upload-box').querySelector('.preview-image');
                        let iconPlaceholder = input.closest('.image-upload-box').querySelector('.icon-placeholder');

                        previewImage.src = e.target.result;
                        previewImage.classList.remove('d-none');
                        iconPlaceholder.classList.add('d-none'); 
                    }
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>

    <!-- FontAwesome untuk ikon kamera -->

@endsection
