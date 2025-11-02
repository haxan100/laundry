<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?> - Laundry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            backdrop-filter: blur(10px);
            background: rgba(255,255,255,0.95);
        }
        
        .card-header {
            background: transparent;
            border: none;
            text-align: center;
            padding: 30px 20px 20px;
        }
        
        .logo {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: white;
            font-size: 2rem;
        }
        
        .form-control {
            border-radius: 15px;
            padding: 15px 20px;
            border: 2px solid #e9ecef;
            font-size: 16px;
        }
        
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 15px;
            padding: 15px;
            font-weight: 600;
            font-size: 16px;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        
        .transaction-item {
            background: white;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .transaction-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
        }
        
        .badge {
            padding: 8px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .text-muted {
            color: #6c757d !important;
        }
        
        #transactionList {
            margin-top: 20px;
        }
        
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #6c757d;
        }
        
        .empty-state i {
            font-size: 3rem;
            margin-bottom: 20px;
            opacity: 0.5;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="logo">
                    <i class="fas fa-tshirt"></i>
                </div>
                <h4 class="mb-0">Cek Transaksi Laundry</h4>
                <p class="text-muted mb-0">Masukkan nomor telepon Anda</p>
            </div>
            <div class="card-body">
                <form id="checkForm">
                    <div class="mb-3">
                        <label class="form-label">Nomor Telepon</label>
                        <div class="input-group">
                            <span class="input-group-text" style="border-radius: 15px 0 0 15px; background: #f8f9fa; border: 2px solid #e9ecef; border-right: none;">
                                <i class="fas fa-phone"></i>
                            </span>
                            <input type="tel" class="form-control" id="phoneInput" placeholder="8123456789" 
                                   style="border-radius: 0 15px 15px 0; border-left: none;" maxlength="15">
                        </div>
                        <small class="text-muted">Contoh: 8123456789 (tanpa 0 di depan)</small>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search me-2"></i>Cek Transaksi
                    </button>
                </form>
            </div>
        </div>
        
        <div id="transactionList"></div>
    </div>

    <!-- Detail Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1">
        <div class="modal-dialog modal-fullscreen-sm-down">
            <div class="modal-content" style="border-radius: 20px;">
                <div class="modal-header" style="border: none; padding: 30px 20px 10px;">
                    <h5 class="modal-title">Detail Transaksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="detailContent" style="padding: 20px;">
                    <!-- Detail content will be loaded here -->
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // Format phone input
            $('#phoneInput').on('input', function() {
                let value = $(this).val().replace(/[^0-9]/g, '');
                if (value.length > 0 && value.charAt(0) !== '8') {
                    value = '8' + value.replace(/^[0-9]/, '');
                }
                $(this).val(value);
            });

            $('#checkForm').on('submit', function(e) {
                e.preventDefault();
                checkTransaction();
            });
        });

        function checkTransaction() {
            const phone = $('#phoneInput').val().trim();
            
            if (!phone) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan!',
                    text: 'Harap masukkan nomor telepon'
                });
                return;
            }

            if (phone.length < 10) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan!',
                    text: 'Nomor telepon minimal 10 digit'
                });
                return;
            }

            $.ajax({
                url: '<?= base_url('user/check_transaction') ?>',
                type: 'POST',
                data: { phone: phone },
                dataType: 'json',
                beforeSend: function() {
                    $('button[type="submit"]').prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i>Mencari...');
                },
                success: function(response) {
                    if (response.status === 'success') {
                        displayTransactions(response.data);
                    } else {
                        $('#transactionList').html(`
                            <div class="card" style="border-radius: 20px;">
                                <div class="card-body empty-state">
                                    <i class="fas fa-search"></i>
                                    <h5>Tidak Ada Transaksi</h5>
                                    <p class="text-muted">${response.message}</p>
                                </div>
                            </div>
                        `);
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat mencari transaksi'
                    });
                },
                complete: function() {
                    $('button[type="submit"]').prop('disabled', false).html('<i class="fas fa-search me-2"></i>Cek Transaksi');
                }
            });
        }

        function displayTransactions(transactions) {
            let html = '<div class="card" style="border-radius: 20px;"><div class="card-header"><h6 class="mb-0">Riwayat Transaksi</h6></div><div class="card-body" style="padding: 0;">';
            
            transactions.forEach(function(transaction, index) {
                const statusColors = {
                    'pending': 'warning',
                    'process': 'info', 
                    'completed': 'success',
                    'cancelled': 'danger'
                };
                
                const customerName = transaction.customer_nama || transaction.nama_customer || 'Tamu';
                const date = new Date(transaction.created_at).toLocaleDateString('id-ID');
                const time = new Date(transaction.created_at).toLocaleTimeString('id-ID', {hour: '2-digit', minute: '2-digit'});
                const total = new Intl.NumberFormat('id-ID').format(transaction.total);
                
                html += `
                    <div class="transaction-item ${index === transactions.length - 1 ? '' : 'border-bottom'}" onclick="viewDetail(${transaction.id_transaksi})" style="border-radius: ${index === 0 ? '0' : '0'}; margin-bottom: 0;">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <h6 class="mb-1">${transaction.kode_transaksi}</h6>
                                <small class="text-muted">${customerName}</small>
                            </div>
                            <span class="badge bg-${statusColors[transaction.status] || 'secondary'}">${transaction.status.toUpperCase()}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <small class="text-muted">${date} • ${time}</small>
                            </div>
                            <div class="text-end">
                                <strong class="text-primary">Rp ${total}</strong>
                            </div>
                        </div>
                    </div>
                `;
            });
            
            html += '</div></div>';
            $('#transactionList').html(html);
        }

        function viewDetail(id) {
            $.ajax({
                url: '<?= base_url('user/get_transaction_detail') ?>',
                type: 'POST',
                data: { id: id },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        const data = response.data;
                        const statusColors = {
                            'pending': 'warning',
                            'process': 'info',
                            'completed': 'success', 
                            'cancelled': 'danger'
                        };
                        
                        let html = `
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="card" style="border-radius: 15px; background: #f8f9fa;">
                                        <div class="card-body">
                                            <h6 class="card-title">Informasi Transaksi</h6>
                                            <table class="table table-sm table-borderless">
                                                <tr><td>Kode</td><td>: <strong>${data.kode_transaksi}</strong></td></tr>
                                                <tr><td>Tanggal</td><td>: ${new Date(data.created_at).toLocaleDateString('id-ID')}</td></tr>
                                                <tr><td>Waktu</td><td>: ${new Date(data.created_at).toLocaleTimeString('id-ID')}</td></tr>
                                                <tr><td>Status</td><td>: <span class="badge bg-${statusColors[data.status]}">${data.status.toUpperCase()}</span></td></tr>
                                                <tr><td>Kasir</td><td>: ${data.kasir_nama || 'N/A'}</td></tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <div class="card" style="border-radius: 15px;">
                                        <div class="card-body">
                                            <h6 class="card-title">Detail Perhitungan</h6>
                                            ${data.tier_laundry ? `<div class="mb-2"><small class="text-muted">Paket: <strong>${data.tier_laundry}</strong></small></div>` : ''}
                                            <div class="d-flex justify-content-between mb-2">
                                                <span>${data.berat_kg || 0} kg × Rp ${new Intl.NumberFormat('id-ID').format(data.harga_per_kg || 0)}</span>
                                                <span><strong>Rp ${new Intl.NumberFormat('id-ID').format((data.berat_kg || 0) * (data.harga_per_kg || 0))}</strong></span>
                                            </div>
                                            ${data.jarak_km && data.harga_per_km ? `
                                                <div class="d-flex justify-content-between mb-2">
                                                    <span>Ongkir ${data.jarak_km} km × Rp ${new Intl.NumberFormat('id-ID').format(data.harga_per_km)}</span>
                                                    <span><strong>Rp ${new Intl.NumberFormat('id-ID').format(data.jarak_km * data.harga_per_km)}</strong></span>
                                                </div>
                                            ` : ''}
                                            <hr>
                                            <div class="d-flex justify-content-between">
                                                <span><strong>TOTAL:</strong></span>
                                                <span><strong class="text-primary">Rp ${new Intl.NumberFormat('id-ID').format(data.total)}</strong></span>
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
                                        <div class="card" style="border-radius: 15px; background: #fff3cd;">
                                            <div class="card-body">
                                                <h6 class="card-title">Catatan</h6>
                                                <p class="mb-0">${data.catatan}</p>
                                            </div>
                                        </div>
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
    </script>
</body>
</html>