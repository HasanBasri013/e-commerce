@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Customer</h3>
            </div>
            <div class="card-body">
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <!-- Button to trigger modal for adding Customer -->
                            <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addCustomerModal">
                                <i class="fa fa-plus"></i> Tambah Customer
                            </a>
                        </div>
                        
                        <div class="col-sm-12 col-md-6">
                            <div id="example1_filter" class="dataTables_filter text-end">
                                <form action="{{ route('component.customer') }}" method="GET" id="search-form">
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
                                        <th>Kode Customer</th>
                                        <th>Nama Customer</th>
                                        <th>Alamat</th>
                                        <th>No. Telp</th>
                                        <th>Email</th>
                                        <th>Kontak</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customers as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $item->KodeCustomer }}</td>
                                            <td>{{ $item->NamaCustomer }}</td>
                                            <td>{{ $item->Alamat }}</td>
                                            <td>{{ $item->NoTelp }}</td>
                                            <td>{{ $item->Email }}</td>
                                            <td>{{ $item->Kontak }}</td>
                                            <td>
                                                <!-- Edit button with data attributes for each item -->
                                                <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editCustomerModal" 
                                                   data-id="{{ $item->IDCustomer }}" 
                                                   data-kode="{{ $item->KodeCustomer }}" 
                                                   data-nama="{{ $item->NamaCustomer }}" 
                                                   data-alamat="{{ $item->Alamat }}" 
                                                   data-telp="{{ $item->NoTelp }}" 
                                                   data-email="{{ $item->Email }}" 
                                                   data-kontak="{{ $item->Kontak }}">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                                <form action="{{ route('customer.destroy', $item->IDCustomer) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Customer?')">
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
                                        Showing {{ $customers->firstItem() }} to {{ $customers->lastItem() }} of {{ $customers->total() }} entries
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                                        {{ $customers->links('pagination::bootstrap-4') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Add Customer -->
    <div class="modal fade" id="addCustomerModal" tabindex="-1" aria-labelledby="addCustomerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCustomerModalLabel">Tambah Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form to Add Customer -->
                    <form id="addCustomerForm" method="POST" action="{{ route('customer.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="kodeCustomer" class="form-label">Kode Customer</label>
                            <input type="text" class="form-control" id="kodeCustomer" name="KodeCustomer" required>
                        </div>
                        <div class="mb-3">
                            <label for="namaCustomer" class="form-label">Nama Customer</label>
                            <input type="text" class="form-control" id="namaCustomer" name="NamaCustomer" required>
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

    <!-- Modal for Edit Customer -->
    <div class="modal fade" id="editCustomerModal" tabindex="-1" aria-labelledby="editCustomerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCustomerModalLabel">Edit Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form to Edit Customer -->
                    <form id="editCustomerForm" method="POST" action="{{ route('customer.update', ':id') }}">
                        @csrf
                        @method('PUT') <!-- Method spoofing for PUT request -->
                        <div class="mb-3">
                            <label for="editKodeCustomer" class="form-label">Kode Customer</label>
                            <input type="text" class="form-control" id="editKodeCustomer" name="KodeCustomer" required>
                        </div>
                        <div class="mb-3">
                            <label for="editNamaCustomer" class="form-label">Nama Customer</label>
                            <input type="text" class="form-control" id="editNamaCustomer" name="NamaCustomer" required>
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
        const editCustomerModal = document.getElementById('editCustomerModal');
        editCustomerModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget; // Button that triggered the modal
            const id = button.getAttribute('data-id');
            const kode = button.getAttribute('data-kode');
            const nama = button.getAttribute('data-nama');
            const alamat = button.getAttribute('data-alamat');
            const telp = button.getAttribute('data-telp');
            const email = button.getAttribute('data-email');
            const kontak = button.getAttribute('data-kontak');

            // Set the values of the fields in the modal
            document.getElementById('editKodeCustomer').value = kode;
            document.getElementById('editNamaCustomer').value = nama;
            document.getElementById('editAlamat').value = alamat;
            document.getElementById('editNoTelp').value = telp;
            document.getElementById('editEmail').value = email;
            document.getElementById('editKontak').value = kontak;

            // Update the form action with the correct update URL for this item
            const form = document.getElementById('editCustomerForm');
            form.action = '/customer/' + id + '/update';
        });
    });
</script>
@endsection
