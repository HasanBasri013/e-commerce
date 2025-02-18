@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Supplier</h3>
            </div>
            <div class="card-body">
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <!-- Button to trigger modal for adding supplier -->
                            <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addSupplierModal">
                                <i class="fa fa-plus"></i> Tambah Supplier
                            </a>
                        </div>
                        
                        <div class="col-sm-12 col-md-6">
                            <div id="example1_filter" class="dataTables_filter text-end">
                                <form action="{{ route('component.supplier') }}" method="GET" id="search-form">
                                    <input type="search" name="search" id="search" class="form-control form-control-sm custom-search" placeholder="Search..." value="{{ request()->get('search') }}" aria-controls="example1">
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Supplier</th>
                                        <th>Nama Supplier</th>
                                        <th>Alamat</th>
                                        <th>No. Telp</th>
                                        <th>Email</th>
                                        <th>Kontak</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($suppliers as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $item->KodeSupplier }}</td>
                                            <td>{{ $item->NamaSupplier }}</td>
                                            <td>{{ $item->Alamat }}</td>
                                            <td>{{ $item->NoTelp }}</td>
                                            <td>{{ $item->Email }}</td>
                                            <td>{{ $item->Kontak }}</td>
                                            <td>
                                                <!-- Edit button with data attributes for each item -->
                                                <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editSupplierModal" 
                                                   data-id="{{ $item->IDSupplier }}" 
                                                   data-kode="{{ $item->KodeSupplier }}" 
                                                   data-nama="{{ $item->NamaSupplier }}" 
                                                   data-alamat="{{ $item->Alamat }}" 
                                                   data-telp="{{ $item->NoTelp }}" 
                                                   data-email="{{ $item->Email }}" 
                                                   data-kontak="{{ $item->Kontak }}">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                                <form action="{{ route('supplier.destroy', $item->IDSupplier) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this supplier?')">
                                                        <i class="fa fa-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-sm-12 col-md-5">
                                    <div class="dataTables_info" id="example1_info">
                                        Showing {{ $suppliers->firstItem() }} to {{ $suppliers->lastItem() }} of {{ $suppliers->total() }} entries
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                                        {{ $suppliers->links('pagination::bootstrap-4') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Add Supplier -->
    <div class="modal fade" id="addSupplierModal" tabindex="-1" aria-labelledby="addSupplierModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSupplierModalLabel">Tambah Supplier</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form to Add Supplier -->
                    <form id="addSupplierForm" method="POST" action="{{ route('supplier.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="kodeSupplier" class="form-label">Kode Supplier</label>
                            <input type="text" class="form-control" id="kodeSupplier" name="KodeSupplier" required>
                        </div>
                        <div class="mb-3">
                            <label for="namaSupplier" class="form-label">Nama Supplier</label>
                            <input type="text" class="form-control" id="namaSupplier" name="NamaSupplier" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="Alamat" required>
                        </div>
                        <div class="mb-3">
                            <label for="noTelp" class="form-label">No. Telp</label>
                            <input type="text" class="form-control" id="noTelp" name="NoTelp" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="Email" required>
                        </div>
                        <div class="mb-3">
                            <label for="kontak" class="form-label">Kontak</label>
                            <input type="text" class="form-control" id="kontak" name="Kontak" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Edit Supplier -->
    <div class="modal fade" id="editSupplierModal" tabindex="-1" aria-labelledby="editSupplierModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSupplierModalLabel">Edit Supplier</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form to Edit Supplier -->
                    <form id="editSupplierForm" method="POST" action="{{ route('supplier.update', ':id') }}">
                        @csrf
                        @method('PUT') <!-- Method spoofing for PUT request -->
                        <div class="mb-3">
                            <label for="editKodeSupplier" class="form-label">Kode Supplier</label>
                            <input type="text" class="form-control" id="editKodeSupplier" name="KodeSupplier" required>
                        </div>
                        <div class="mb-3">
                            <label for="editNamaSupplier" class="form-label">Nama Supplier</label>
                            <input type="text" class="form-control" id="editNamaSupplier" name="NamaSupplier" required>
                        </div>
                        <div class="mb-3">
                            <label for="editAlamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="editAlamat" name="Alamat" required>
                        </div>
                        <div class="mb-3">
                            <label for="editNoTelp" class="form-label">No. Telp</label>
                            <input type="text" class="form-control" id="editNoTelp" name="NoTelp" required>
                        </div>
                        <div class="mb-3">
                            <label for="editEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="editEmail" name="Email" required>
                        </div>
                        <div class="mb-3">
                            <label for="editKontak" class="form-label">Kontak</label>
                            <input type="text" class="form-control" id="editKontak" name="Kontak" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editSupplierModal = document.getElementById('editSupplierModal');
        editSupplierModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget; // Button that triggered the modal
            const id = button.getAttribute('data-id');
            const kode = button.getAttribute('data-kode');
            const nama = button.getAttribute('data-nama');
            const alamat = button.getAttribute('data-alamat');
            const telp = button.getAttribute('data-telp');
            const email = button.getAttribute('data-email');
            const kontak = button.getAttribute('data-kontak');

            // Set the values of the fields in the modal
            document.getElementById('editKodeSupplier').value = kode;
            document.getElementById('editNamaSupplier').value = nama;
            document.getElementById('editAlamat').value = alamat;
            document.getElementById('editNoTelp').value = telp;
            document.getElementById('editEmail').value = email;
            document.getElementById('editKontak').value = kontak;

            // Update the form action with the correct update URL for this item
            const form = document.getElementById('editSupplierForm');
            form.action = '/supplier/' + id + '/update';
        });
    });
</script>
@endsection
