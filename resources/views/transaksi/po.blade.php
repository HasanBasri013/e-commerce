@extends('layouts.app')

@section('content')
<body class="hold-transition sidebar-mini">
    <section class="wrapper">
        <section class="content">
            <section class="container-fluid">
                <section class="card-header bg-primary">
                    <h3 class="card-title">Purchase Order</h3>
                </section>
                <section class="card-body">
                    <!-- Header Form -->
                    <form id="purchaseOrderForm">
                        <section class="row">
                            <section class="col-md-2">
                                <section class="form-group">
                                    <section class="input-group d-flex align-items-center">
                                        <input type="text" class="form-control form-control-sm" id="po_number" placeholder="Kode PO">
                                        <section class="input-group-append" id="po_number_append">
                                            <button class="btn btn-outline-secondary btn-sm" type="button">...</button>
                                        </section>
                                    </section>
                                </section>
                            </section>
                            <section class="col-md-2">
                                <section class="form-group">
                                    <input type="date" class="form-control form-control-sm" id="po_date">
                                </section>
                            </section>
                        </section>
                        <section class="row">
                            <section class="col-md-2">
                                <section class="form-group">
                                    <section class="input-group d-flex align-items-center">
                                        <input type="text" class="form-control form-control-sm" id="supplier" placeholder="Kode Supplier">
                                        <section class="input-group-append" id="supplier_append">
                                            <button class="btn btn-outline-secondary btn-sm" type="button" >...</button>
                                        </section>
                                        <input type="hidden" id="supplier_id" name="IDSupplier" />
                                    </section>
                                </section>
                            </section>
                            <section class="col-md-6">
                                <section class="form-group">
                                    <section class="input-group">
                                        <input type="text" class="form-control form-control-sm" id="supplier_name" placeholder="Nama Supplier">
                                    </section>
                                </section>
                            </section>
                            <section class="col-md-2">
                                <section class="form-group .text-right">
                                        <button type="button" class="btn btn-success btn-sm" id="addNewItem">Add New Item</button>
                                </section>
                            </section>
                        </section>

                        <!-- Detail Table -->
                        <section class="table-responsive">
                            <table class="table table-bordered" style="font-size: 12px; width: 100%;">
                                <thead class="bg-light">
                                    <tr>
                                        <th>X</th>
                                        <th class="col-2">Kode</th>
                                        <th class="col-3">Item Name</th>
                                        <th class="col-1">Satuan</th>
                                        <th class="col-qty">Qty</th>
                                        <th>Price List</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody id="itemDetailBody">
                                    <tr id="row_1">
                                        <td><button type="button" class="btn btn-danger btn-sm remove-item" data-row="1">X</button></td>
                                        <td>
                                            <section class="input-group d-flex align-items-center">
                                                <input type="text" class="form-control form-control-sm" placeholder="Item Code" id="item_code_1">
                                                <section class="input-group-append">
                                                    <button class="btn btn-outline-secondary btn-sm showCodeBtn" data-row="1" type="button">...</button>
                                                </section>
                                            </section>
                                        </td>
                                        <td><span style="font-size: 14px;" id="item_name_1" readonly></span></td>
                                        <td><span id="unit_1" readonly></span></td>
                                        <td><input type="number" class="form-control form-control-sm" placeholder="Quantity" id="qty_1" min="1"></td>
                                        <td><input type="number" class="form-control form-control-sm" placeholder="Price" id="price_1" min="0"></td>
                                        <td><input type="number" class="form-control form-control-sm" placeholder="Subtotal" id="subtotal_1" readonly></td>
                                        <td><input type="hidden" id="id_barang_1"></td>  <!-- Input tersembunyi untuk menyimpan IDBarang -->
                                    </tr>
                                    <!-- Rows will be dynamically added here -->
                                </tbody>
                            </table>
                        </section>
                        <!-- Footer -->
                        <section class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <textarea id="notes" class="form-control form-control-sm" placeholder="Keterangan"></textarea>
                                </div>
                                <div class="col-md-2 ms-auto">
                                    <input type="number" id="total_amount" name="total_amount" class="form-control form-control-sm" placeholder="Enter Total Amount" required>
                                </div>
                            </div>
                            
                        </section>
                        <section class="form-group">
                            <label>Status</label>
                            <input type="text" class="form-control form-control-sm" value="Posted Trans; [Hasan-19/09/2024 15:18]" readonly>
                        </section>

                        <!-- Buttons -->
                        <section class="form-group text-right">
                            <button type="button" class="btn btn-primary btn-sm" id="savePO">
                                <i class="fas fa-save"></i> Save
                            </button>
                            <button type="button" class="btn btn-success btn-sm" id="PrintPO">
                                <i class="fas fa-print"></i> Print
                            </button>
                        </section>
                        
                    </form>
                </section>
            </section>
        </section>
    </section>

   <!-- Modal for Supplier Selection -->
