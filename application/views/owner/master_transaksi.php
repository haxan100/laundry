<?php $this->load->view('owner/partials/header', ['pageTitle' => 'Master Transaksi']); ?>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    
                    <!-- Page Title -->
                    <div class="row">
                        <div class="col-12">
                            <h4 class="page-title">Master Transaksi</h4>
                        </div>
                    </div>

                    <!-- Date Filter -->
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-end">
                                        <div class="col-md-3">
                                            <label class="form-label">Tanggal Mulai</label>
                                            <input type="date" class="form-control" id="startDate" value="<?= $start_date ?>">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Tanggal Akhir</label>
                                            <input type="date" class="form-control" id="endDate" value="<?= $end_date ?>">
                                        </div>
                                        <div class="col-md-3">
                                            <button type="button" class="btn btn-primary" onclick="filterTransaksi()">Filter</button>
                                            <button type="button" class="btn btn-secondary" onclick="resetFilter()">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Transaksi Table -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h5 class="card-title mb-0">Daftar Transaksi</h5>
                                        <div class="d-flex gap-2">
                                            <button class="btn btn-success btn-sm" id="exportExcel">
                                                <i class="mdi mdi-file-excel me-1"></i>Excel
                                            </button>
                                            <button class="btn btn-danger btn-sm" id="exportPdf">
                                                <i class="mdi mdi-file-pdf me-1"></i>PDF
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover" id="transaksiTable">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kode Transaksi</th>
                                                    <th>Customer</th>
                                                    <th>Kasir</th>
                                                    <th>Total</th>
                                                    <th>Payment</th>
                                                    <th>Status</th>
                                                    <th>Tanggal</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Data will be loaded via AJAX -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<!-- Detail Modal -->
<div class="modal fade" id="detailModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Transaksi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="detailContent">
                <!-- Detail content will be loaded here -->
            </div>
        </div>
    </div>
</div>

<!-- Update Status Modal -->
<div class="modal fade" id="statusModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Status Transaksi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="statusForm">
                    <input type="hidden" id="transaksiId">
                    <div class="mb-3">
                        <label class="form-label">Kode Transaksi</label>
                        <input type="text" class="form-control" id="kodeTransaksi" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status Saat Ini</label>
                        <input type="text" class="form-control" id="currentStatus" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status Baru</label>
                        <select class="form-select" id="newStatus" required>
                            <option value="">Pilih Status</option>
                            <option value="pending">PENDING</option>
                            <option value="process">PROCESS</option>
                            <option value="completed">COMPLETED</option>
                            <option value="cancelled">CANCELLED</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="updateStatusFromModal()">Update Status</button>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('owner/partials/footer'); ?>

