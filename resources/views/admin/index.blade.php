@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Daftar Banner</h2>
        <a href="{{ route('banners.create') }}" class="btn btn-success mb-3">Tambah Banner</a>

        <!-- Menampilkan pesan sukses jika ada -->
        @if(session('success'))
            <!-- Triggering the success popup -->
            <div id="success-popup" class="popup show">
                <div class="popup-content">
                    <div class="checkmark">&#10004;</div> <!-- Checkmark icon -->
                    <p>{{ session('success') }}</p> <!-- Success message -->
                </div>
            </div>
        @endif

        <!-- Tabel Daftar Banner -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($banners as $banner)
                    <tr>
                        <td><img src="{{ asset('storage/uploads/' . $banner->image) }}" width="100" alt="Banner Image"></td>
                        <td>{{ $banner->description }}</td>
                        <td>
                            <a href="{{ route('banners.edit', $banner->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('banners.destroy', $banner->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus banner ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <script>
        // Check if there is a success message in the session
        @if(session('success'))
            // Show the popup
            var popup = document.getElementById('success-popup');
            popup.classList.add('show');

            // After the animation duration (1 second), hide the popup
            setTimeout(function() {
                popup.classList.remove('show');
            }, 2000); // Wait 4 seconds to allow animation to finish (1 second animation + 3 seconds delay)
        @endif
    </script>


@endsection
