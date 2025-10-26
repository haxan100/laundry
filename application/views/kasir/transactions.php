<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0"><i class="fas fa-list me-2"></i>Transaksi Hari Ini</h4>
                        <a href="<?= base_url('kasir') ?>" class="btn btn-light btn-sm">
                            <i class="fas fa-arrow-left me-1"></i>Kembali ke POS
                        </a>
                    </div>
                    <div class="card-body">
                        <!-- Date Filter -->
                        <div class="row mb-3">
                            <div class="col-12">
                                <form method="GET" class="row g-3 align-items-end">
                                    <div class="col-md-3">
                                        <label class="form-label">Tanggal Mulai</label>
                                        <input type="date" class="form-control" name="start_date" value="<?= $start_date ?>">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Tanggal Akhir</label>
                                        <input type="date" class="form-control" name="end_date" value="<?= $end_date ?>">
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                        <a href="<?= base_url('kasir/transactions') ?>" class="btn btn-secondary">Reset</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <hr>
                        
                        <?php if (empty($transactions)): ?>
                            <div class="text-center py-5">
                                <i class="fas fa-receipt fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">Belum ada transaksi hari ini</h5>
                            </div>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Kode Transaksi</th>
                                            <th>Customer</th>
                                            <th>Berat (kg)</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th>Waktu & Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($transactions as $trx): ?>
                                            <tr>
                                                <td><strong><?= $trx->kode_transaksi ?></strong></td>
                                                <td>
                                                    <?= $trx->nama_customer ?>
                                                    <?php if ($trx->customer_type == 'customer'): ?>
                                                        <span class="badge bg-info">Member</span>
                                                    <?php elseif ($trx->customer_type == 'customer_baru'): ?>
                                                        <span class="badge bg-success">Baru</span>
                                                    <?php else: ?>
                                                        <span class="badge bg-secondary">Tamu</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td><?= number_format($trx->berat_kg ?? 0, 1) ?> kg</td>
                                                <td><strong>Rp <?= number_format($trx->total, 0, ',', '.') ?></strong></td>
                                                <td>
                                                    <?php
                                                    $status_class = [
                                                        'pending' => 'warning',
                                                        'process' => 'info', 
                                                        'completed' => 'success',
                                                        'cancelled' => 'danger'
                                                    ];
                                                    ?>
                                                    <span class="badge bg-<?= $status_class[$trx->status] ?? 'secondary' ?>">
                                                        <?= ucfirst($trx->status) ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <?= date('H:i', strtotime($trx->created_at)) ?>
                                                    <br>
                                                    <a href="<?= base_url('receipt/print_receipt/' . $trx->id_transaksi) ?>" target="_blank" class="btn btn-sm btn-outline-primary mt-1">
                                                        <i class="fas fa-print"></i> Print
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="mt-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="text-muted">
                                            Periode: <?= date('d/m/Y', strtotime($start_date)) ?> - <?= date('d/m/Y', strtotime($end_date)) ?><br>
                                            Total: <?= count($transactions) ?> transaksi
                                        </p>
                                    </div>
                                    <div class="col-md-6 text-end">
                                        <strong>Total Pendapatan: Rp <?= number_format(array_sum(array_column($transactions, 'total')), 0, ',', '.') ?></strong>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>