<script>
    $(document).ready(function() {
        loadTransaksi();
        
        $('#exportExcel').click(function() {
            exportData('excel');
        });
        
        $('#exportPdf').click(function() {
            exportData('pdf');
        });
    });

    function loadTransaksi(startDate = null, endDate = null) {
        let ajaxData = {};
        if (startDate && endDate) {
            ajaxData = {
                start_date: startDate,
                end_date: endDate
            };
        }
        
        $('#transaksiTable').DataTable({
            destroy: true,
            processing: true,
            serverSide: false,
            ajax: {
                url: '<?= base_url('owner/get_transaksi_ajax') ?>',
                type: 'POST',
                data: ajaxData,
                dataSrc: ''
            },
            columns: [
                { 
                    data: null,
                    render: function(data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                { data: 'kode_transaksi' },
                { 
                    data: null,
                    render: function(data, type, row) {
                        if (row.customer_nama) {
                            return row.customer_nama + (row.no_hp ? '<br><small class="text-muted">' + row.no_hp + '</small>' : '');
                        } else if (row.nama_customer) {
                            return row.nama_customer + (row.no_hp ? '<br><small class="text-muted">' + row.no_hp + '</small>' : '');
                        }
                        return 'Tamu';
                    }
                },
                { 
                    data: 'kasir_nama',
                    render: function(data, type, row) {
                        return data || 'N/A';
                    }
                },
                { 
                    data: 'total',
                    render: function(data, type, row) {
                        return 'Rp ' + new Intl.NumberFormat('id-ID').format(data);
                    }
                },
                { 
                    data: 'payment_method',
                    render: function(data, type, row) {
                        return data ? data.toUpperCase() : 'N/A';
                    }
                },
                { 
                    data: 'status',
                    render: function(data, type, row) {
                        let badgeClass = 'secondary';
                        if (data === 'completed') badgeClass = 'success';
                        else if (data === 'pending') badgeClass = 'warning';
                        else if (data === 'process') badgeClass = 'info';
                        else if (data === 'cancelled') badgeClass = 'danger';
                        
                        return '<span class="badge bg-' + badgeClass + '">' + data.toUpperCase() + '</span>';
                    }
                },
                { 
                    data: 'created_at',
                    render: function(data, type, row) {
                        return new Date(data).toLocaleDateString('id-ID') + '<br><small class="text-muted">' + new Date(data).toLocaleTimeString('id-ID') + '</small>';
                    }
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return '<button class="btn btn-info btn-sm me-1" onclick="viewDetail(' + row.id_transaksi + ')"><i class="mdi mdi-eye"></i></button>' +
                               '<button class="btn btn-warning btn-sm" onclick="openStatusModal(' + row.id_transaksi + ', \'' + row.status + '\', \'' + row.kode_transaksi + '\')" title="Update Status"><i class="mdi mdi-pencil"></i></button>';
                    }
                }
            ],
            order: [[7, 'desc']],
            pageLength: 25,
            language: {
                "sProcessing": "Sedang memproses...",
                "sLengthMenu": "Tampilkan _MENU_ entri",
                "sZeroRecords": "Tidak ditemukan data yang sesuai",
                "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
                "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
                "sSearch": "Cari:",
                "oPaginate": {
                    "sFirst": "Pertama",
                    "sPrevious": "Sebelumnya",
                    "sNext": "Selanjutnya",
                    "sLast": "Terakhir"
                }
            }
        });
    }

    function filterTransaksi() {
        const startDate = $('#startDate').val();
        const endDate = $('#endDate').val();
        
        if (!startDate || !endDate) {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan!',
                text: 'Harap pilih tanggal mulai dan tanggal akhir'
            });
            return;
        }
        
        if (startDate > endDate) {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan!',
                text: 'Tanggal mulai tidak boleh lebih besar dari tanggal akhir'
            });
            return;
        }
        
        loadTransaksi(startDate, endDate);
    }

    function resetFilter() {
        $('#startDate').val('<?= $start_date ?>');
        $('#endDate').val('<?= $end_date ?>');
        loadTransaksi();
    }

    function viewDetail(id) {
        $.ajax({
            url: '<?= base_url('owner/get_transaksi_detail') ?>',
            type: 'POST',
            data: { id: id },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    const data = response.data;
                    let html = `
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Informasi Transaksi</h6>
                                <table class="table table-sm">
                                    <tr><td>Kode Transaksi</td><td>: ${data.kode_transaksi}</td></tr>
                                    <tr><td>Tanggal</td><td>: ${new Date(data.created_at).toLocaleString('id-ID')}</td></tr>
                                    <tr><td>Status</td><td>: <span class="badge bg-${data.status === 'completed' ? 'success' : data.status === 'pending' ? 'warning' : 'secondary'}">${data.status.toUpperCase()}</span></td></tr>
                                    <tr><td>Payment</td><td>: ${data.payment_method ? data.payment_method.toUpperCase() : 'N/A'}</td></tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h6>Informasi Customer</h6>
                                <table class="table table-sm">
                                    <tr><td>Nama</td><td>: ${data.nama_customer || 'Tamu'}</td></tr>
                                    <tr><td>No. HP</td><td>: ${data.no_hp || '-'}</td></tr>
                                    <tr><td>Tier</td><td>: ${data.customer_tier || '-'}</td></tr>
                                    <tr><td>Kasir</td><td>: ${data.kasir_nama || 'N/A'}</td></tr>
                                </table>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <h6>Detail Perhitungan</h6>
                                <div class="card">
                                    <div class="card-body">
                                        ${data.tier_laundry ? `<div class="mb-2"><strong>${data.tier_laundry}</strong></div>` : ''}
                                        <div class="d-flex justify-content-between mb-2">
                                            <span>${data.berat_kg || 0} kg × Rp ${new Intl.NumberFormat('id-ID').format(data.harga_per_kg || 0)}</span>
                                            <span><strong>Rp ${new Intl.NumberFormat('id-ID').format((data.berat_kg || 0) * (data.harga_per_kg || 0))}</strong></span>
                                        </div>
                                        ${data.jarak_km && data.harga_per_km ? `
                                            <div class="d-flex justify-content-between mb-2">
                                                <span>${data.jarak_km} km × Rp ${new Intl.NumberFormat('id-ID').format(data.harga_per_km)}</span>
                                                <span><strong>Rp ${new Intl.NumberFormat('id-ID').format(data.jarak_km * data.harga_per_km)}</strong></span>
                                            </div>
                                        ` : ''}
                                        <hr>
                                        <div class="d-flex justify-content-between">
                                            <span><strong>TOTAL:</strong></span>
                                            <span><strong>Rp ${new Intl.NumberFormat('id-ID').format(data.total)}</strong></span>
                                        </div>
                                        <div class="d-flex justify-content-between mt-2">
                                            <span>Pembayaran:</span>
                                            <span><strong>${(data.payment_method || 'N/A').toUpperCase()}</strong></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    
                    if (data.catatan) {
                        html += `
                            <div class="row mt-3">
                                <div class="col-12">
                                    <h6>Catatan</h6>
                                    <p class="text-muted">${data.catatan}</p>
                                </div>
                            </div>
                        `;
                    }
                    
                    $('#detailContent').html(html);
                    $('#detailModal').modal('show');
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: response.message
                    });
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Gagal memuat detail transaksi'
                });
            }
        });
    }

    function openStatusModal(id, currentStatus, kodeTransaksi) {
        $('#transaksiId').val(id);
        $('#kodeTransaksi').val(kodeTransaksi);
        $('#currentStatus').val(currentStatus.toUpperCase());
        $('#newStatus').val('');
        $('#statusModal').modal('show');
    }

    function updateStatusFromModal() {
        const id = $('#transaksiId').val();
        const newStatus = $('#newStatus').val();
        
        if (!newStatus) {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan!',
                text: 'Harap pilih status baru'
            });
            return;
        }
        
        $.ajax({
            url: '<?= base_url('owner/update_status_transaksi') ?>',
            type: 'POST',
            data: { 
                id: id, 
                status: newStatus 
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.message,
                        timer: 2000,
                        showConfirmButton: false
                    });
                    $('#statusModal').modal('hide');
                    $('#transaksiTable').DataTable().ajax.reload();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: response.message
                    });
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Gagal mengupdate status transaksi'
                });
            }
        });
    }
    
    function exportData(type) {
        const startDate = $('#startDate').val();
        const endDate = $('#endDate').val();
        
        if (!startDate || !endDate) {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan!',
                text: 'Pilih tanggal terlebih dahulu!'
            });
            return;
        }
        
        window.open(`<?= base_url('export/transactions') ?>?type=${type}&start_date=${startDate}&end_date=${endDate}`, '_blank');
    }
</script>