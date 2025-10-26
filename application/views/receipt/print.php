<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <style>
        @media print {
            body { margin: 0; }
            .no-print { display: none; }
        }
        
        body {
            font-family: 'Courier New', monospace;
            font-size: 12px;
            line-height: 1.4;
            margin: 0;
            padding: 20px;
            background: white;
        }
        
        .receipt {
            width: 80mm;
            margin: 0 auto;
            background: white;
            padding: 10px;
        }
        
        .header {
            text-align: center;
            border-bottom: 2px dashed #333;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
        
        .logo {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .address {
            font-size: 10px;
            margin-bottom: 3px;
        }
        
        .transaction-info {
            margin-bottom: 15px;
        }
        
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 3px;
        }
        
        .items {
            border-top: 1px dashed #333;
            border-bottom: 1px dashed #333;
            padding: 10px 0;
            margin: 15px 0;
        }
        
        .item-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }
        
        .total-section {
            margin-top: 10px;
        }
        
        .total-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 3px;
        }
        
        .grand-total {
            font-weight: bold;
            font-size: 14px;
            border-top: 1px solid #333;
            padding-top: 5px;
            margin-top: 5px;
        }
        
        .footer {
            text-align: center;
            margin-top: 20px;
            border-top: 2px dashed #333;
            padding-top: 10px;
            font-size: 10px;
        }
        
        .print-btn {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <button class="print-btn no-print" onclick="window.print()">Print Receipt</button>
    
    <div class="receipt">
        <div class="header">
            <div class="logo"><?= $laundry_setting->nama_laundry ?? 'LAUNDRY SYSTEM' ?></div>
            <div class="address"><?= $laundry_setting->alamat ?? 'Jl. Contoh No. 123' ?></div>
            <div class="address">Telp: <?= $laundry_setting->telepon ?? '(021) 1234-5678' ?></div>
            <?php if ($laundry_setting->email): ?>
            <div class="address">Email: <?= $laundry_setting->email ?></div>
            <?php endif; ?>
        </div>
        
        <div class="transaction-info">
            <div class="info-row">
                <span>No. Transaksi:</span>
                <span><?= $transaction->kode_transaksi ?></span>
            </div>
            <div class="info-row">
                <span>Tanggal:</span>
                <span><?= date('d/m/Y H:i', strtotime($transaction->created_at)) ?></span>
            </div>
            <div class="info-row">
                <span>Customer:</span>
                <span><?= $transaction->nama_customer ?></span>
            </div>
            <?php if ($transaction->no_hp): ?>
            <div class="info-row">
                <span>No. HP:</span>
                <span><?= $transaction->no_hp ?></span>
            </div>
            <?php endif; ?>
            <?php if ($transaction->berat_kg): ?>
            <div class="info-row">
                <span>Berat:</span>
                <span><?= $transaction->berat_kg ?> kg</span>
            </div>
            <?php endif; ?>
            <?php if ($transaction->jarak_km): ?>
            <div class="info-row">
                <span>Jarak:</span>
                <span><?= $transaction->jarak_km ?> km</span>
            </div>
            <?php endif; ?>
            <?php if (!empty($transaction->catatan)): ?>
            <div class="info-row">
                <span>Catatan:</span>
                <span><?= $transaction->catatan ?></span>
            </div>
            <?php endif; ?>
        </div>
        
        <div class="items">
            <?php if ($transaction->tier_laundry): ?>
            <div class="item-row">
                <span><?= $transaction->tier_laundry ?></span>
                <span></span>
            </div>
            <?php endif; ?>
            <div class="item-row">
                <span><?= $transaction->berat_kg ? $transaction->berat_kg . ' kg x Rp ' . number_format($transaction->harga_per_kg, 0, ',', '.') : 'Layanan Laundry' ?></span>
                <span>Rp <?= number_format($transaction->berat_kg * $transaction->harga_per_kg, 0, ',', '.') ?></span>
            </div>
            <?php if ($transaction->jarak_km && $transaction->harga_per_km): ?>
            <div class="item-row">
                <span><?= $transaction->jarak_km ?> km x Rp <?= number_format($transaction->harga_per_km, 0, ',', '.') ?></span>
                <span>Rp <?= number_format($transaction->jarak_km * $transaction->harga_per_km, 0, ',', '.') ?></span>
            </div>
            <?php endif; ?>
        </div>
        
        <div class="total-section">
            <div class="total-row grand-total">
                <span>TOTAL:</span>
                <span>Rp <?= number_format($transaction->total, 0, ',', '.') ?></span>
            </div>
            <div class="total-row">
                <span>Pembayaran:</span>
                <span><?= strtoupper($transaction->payment_method) ?></span>
            </div>
        </div>
        
        <div class="footer">
            <div>Terima kasih atas kepercayaan Anda!</div>
            <div>Simpan struk ini sebagai bukti</div>
        </div>
    </div>
    
    <script>
        window.onload = function() {
            setTimeout(function() {
                window.print();
            }, 500);
        }
    </script>
</body>
</html>