<div class="modal fade" id="supplierModal" tabindex="-1" role="dialog" aria-labelledby="supplierModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="supplierModalLabel">Select Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" id="searchSupplier" class="form-control" placeholder="Search supplier by code or name">
                <div id="supplierTableContainer">
                    <!-- Supplier grid will be inserted here dynamically -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="barangModal" tabindex="-1" role="dialog" aria-labelledby="barangModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document"> <!-- Increased size with modal-lg -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="barangModalLabel">Select Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" id="searchBarang" class="form-control" placeholder="Search barang by code or name">
                <div id="barangTableContainer">
                    <!-- Barang grid will be inserted here dynamically -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
{{-- scrip --}}
<script>
    let selectedRowIndex = 1; // Variabel global untuk menyimpan indeks baris yang sedang dipilih

    $(document).ready(function() {
        // Fungsi umum untuk memuat tabel (supplier atau barang)
        function loadTable(url, container, searchTerm = '') {
            $.ajax({
                url: url,
                type: 'GET',
                data: { search: searchTerm },
                success: function(response) {
                    const tableHtml = generateTableHtml(response, container === '#supplierTableContainer' ? 'supplier' : 'barang');
                    $(container).html(tableHtml);
                },
                error: function() {
                    alert("Terjadi kesalahan saat memuat data.");
                }
            });
        }

        // Fungsi untuk menghasilkan tabel HTML
        function generateTableHtml(response, type) {
            const isSupplier = type === 'supplier';
            let headers = isSupplier
            ? ['#', 'Supplier Code', 'Supplier Name', 'Action']
            : ['#', 'ID Barang', 'Kode Barang', 'Nama Barang', 'Satuan', 'Harga Beli', 'Kategori', 'Action'];  // Menambahkan IDBarang di header

            let tableHtml = `
                <table class="table table-bordered table-sm">
                    <thead class="thead-light">
                        <tr>${headers.map(h => `<th>${h}</th>`).join('')}</tr>
                    </thead>
                    <tbody>
            `;

            const items = isSupplier ? response.suppliers : response.barangs;
            if (items.length > 0) {
                items.forEach((item, index) => {
                    tableHtml += `
                        <tr>
                            <td>${index + 1}</td>
                            ${isSupplier
                                ? `
                                    <td>${item.KodeSupplier}</td>
                                    <td>${item.NamaSupplier}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm select-supplier"
                                                data-code="${item.KodeSupplier}" 
                                                data-name="${item.NamaSupplier}">
                                                
                                            Select
                                        </button>
                                    </td>
                                `
                                : `
                                    <td>${item.IDBarang}</td>
                                    <td>${item.KodeBarang}</td>
                                    <td>${item.NamaBarang}</td>
                                    <td>${item.Satuan}</td>
                                    <td>${item.HargaBeli}</td>
                                    <td>${item.Kategori}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm select-barang"
                                                data-id="${item.IDBarang}"
                                                data-code="${item.KodeBarang}" 
                                                data-name="${item.NamaBarang}" 
                                                data-satuan="${item.Satuan}" 
                                                data-harga="${item.HargaBeli}">
                                            Select
                                        </button>
                                    </td>
                                `}
                        </tr>
                    `;
                });
            } else {
                tableHtml += `<tr><td colspan="${headers.length}" class="text-center">No ${type} found.</td></tr>`;
            }

            tableHtml += `</tbody></table>`;
            return tableHtml;
        }

        // Tombol untuk memuat modal supplier
        $('#supplier_append button').on('click', function() {
            $('#supplierModal').modal('show');
            loadTable("{{ route('component.supplier.modal') }}", '#supplierTableContainer');
        });

        // Delegasi event untuk memilih supplier
        $(document).on('click', '.select-supplier', function() {
    const supplierCode = $(this).data('code');  // Kode Supplier
    const supplierName = $(this).data('name');  // Nama Supplier
    const supplierId = $(this).data('id');     // ID Supplier
    
    $('#supplier').val(supplierCode);           // Set Kode Supplier ke input
    $('#supplier_name').val(supplierName);     // Set Nama Supplier ke input
    
    // Optionally, if you want to store the IDSupplier in a hidden field
    $('#supplier_id').val(supplierId);         // Set ID Supplier (hidden field) or any other variable

    $('#supplierModal').modal('hide');          // Close the modal
});
        // Tombol untuk memuat modal barang
        $('#itemDetailBody').on('click', '.showCodeBtn', function() {
            selectedRowIndex = $(this).data('row'); // Simpan baris yang dipilih
            $('#barangModal').modal('show');
            loadTable("{{ route('component.barang.modal') }}", '#barangTableContainer');
        });

        // Delegasi event untuk memilih barang
        $(document).on('click', '.select-barang', function() {
            $('#item_code_' + selectedRowIndex).val($(this).data('code'));
            $('#item_name_' + selectedRowIndex).text($(this).data('name'));
            $('#unit_' + selectedRowIndex).text($(this).data('satuan'));
            $('#price_' + selectedRowIndex).val($(this).data('harga'));
            $('#id_barang_' + selectedRowIndex).val($(this).data('id'));
            $('#barangModal').modal('hide');
        });

        // Tombol untuk menambah baris baru
        $('#addNewItem').on('click', function() {
            let newRowIndex = $('#itemDetailBody tr').length + 1;
            let newRow = `
                <tr>
                    <td><button type="button" class="btn btn-danger btn-sm remove-item">X</button></td>
                    <td>
                        <section class="input-group d-flex align-items-center">
                            <input type="text" class="form-control form-control-sm" id="item_code_${newRowIndex}" placeholder="Item Code">
                            <section class="input-group-append">
                                <button class="btn btn-outline-secondary btn-sm showCodeBtn" data-row="${newRowIndex}" type="button">...</button>
                            </section>
                        </section>
                    </td>
                    <td><span id="item_name_${newRowIndex}" style="font-size: 14px;"></span></td>
                    <td><span id="unit_${newRowIndex}"></span></td>
                    <td><input type="number" class="form-control form-control-sm qty-input" id="qty_${newRowIndex}" min="1" placeholder="Qty"></td>
                    <td><input type="number" class="form-control form-control-sm price-input" id="price_${newRowIndex}" min="0" placeholder="Price"></td>
                    <td><input type="number" class="form-control form-control-sm" id="subtotal_${newRowIndex}" readonly></td>
                     <td><input type="hidden" id="id_barang_${newRowIndex}" />
                </tr>
            `;

            $('#itemDetailBody').append(newRow);
            setTimeout(calculateTotalAmount, 100); 
        });

        $(document).ready(function() {
            calculateTotalAmount();
        });
                // Menghapus baris ketika tombol X di klik
            $(document).on('click', '.remove-item', function() {
                $(this).closest('tr').remove(); // Menghapus baris yang berisi tombol X
                updateRowIndexes(); // Memperbarui urutan baris setelah penghapusan
            });
            function updateRowIndexes() {
    $('#itemDetailBody tr').each(function(index) {
        // Update ID input untuk setiap baris
        const rowIndex = index + 1; // Indeks mulai dari 1
        $(this).find('td:eq(1) input').attr('id', 'item_code_' + rowIndex);
        $(this).find('td:eq(2) span').attr('id', 'item_name_' + rowIndex);
        $(this).find('td:eq(3) span').attr('id', 'unit_' + rowIndex);
        $(this).find('td:eq(4) input').attr('id', 'qty_' + rowIndex);
        $(this).find('td:eq(5) input').attr('id', 'price_' + rowIndex);
        $(this).find('td:eq(6) input').attr('id', 'subtotal_' + rowIndex);
        $(this).find('td:eq(7) input').attr('id', 'id_barang_' + rowIndex);
        
        // Update button showCodeBtn
        $(this).find('.showCodeBtn').attr('data-row', rowIndex);
    });
}
function calculateTotalAmount() {
    let totalAmount = 0;

    // Looping melalui setiap baris untuk menghitung total
    $('#itemDetailBody tr').each(function() {
        let subtotal = $(this).find('input[id^="subtotal_"]').val();
        if (subtotal && !isNaN(subtotal)) {
            totalAmount += parseFloat(subtotal); // Menambahkan subtotal ke totalAmount
        }
    });

    // Menampilkan totalAmount pada input dengan id "total_amount"
    $('#total_amount').val(totalAmount.toFixed(2)); // Menampilkan hasil dengan 2 angka desimal
}

        // Fungsi untuk menghitung subtotal berdasarkan Qty dan Price
        $(document).on('input', '.qty-input, .price-input', function() {
            let rowIndex = $(this).closest('tr').index() + 1;
            let qty = $('#qty_' + rowIndex).val();
            let price = $('#price_' + rowIndex).val();
            
            // Validasi input untuk menghindari hasil NaN
            if (!isNaN(qty) && !isNaN(price)) {
                let subtotal = parseFloat(qty) * parseFloat(price);
                $('#subtotal_' + rowIndex).val(subtotal.toFixed(2)); // Menampilkan subtotal dengan dua angka desimal
            } else {
                $('#subtotal_' + rowIndex).val(''); // Kosongkan subtotal jika input tidak valid
            }
            calculateTotalAmount();
        });

        // Fungsi untuk menghitung subtotal di row pertama saat qty diinputkan
        $('#qty_1, #price_1').on('input', function() {
            let qty = $('#qty_1').val();
            let price = $('#price_1').val();
            
            // Validasi input untuk menghindari hasil NaN
            if (!isNaN(qty) && !isNaN(price)) {
                let subtotal = parseFloat(qty) * parseFloat(price);
                $('#subtotal_1').val(subtotal.toFixed(2)); // Menampilkan subtotal dengan dua angka desimal
            } else {
                $('#subtotal_1').val(''); // Kosongkan subtotal jika input tidak valid
            }
            calculateTotalAmount();
        });

        $(document).ready(function() {
    // Mengatur nilai input date ke tanggal hari ini
    const today = new Date().toISOString().split('T')[0]; // Mendapatkan tanggal dalam format YYYY-MM-DD
    $('#po_date').val(today); // Mengatur nilai input tanggal
});
$('#savePO').on('click', function() {
    const items = [];

    $('#itemDetailBody tr').each(function() {
        const rowIndex = $(this).index() + 1;
        const item = {
            id_barang: $('#id_barang_' + rowIndex).val(),
            qty: $('#qty_' + rowIndex).val(),
            subtotal: $('#subtotal_' + rowIndex).val()
        };
        items.push(item);
    });

    const poData = {
        po_number: $('#po_number').val(),
        po_date: $('#po_date').val(),
        IDSupplier: $('#supplier_id').val(),  // Gunakan IDSupplier dari hidden input
        total_amount: $('#total_amount').val(),
        notes: $('#notes').val(),
        items: items
    };

    $.ajax({
        url: '{{ route('purchase_order.store') }}',
        type: 'POST',
        data: poData,
        success: function(response) {
            alert('Purchase Order berhasil disimpan!');
            window.location.href = '{{ route('purchase_order.create') }}'; // Redirect ke form
        },
        error: function(response) {
            alert('Terjadi kesalahan saat menyimpan Purchase Order.');
        }
    });
});


});
</script>
@endsection
