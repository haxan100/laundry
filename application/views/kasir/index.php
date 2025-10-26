<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --secondary: #8b5cf6;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --info: #06b6d4;
            --dark: #1e293b;
            --light: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-300: #cbd5e1;
            --gray-400: #94a3b8;
            --gray-500: #64748b;
            --gray-600: #475569;
            --gray-700: #334155;
            --gray-800: #1e293b;
            --gray-900: #0f172a;
            --border-radius: 16px;
            --shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            --shadow-lg: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        [data-theme="dark"] {
            --primary: #818cf8;
            --primary-dark: #6366f1;
            --secondary: #a78bfa;
            --dark: #0f172a;
            --light: #1e293b;
            --gray-100: #334155;
            --gray-200: #475569;
            --gray-300: #64748b;
            --gray-400: #94a3b8;
            --gray-500: #cbd5e1;
            --gray-600: #e2e8f0;
            --gray-700: #f1f5f9;
            --gray-800: #f8fafc;
            --gray-900: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            min-height: 100vh;
            color: var(--gray-900);
            transition: all 0.3s ease;
        }

        .pos-container {
            display: grid;
            grid-template-columns: 1fr 420px;
            height: 100vh;
            gap: 0;
        }

        .pos-left {
            background: var(--light);
            display: flex;
            flex-direction: column;
            box-shadow: var(--shadow);
            position: relative;
            overflow: hidden;
        }

        .pos-left::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 200px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            opacity: 0.05;
            z-index: 0;
        }

        .pos-header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: var(--shadow);
            position: relative;
            z-index: 10;
        }

        .pos-header h1 {
            font-size: 28px;
            font-weight: 700;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .transaction-info {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .today-stats {
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(10px);
            padding: 12px 20px;
            border-radius: 12px;
            color: white;
            font-size: 14px;
            font-weight: 500;
            border: 1px solid rgba(255,255,255,0.2);
        }

        .theme-toggle {
            background: rgba(255,255,255,0.15);
            border: 1px solid rgba(255,255,255,0.2);
            color: white;
            padding: 10px;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .theme-toggle:hover {
            background: rgba(255,255,255,0.25);
            transform: scale(1.05);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logout-btn {
            background: rgba(255,255,255,0.15);
            border: 1px solid rgba(255,255,255,0.2);
            color: white;
            padding: 10px 18px;
            border-radius: 10px;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
            backdrop-filter: blur(10px);
        }

        .logout-btn:hover {
            background: rgba(255,255,255,0.25);
            color: white;
            transform: translateY(-2px);
        }

        .pos-content {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
            position: relative;
            z-index: 5;
        }

        .laundry-form {
            background: white;
            border-radius: var(--border-radius);
            padding: 20px;
            box-shadow: var(--shadow);
            border: 1px solid var(--gray-200);
            position: relative;
            overflow: hidden;
        }

        .laundry-form::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
        }

        .form-label {
            font-weight: 600;
            color: var(--gray-700);
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-select, .form-control {
            border: 2px solid var(--gray-200);
            border-radius: 12px;
            padding: 14px 16px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: var(--light);
            color: var(--gray-900);
        }

        .form-select:focus, .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
            outline: none;
        }

        .delivery-section {
            background: var(--gray-100);
            border-radius: 12px;
            padding: 20px;
            border: 1px solid var(--gray-200);
        }

        .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border: none;
            border-radius: 12px;
            padding: 16px 24px;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.4);
        }

        .pos-right {
            background: var(--light);
            display: flex;
            flex-direction: column;
            border-left: 1px solid var(--gray-200);
            box-shadow: var(--shadow);
        }

        .cart-header {
            background: var(--dark);
            color: white;
            padding: 24px;
            text-align: center;
            position: relative;
        }

        .cart-header h3 {
            margin: 0;
            font-weight: 600;
            font-size: 20px;
        }

        .customer-section {
            padding: 16px;
            border-bottom: 1px solid var(--gray-200);
            background: white;
        }

        .customer-type-tabs {
            display: flex;
            gap: 8px;
            margin-bottom: 20px;
        }

        .customer-tab {
            flex: 1;
            padding: 12px 16px;
            border: 2px solid var(--gray-200);
            background: white;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 13px;
            font-weight: 500;
            color: var(--gray-600);
        }

        .customer-tab.active {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
        }

        .customer-form {
            animation: slideIn 0.4s ease;
        }

        .customer-select-wrapper {
            position: relative;
        }

        .customer-search {
            position: relative;
        }

        .customer-search input {
            padding-right: 40px;
        }

        .customer-search i {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-400);
        }

        .customer-dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border: 2px solid var(--gray-200);
            border-top: none;
            border-radius: 0 0 12px 12px;
            max-height: 200px;
            overflow-y: auto;
            z-index: 1000;
            box-shadow: var(--shadow);
        }

        .customer-option {
            padding: 12px 16px;
            cursor: pointer;
            transition: all 0.2s ease;
            border-bottom: 1px solid var(--gray-100);
        }

        .customer-option:hover {
            background: var(--gray-100);
        }

        .customer-option:last-child {
            border-bottom: none;
        }

        .tier-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .tier-bronze { background: #cd7f32; color: white; }
        .tier-silver { background: #c0c0c0; color: #333; }
        .tier-gold { background: #ffd700; color: #333; }
        .tier-platinum { background: #e5e4e2; color: #333; }
        
        .selected-customer-card {
            background: var(--gray-100);
            border: 2px solid var(--primary);
            border-radius: 12px;
            padding: 16px;
            animation: slideIn 0.3s ease;
        }
        
        .customer-details {
            font-size: 14px;
            color: var(--gray-600);
        }
        
        .customer-details i {
            color: var(--primary);
            width: 16px;
        }

        .calculation-result {
            flex: 1;
            padding: 16px;
            overflow-y: auto;
            background: white;
        }

        .empty-calculation {
            text-align: center;
            color: var(--gray-400);
            padding: 60px 20px;
        }

        .empty-calculation i {
            font-size: 48px;
            margin-bottom: 16px;
            opacity: 0.5;
        }

        .calculation-details {
            background: var(--gray-100);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            border-left: 4px solid var(--primary);
        }

        .price-breakdown {
            background: white;
            border-radius: 12px;
            padding: 16px;
            border: 1px solid var(--gray-200);
        }
        
        .breakdown-header {
            border-bottom: 2px solid var(--primary);
            padding-bottom: 8px;
            margin-bottom: 12px;
        }
        
        .breakdown-section {
            margin-bottom: 12px;
            padding: 12px;
            background: var(--gray-100);
            border-radius: 8px;
            border-left: 4px solid var(--primary);
        }
        
        .section-title {
            font-size: 12px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 8px;
            letter-spacing: 0.5px;
        }
        
        .detail-row {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            color: var(--gray-700);
        }
        
        .tier-info {
            font-size: 11px;
            color: var(--gray-500);
            margin-top: 4px;
            font-style: italic;
        }
        
        .breakdown-divider {
            height: 1px;
            background: var(--gray-300);
            margin: 8px 0;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            padding: 4px 0;
            font-size: 14px;
        }

        .total-row.final {
            font-size: 20px;
            font-weight: 700;
            color: var(--primary);
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(139, 92, 246, 0.1));
            padding: 16px;
            border-radius: 8px;
            margin-top: 16px;
            border: 2px solid var(--primary);
        }

        .payment-section {
            padding: 16px;
            border-top: 1px solid var(--gray-200);
            background: white;
        }

        .payment-methods {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 24px;
        }

        .payment-method {
            padding: 16px;
            border: 2px solid var(--gray-200);
            border-radius: 12px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background: white;
            font-weight: 500;
        }

        .payment-method.active {
            border-color: var(--primary);
            background: rgba(99, 102, 241, 0.1);
            color: var(--primary);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.2);
        }

        .checkout-btn {
            background: linear-gradient(135deg, var(--success), #059669);
            color: white;
            border: none;
            padding: 18px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 700;
            width: 100%;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        }

        .checkout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4);
        }

        .checkout-btn:disabled {
            background: var(--gray-400);
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }
        
        .checkout-btn.btn-success {
            background: linear-gradient(135deg, var(--success), #059669);
            animation: pulse 2s infinite;
        }
        
        .checkout-btn.btn-secondary {
            background: var(--gray-400);
            animation: none;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.02); }
        }

        .animate-pulse {
            animation: pulse 2s infinite;
        }

        /* Price Information Panel Styles */
        .price-info-card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            border: 1px solid var(--gray-200);
            overflow: hidden;
        }

        .price-info-header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 12px 16px;
            font-weight: 600;
        }

        .price-info-header h6 {
            margin: 0;
            font-size: 14px;
        }

        .price-info-body {
            padding: 16px;
            max-height: 200px;
            overflow-y: auto;
        }

        .price-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 12px;
            margin-bottom: 8px;
            background: var(--gray-100);
            border-radius: 8px;
            border-left: 4px solid var(--primary);
            transition: all 0.3s ease;
        }

        .price-item:hover {
            background: rgba(99, 102, 241, 0.1);
            transform: translateX(4px);
        }

        .price-item:last-child {
            margin-bottom: 0;
        }

        .price-item-name {
            font-weight: 500;
            color: var(--gray-700);
            font-size: 13px;
        }

        .price-item-range {
            font-size: 11px;
            color: var(--gray-500);
            margin-top: 2px;
        }

        .price-item-value {
            font-weight: 600;
            color: var(--primary);
            font-size: 13px;
        }

        .ongkir-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 12px;
            margin-bottom: 8px;
            background: var(--gray-100);
            border-radius: 8px;
            border-left: 4px solid var(--success);
            transition: all 0.3s ease;
        }

        .ongkir-item:hover {
            background: rgba(16, 185, 129, 0.1);
            transform: translateX(4px);
        }

        .ongkir-item:last-child {
            margin-bottom: 0;
        }

        .ongkir-item-name {
            font-weight: 500;
            color: var(--gray-700);
            font-size: 13px;
        }

        .ongkir-item-value {
            font-weight: 600;
            color: var(--success);
            font-size: 13px;
        }

        @media (max-width: 768px) {
            .pos-container {
                grid-template-columns: 1fr;
                grid-template-rows: 1fr auto;
            }
            
            .pos-right {
                height: 60vh;
                border-left: none;
                border-top: 1px solid var(--gray-200);
            }
            
            .transaction-info {
                display: none;
            }
            
            .pos-content {
                padding: 20px;
            }
            
            .laundry-form {
                padding: 24px;
            }
        }

        /* Dark mode styles */
        [data-theme="dark"] {
            --light: #1e293b;
            --gray-100: #334155;
            --gray-200: #475569;
            --gray-300: #64748b;
            --gray-700: #e2e8f0;
            --gray-900: #f8fafc;
        }

        [data-theme="dark"] body {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            color: #f8fafc;
        }

        [data-theme="dark"] .laundry-form,
        [data-theme="dark"] .pos-left,
        [data-theme="dark"] .pos-right,
        [data-theme="dark"] .customer-section,
        [data-theme="dark"] .calculation-result,
        [data-theme="dark"] .payment-section,
        [data-theme="dark"] .price-breakdown {
            background: #1e293b;
            color: #f8fafc;
            border-color: #475569;
        }

        [data-theme="dark"] .delivery-section,
        [data-theme="dark"] .breakdown-section {
            background: #334155;
            color: #f8fafc;
            border-color: #64748b;
        }

        [data-theme="dark"] .form-control,
        [data-theme="dark"] .form-select {
            background: #334155;
            color: #f8fafc;
            border-color: #64748b;
        }

        [data-theme="dark"] .form-control:focus,
        [data-theme="dark"] .form-select:focus {
            background: #334155;
            color: #f8fafc;
            border-color: var(--primary);
        }

        [data-theme="dark"] .customer-tab {
            background: #334155;
            color: #e2e8f0;
            border-color: #64748b;
        }

        [data-theme="dark"] .customer-tab.active {
            background: var(--primary);
            color: white;
        }

        [data-theme="dark"] .selected-customer-card {
            background: #334155;
            color: #f8fafc;
            border-color: var(--primary);
        }

        [data-theme="dark"] .payment-method {
            background: #334155;
            color: #f8fafc;
            border-color: #64748b;
        }

        [data-theme="dark"] .payment-method.active {
            background: rgba(99, 102, 241, 0.2);
            color: var(--primary);
            border-color: var(--primary);
        }

        [data-theme="dark"] .total-row,
        [data-theme="dark"] .section-title,
        [data-theme="dark"] .detail-row {
            color: #f8fafc;
        }

        [data-theme="dark"] .form-label {
            color: #e2e8f0;
        }

        [data-theme="dark"] .alert-info {
            background: rgba(99, 102, 241, 0.1);
            color: #f8fafc;
            border-color: var(--primary);
        }

        [data-theme="dark"] .alert-success {
            background: rgba(16, 185, 129, 0.1);
            color: #f8fafc;
            border-color: var(--success);
        }

        /* Dark mode for price info panels */
        [data-theme="dark"] .price-info-card {
            background: #1e293b;
            border-color: #475569;
        }

        [data-theme="dark"] .price-info-body {
            background: #1e293b;
            color: #f8fafc;
        }

        [data-theme="dark"] .price-item,
        [data-theme="dark"] .ongkir-item {
            background: #334155;
            color: #f8fafc;
        }

        [data-theme="dark"] .price-item-name,
        [data-theme="dark"] .ongkir-item-name {
            color: #e2e8f0;
        }

        [data-theme="dark"] .price-item-range {
            color: #94a3b8;
        }
    </style>
</head>
<body>
    <div class="pos-container">
        <!-- Left Panel - Services -->
        <div class="pos-left">
            <div class="pos-header">
                <h1><i class="fas fa-tshirt"></i>Laundry POS</h1>
                <div class="transaction-info">
                    <div class="today-stats animate-pulse" id="todayStatsContainer">
                        <i class="fas fa-chart-line me-2"></i>
                        <span>Transaksi Hari Ini: <strong><?= $today_transactions ?></strong></span>
                        <?php if ($today_transactions > 3): ?>
                            <div class="mt-2">
                                <a href="<?= base_url('kasir/transactions') ?>" class="btn btn-sm btn-outline-light">
                                    <i class="fas fa-list me-1"></i>Lihat Transaksi Lainnya
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="user-info">
                    <button class="theme-toggle" id="themeToggle">
                        <i class="fas fa-moon" id="themeIcon"></i>
                    </button>
                    <span><i class="fas fa-user me-2"></i><?= $user->nama_lengkap ?? $user->username ?></span>
                    <a href="<?= base_url('kasir/logout') ?>" class="logout-btn">
                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                    </a>
                </div>
            </div>
            
            <div class="pos-content">

                
                <div class="laundry-form">
                    <div class="mb-3">
                        <label class="form-label">Berat Laundry (Kg)</label>
                        <input type="number" class="form-control" id="beratKilo" placeholder="Masukkan berat dalam kg" min="0.5" step="0.5">
                        <small class="text-muted">Minimal 0.5 kg</small>
                    </div>
                    
                    <div class="delivery-section mb-3">
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="deliveryCheck">
                            <label class="form-check-label fw-bold" for="deliveryCheck">
                                <i class="fas fa-truck me-2"></i>Kirim ke Alamat
                            </label>
                        </div>
                        <div id="deliveryOptions" style="display: none;">
                            <label class="form-label">Jarak (KM)</label>
                            <input type="number" class="form-control" id="jarakKm" placeholder="Masukkan jarak dalam km" min="1" step="0.5">
                            <small class="text-muted">Biaya pengiriman: Rp 2.000/km</small>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Catatan</label>
                        <textarea class="form-control" id="catatanText" rows="2" placeholder="Catatan tambahan..."></textarea>
                    </div>
                    
                    <!-- Price Information -->
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="alert alert-info">
                                <h6><i class="fas fa-tshirt me-2"></i>Daftar Harga Laundry</h6>
                                <div id="laundryPriceList">Loading...</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="alert alert-success">
                                <h6><i class="fas fa-truck me-2"></i>Tarif Ongkir</h6>
                                <div id="ongkirPriceList">Loading...</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Right Panel - Cart -->
        <div class="pos-right">
            <div class="cart-header">
                <h3><i class="fas fa-receipt me-2"></i>Perhitungan</h3>
            </div>
            
            <div class="customer-section">
                <label class="form-label">Tipe Customer</label>
                <div class="customer-type-tabs">
                    <button class="customer-tab active" data-type="tamu">
                        <i class="fas fa-user me-1"></i>Tamu
                    </button>
                    <button class="customer-tab" data-type="customer">
                        <i class="fas fa-users me-1"></i>Member
                    </button>
                    <button class="customer-tab" data-type="customer_baru">
                        <i class="fas fa-user-plus me-1"></i>Baru
                    </button>
                </div>
                
                <div id="customerTamu" class="customer-form">
                    <p class="text-muted mb-0"><i class="fas fa-info-circle me-2"></i>Transaksi untuk tamu</p>
                </div>
                
                <div id="customerExisting" class="customer-form" style="display: none;">
                    <div class="mb-3">
                        <label class="form-label">Pilih Customer</label>
                        <select class="form-select" id="customerSelect">
                            <option value="">-- Pilih Customer --</option>
                        </select>
                    </div>
                    
                    <div id="selectedCustomerInfo" style="display: none;" class="selected-customer-card">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h6 class="mb-0" id="selectedCustomerName"></h6>
                            <button class="btn btn-sm btn-outline-danger" id="clearCustomerBtn">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="customer-details">
                            <p class="mb-1"><i class="fas fa-envelope me-2"></i><span id="selectedCustomerEmail"></span></p>
                            <p class="mb-1"><i class="fas fa-phone me-2"></i><span id="selectedCustomerPhone"></span></p>
                            <p class="mb-0"><i class="fas fa-star me-2"></i>Tier: <span id="selectedCustomerTier" class="tier-badge"></span></p>
                        </div>
                    </div>
                    

                </div>
                
                <div id="customerNew" class="customer-form" style="display: none;">
                    <div class="mb-3">
                        <label class="form-label">Nama Customer</label>
                        <input type="text" class="form-control" id="newCustomerName" placeholder="Masukkan nama customer">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">No. HP</label>
                        <input type="text" class="form-control" id="newCustomerPhone" placeholder="Masukkan nomor HP">
                    </div>
                    <button class="btn btn-success w-100" id="saveNewCustomerBtn">
                        <i class="fas fa-save me-2"></i>Simpan Customer
                    </button>
                </div>
            </div>
            
            <div class="calculation-result" id="calculationResult">
                <div class="empty-calculation">
                    <i class="fas fa-calculator"></i>
                    <p>Belum ada perhitungan</p>
                </div>
            </div>
            
            <div class="price-breakdown" id="priceBreakdown" style="display: none;">
                <div class="breakdown-header">
                    <h6 class="fw-bold mb-3"><i class="fas fa-calculator me-2"></i>Detail Harga</h6>
                </div>
                
                <div class="breakdown-section">
                    <div class="section-title">LAUNDRY</div>
                    <div class="detail-row">
                        <span id="beratDetail">0 kg</span>
                        <span>×</span>
                        <span id="hargaPerKgDetail">Rp 0</span>
                        <span>=</span>
                        <span id="subtotalLaundry" class="fw-bold">Rp 0</span>
                    </div>
                </div>
                
                <div class="breakdown-section" id="ongkirSection" style="display: none;">
                    <div class="section-title">PENGIRIMAN</div>
                    <div class="detail-row">
                        <span id="jarakDetail">0 km</span>
                        <span>×</span>
                        <span id="tarifOngkirDetail">Rp 0</span>
                        <span>=</span>
                        <span id="ongkirAmount" class="fw-bold">Rp 0</span>
                    </div>
                    <div class="tier-info" id="ongkirTierInfo"></div>
                </div>
                
                <div class="breakdown-divider"></div>
                
                <div class="total-row">
                    <span>Subtotal:</span>
                    <span id="subtotalBeforeDiscount" class="fw-bold">Rp 0</span>
                </div>
                
                <div class="total-row" id="discountRow" style="display: none;">
                    <span class="text-success">Diskon <span id="customerTierText"></span>:</span>
                    <span id="discountAmount" class="text-success fw-bold">-Rp 0</span>
                </div>
                

                
                <div class="breakdown-divider"></div>
                
                <div class="total-row final">
                    <span><i class="fas fa-money-bill-wave me-2"></i>TOTAL BAYAR:</span>
                    <span id="grandTotal" class="fw-bold">Rp 0</span>
                </div>
            </div>
            
            <div class="payment-section">
                <label class="form-label">Metode Pembayaran</label>
                <div class="payment-methods">
                    <div class="payment-method active" data-method="cash">
                        <i class="fas fa-money-bill-wave d-block mb-2"></i>Cash
                    </div>
                    <div class="payment-method" data-method="transfer">
                        <i class="fas fa-credit-card d-block mb-2"></i>Transfer
                    </div>
                </div>
                
                <button class="checkout-btn btn-secondary" id="checkoutBtn" disabled>
                    <i class="fas fa-check me-2"></i>Proses Transaksi
                </button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>
    
    <script>
        let laundryServices = [];
        let ongkirOptions = [];
        let customers = [];
        let selectedPaymentMethod = 'cash';
        let selectedCustomerType = 'tamu';
        let selectedCustomer = null;
        let calculationData = null;

        $(document).ready(function() {
            loadLaundryServices();
            loadOngkirOptions();
            loadCustomers();
            loadPriceInfo();
            initTheme();
            
            // Show initial breakdown
            resetCalculation();
            
            // Theme toggle
            $('#themeToggle').click(function() {
                toggleTheme();
            });
            
            // Delivery checkbox
            $('#deliveryCheck').change(function() {
                if ($(this).is(':checked')) {
                    $('#deliveryOptions').slideDown(300);
                } else {
                    $('#deliveryOptions').slideUp(300);
                    $('#jarakKm').val('');
                }
                calculatePrice();
            });
            
            // Auto calculate on weight input
            $('#beratKilo').on('input', function() {
                calculatePrice();
            });
            
            // Auto calculate on distance input
            $('#jarakKm').on('input', function() {
                calculatePrice();
            });
            
            // Payment method selection
            $('.payment-method').click(function() {
                $('.payment-method').removeClass('active');
                $(this).addClass('active');
                selectedPaymentMethod = $(this).data('method');
            });
            
            // Customer type selection
            $('.customer-tab').click(function() {
                $('.customer-tab').removeClass('active');
                $(this).addClass('active');
                selectedCustomerType = $(this).data('type');
                selectedCustomer = null;
                
                $('.customer-form').hide();
                if (selectedCustomerType === 'tamu') {
                    $('#customerTamu').fadeIn(300);
                } else if (selectedCustomerType === 'customer') {
                    $('#customerExisting').fadeIn(300);
                    setTimeout(() => {
                        loadCustomers();
                    }, 100);
                } else {
                    $('#customerNew').fadeIn(300);
                }
                
                // Recalculate price when customer type changes
                calculatePrice();
            });
            
            // Customer select change
            $('#customerSelect').change(function() {
                const customerId = $(this).val();
                console.log('Selected customer ID:', customerId);
                if (customerId) {
                    const customer = customers.find(c => (c.id_customer == customerId) || (c.Utama == customerId));
                    console.log('Found customer:', customer);
                    if (customer) {
                        selectCustomer(customer);
                        // Recalculate price with customer discount
                        calculatePrice();
                    }
                } else {
                    clearCustomerSelection();
                    // Recalculate price without discount
                    calculatePrice();
                }
            });
            
            // Checkout button
            $('#checkoutBtn').click(function() {
                processCheckout();
            });
            
            // Clear customer selection
            $('#clearCustomerBtn').click(function() {
                clearCustomerSelection();
            });
            
            // Add customer button
            $('#addCustomerBtn').click(function() {
                showAddCustomerModal();
            });
            
            // Save new customer button
            $('#saveNewCustomerBtn').click(function() {
                saveNewCustomer();
            });
        });

        function initTheme() {
            const savedTheme = localStorage.getItem('theme') || 'light';
            document.documentElement.setAttribute('data-theme', savedTheme);
            updateThemeIcon(savedTheme);
        }

        function toggleTheme() {
            const currentTheme = document.documentElement.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            
            document.documentElement.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            updateThemeIcon(newTheme);
        }

        function updateThemeIcon(theme) {
            const icon = $('#themeIcon');
            if (theme === 'dark') {
                icon.removeClass('fa-moon').addClass('fa-sun');
            } else {
                icon.removeClass('fa-sun').addClass('fa-moon');
            }
        }

        function loadLaundryServices() {
            $.get('<?= base_url("kasir/get_services") ?>', function(response) {
                if (response.status === 'success') {
                    laundryServices = response.data;
                    displayLaundryServices(laundryServices);
                }
            });
        }
        
        function loadOngkirOptions() {
            $.get('<?= base_url("kasir/get_ongkir") ?>', function(response) {
                if (response.status === 'success') {
                    ongkirOptions = response.data;
                    displayOngkirOptions(ongkirOptions);
                }
            });
        }

        function loadCustomers() {
            console.log('Loading customers...');
            $.ajax({
                url: '<?= base_url("kasir/get_customers") ?>',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log('Raw response:', response);
                    if (response && response.status === 'success' && response.data) {
                        customers = response.data;
                        console.log('Customers loaded:', customers.length);
                        displayCustomers();
                    } else {
                        console.error('Invalid response format:', response);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);
                    console.error('Status:', status);
                    console.error('Response text:', xhr.responseText);
                }
            });
        }
        
        function displayCustomers() {
            console.log('=== displayCustomers START ===');
            const select = $('#customerSelect');
            console.log('Select element found:', select.length > 0);
            console.log('Customers array:', customers);
            
            // Clear and add default option
            select.empty();
            select.append('<option value="">-- Pilih Customer --</option>');
            
            if (!customers || customers.length === 0) {
                console.log('No customers to display');
                select.append('<option value="">Tidak ada customer</option>');
                return;
            }
            
            // Add each customer
            customers.forEach((customer, index) => {
                const id = customer.id_customer;
                const nama = customer.nama || 'No Name';
                const telepon = customer.telepon || 'No Phone';
                const tier = customer.tier_level || 'bronze';
                const optionHtml = `<option value="${id}">${nama} - ${telepon} (${tier.toUpperCase()})</option>`;
                
                console.log(`Adding customer ${index + 1}:`, optionHtml);
                select.append(optionHtml);
            });
            
            console.log('Final dropdown HTML:', select.html());
            console.log('=== displayCustomers END ===');
        }

        function displayLaundryServices(serviceList) {
            const select = $('#layananSelect');
            select.empty().append('<option value="">-- Pilih Layanan --</option>');
            
            serviceList.forEach(service => {
                select.append(`<option value="${service.id_harga}" data-harga="${service.harga_per_kilo}">${service.nama_layanan} - Rp ${formatNumber(service.harga_per_kilo)}/kg</option>`);
            });
        }
        
        function displayOngkirOptions(ongkirList) {
            const select = $('#ongkirSelect');
            select.empty().append('<option value="">-- Pilih Area --</option>');
            
            ongkirList.forEach(ongkir => {
                select.append(`<option value="${ongkir.id_ongkir}" data-harga="${ongkir.harga_ongkir}">${ongkir.nama_area} - Rp ${formatNumber(ongkir.harga_ongkir)}</option>`);
            });
        }



        function calculatePrice() {
            const berat = parseFloat($('#beratKilo').val()) || 0;
            const isDelivery = $('#deliveryCheck').is(':checked');
            const jarakKm = parseFloat($('#jarakKm').val()) || 0;
            const customerId = selectedCustomer ? selectedCustomer.id_customer : null;
            
            if (berat <= 0) {
                resetCalculation();
                return;
            }
            
            $.ajax({
                url: '<?= base_url("kasir/calculate_price") ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    berat: berat,
                    jarak_km: jarakKm,
                    is_delivery: isDelivery,
                    customer_id: customerId
                },
                success: function(response) {
                    if (response.status === 'success') {
                        calculationData = response.data;
                        displayCalculation(response.data);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);
                }
            });
        }
        
        function resetCalculation() {
            $('#calculationResult').html(`
                <div class="empty-calculation">
                    <i class="fas fa-calculator"></i>
                    <p>Masukkan berat untuk kalkulasi</p>
                </div>
            `);
            
            // Reset breakdown to show empty state
            $('#priceBreakdown').show();
            $('#beratDetail').text('0 kg');
            $('#hargaPerKgDetail').text('Rp 0');
            $('#subtotalLaundry').text('Rp 0');
            $('#ongkirSection').hide();
            $('#subtotalBeforeDiscount').text('Rp 0');
            $('#discountRow').hide();
            $('#grandTotal').text('Rp 0');
            
            $('#checkoutBtn').prop('disabled', true).removeClass('btn-success').addClass('btn-secondary');
            calculationData = null;
        }

        function displayCalculation(data) {
            console.log('=== DISPLAY CALCULATION START ===');
            console.log('Data received:', data);
            
            // Update detailed breakdown - FORCE UPDATE
            console.log('Updating beratDetail...');
            $('#beratDetail').text(data.berat + ' kg');
            
            console.log('Updating hargaPerKgDetail...');
            $('#hargaPerKgDetail').text('Rp ' + formatNumber(data.harga_per_kg));
            
            console.log('Updating subtotalLaundry...');
            $('#subtotalLaundry').text('Rp ' + formatNumber(data.subtotal_laundry));
            
            // Update calculation result
            const container = $('#calculationResult');
            container.html(`
                <div class="calculation-details">
                    <h6 class="fw-bold mb-3"><i class="fas fa-weight me-2"></i>${data.tier}</h6>
                </div>
            `);
            
            // Show/hide delivery section
            if ($('#deliveryCheck').is(':checked') && data.jarak_km > 0) {
                $('#ongkirSection').show();
                $('#jarakDetail').text(data.jarak_km + ' km');
                const rateMatch = data.ongkir_tier.match(/Rp ([\d\.,]+)/);
                const rate = rateMatch ? rateMatch[1] : '2.000';
                $('#tarifOngkirDetail').text('Rp ' + rate);
                $('#ongkirAmount').text('Rp ' + formatNumber(data.ongkir));
                $('#ongkirTierInfo').text(data.ongkir_tier);
            } else {
                $('#ongkirSection').hide();
            }
            
            // Update totals
            $('#subtotalBeforeDiscount').text('Rp ' + formatNumber(data.subtotal_before_discount));
            
            // Show/hide discount
            if (data.discount_amount > 0) {
                $('#discountRow').show();
                $('#customerTierText').text(data.customer_tier);
                $('#discountAmount').text('-Rp ' + formatNumber(data.discount_amount));
            } else {
                $('#discountRow').hide();
            }
            
            $('#grandTotal').text('Rp ' + formatNumber(data.total));
            
            // Force show breakdown
            $('#priceBreakdown').show();
            
            // Enable checkout button
            if (data.total > 0) {
                $('#checkoutBtn').prop('disabled', false).removeClass('btn-secondary').addClass('btn-success');
            } else {
                $('#checkoutBtn').prop('disabled', true).removeClass('btn-success').addClass('btn-secondary');
            }
            
            console.log('=== DISPLAY CALCULATION END ===');
        }

        function processCheckout() {
            if (!calculationData) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Belum Ada Perhitungan',
                    text: 'Silakan masukkan berat terlebih dahulu!'
                });
                return;
            }
            
            let customerId = null;
            let customerName = null;
            let customerPhone = null;
            
            if (selectedCustomerType === 'customer') {
                if (!selectedCustomer) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Customer Belum Dipilih',
                        text: 'Silakan pilih customer terlebih dahulu!'
                    });
                    return;
                }
                customerId = selectedCustomer.id_customer;
                customerName = selectedCustomer.nama;
                customerPhone = selectedCustomer.telepon;
            } else if (selectedCustomerType === 'customer_baru') {
                customerName = $('#newCustomerName').val();
                customerPhone = $('#newCustomerPhone').val();
                if (!customerName || !customerPhone) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Data Customer Belum Lengkap',
                        text: 'Silakan isi nama dan no HP customer baru!'
                    });
                    return;
                }
            } else {
                customerName = 'Tamu';
            }
            
            const subtotalBeforeDiscount = calculationData.subtotal_before_discount;
            const subtotalAfterDiscount = calculationData.subtotal_after_discount;
            const total = calculationData.total;
            
            Swal.fire({
                title: 'Konfirmasi Transaksi',
                html: `
                    <div class="text-start">
                        <p><strong>Customer:</strong> ${customerName} ${customerPhone ? '(' + customerPhone + ')' : ''}</p>
                        <p><strong>Layanan:</strong> ${calculationData.tier}</p>
                        <p><strong>Berat:</strong> ${calculationData.berat} kg</p>
                        <p><strong>Harga/kg:</strong> Rp ${formatNumber(calculationData.harga_per_kg)}</p>
                        <p><strong>Subtotal:</strong> Rp ${formatNumber(subtotalBeforeDiscount)}</p>
                        ${calculationData.discount_amount > 0 ? `<p><strong>Diskon ${calculationData.customer_tier}:</strong> -Rp ${formatNumber(calculationData.discount_amount)}</p>` : ''}
                        <p><strong>Total:</strong> Rp ${formatNumber(total)}</p>
                        <p><strong>Pembayaran:</strong> ${selectedPaymentMethod.toUpperCase()}</p>
                    </div>
                `,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Proses!',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#10b981'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Process the transaction
                    const transactionData = {
                        customer_type: selectedCustomerType,
                        customer_id: customerId,
                        nama_customer: customerName,
                        no_hp: customerPhone,
                        total_kilo: calculationData.berat,
                        id_layanan: 1,
                        harga_per_kilo: calculationData.harga_per_kg,
                        subtotal_laundry: calculationData.subtotal_laundry,
                        is_delivery: $('#deliveryCheck').is(':checked') ? 1 : 0,
                        id_ongkir: null,
                        harga_ongkir: calculationData.ongkir,
                        discount_percent: 0,
                        discount_amount: calculationData.discount_amount,
                        subtotal: calculationData.subtotal_after_discount,
                        pajak: 0,
                        total: calculationData.total,
                        payment_method: selectedPaymentMethod,
                        catatan: $('#catatanText').val()
                    };
                    
                    $.ajax({
                        url: '<?= base_url("kasir/create_order") ?>',
                        type: 'POST',
                        dataType: 'json',
                        data: transactionData,
                        success: function(response) {
                            if (response.status === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Transaksi Berhasil!',
                                    text: response.message,
                                    showConfirmButton: true,
                                    confirmButtonText: 'Print Receipt',
                                    showCancelButton: true,
                                    cancelButtonText: 'Tutup'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.open('<?= base_url("receipt/print_receipt/") ?>' + response.transaction_id, '_blank', 'width=400,height=600');
                                    }
                                    resetForm();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal!',
                                    text: response.message || 'Terjadi kesalahan saat memproses transaksi'
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX Error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Terjadi kesalahan saat memproses transaksi'
                            });
                        }
                    });
                }
            });
        }

        function resetForm() {
            // Reset all form fields
            $('#layananSelect').val('');
            $('#beratKilo').val('');
            $('#deliveryCheck').prop('checked', false);
            $('#deliveryOptions').hide();
            $('#ongkirSelect').val('');
            $('#catatanText').val('');
            $('#customerSearchInput').val('');
            $('#newCustomerName').val('');
            $('#newCustomerPhone').val('');
            
            // Reset customer type to tamu
            $('.customer-tab').removeClass('active');
            $('.customer-tab[data-type="tamu"]').addClass('active');
            selectedCustomerType = 'tamu';
            selectedCustomer = null;
            calculationData = null;
            
            $('.customer-form').hide();
            $('#customerTamu').show();
            
            // Clear customer selection display
            clearCustomerSelection();
            
            // Reset calculation display
            $('#calculationResult').html(`
                <div class="empty-calculation">
                    <i class="fas fa-calculator"></i>
                    <p>Belum ada perhitungan</p>
                </div>
            `);
            $('#priceBreakdown').hide();
            $('#checkoutBtn').prop('disabled', true);
        }

        function selectCustomer(customer) {
            selectedCustomer = customer;
            console.log('selectCustomer called with:', customer);
            
            // Show selected customer info
            $('#selectedCustomerName').text(customer.nama);
            $('#selectedCustomerEmail').text(customer.email || '-');
            $('#selectedCustomerPhone').text(customer.telepon);
            
            const tierLevel = customer.tier_level || 'bronze';
            const tierBadge = $('#selectedCustomerTier');
            tierBadge.text(tierLevel.toUpperCase());
            tierBadge.removeClass('tier-bronze tier-silver tier-gold tier-platinum');
            tierBadge.addClass(`tier-${tierLevel}`);
            
            $('#selectedCustomerInfo').fadeIn(300);
        }
        
        function clearCustomerSelection() {
            selectedCustomer = null;
            $('#customerSelect').val('');
            $('#selectedCustomerInfo').fadeOut(300);

        }
        
        function showAddCustomerModal() {
            Swal.fire({
                title: 'Tambah Customer Baru',
                html: `
                    <div class="text-start">
                        <div class="mb-3">
                            <label class="form-label">Nama Customer</label>
                            <input type="text" class="form-control" id="newCustomerNameModal" placeholder="Masukkan nama customer">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">No. HP</label>
                            <input type="text" class="form-control" id="newCustomerPhoneModal" placeholder="Masukkan nomor HP">
                        </div>
                    </div>
                `,
                showCancelButton: true,
                confirmButtonText: 'Tambah Customer',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#10b981',
                preConfirm: () => {
                    const nama = $('#newCustomerNameModal').val();
                    const telepon = $('#newCustomerPhoneModal').val();
                    
                    if (!nama || !telepon) {
                        Swal.showValidationMessage('Nama dan nomor HP harus diisi!');
                        return false;
                    }
                    
                    return { nama, telepon };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    addNewCustomer(result.value.nama, result.value.telepon);
                }
            });
        }
        
        function saveNewCustomer() {
            const nama = $('#newCustomerName').val().trim();
            const telepon = $('#newCustomerPhone').val().trim();
            
            if (!nama || !telepon) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Data Belum Lengkap',
                    text: 'Nama dan nomor HP harus diisi!'
                });
                return;
            }
            
            // Show loading
            $('#saveNewCustomerBtn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...');
            
            $.post('<?= base_url("kasir/add_customer") ?>', {
                nama: nama,
                telepon: telepon
            }, function(response) {
                if (response.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.message,
                        timer: 2000,
                        showConfirmButton: false
                    });
                    
                    // Add to customers array and refresh dropdown
                    customers.push(response.data);
                    displayCustomers();
                    
                    // Clear form
                    $('#newCustomerName').val('');
                    $('#newCustomerPhone').val('');
                    
                    // Switch to customer tab and select the new customer
                    $('.customer-tab').removeClass('active');
                    $('.customer-tab[data-type="customer"]').addClass('active');
                    selectedCustomerType = 'customer';
                    $('.customer-form').hide();
                    $('#customerExisting').fadeIn(300);
                    
                    // Select the new customer in dropdown
                    $('#customerSelect').val(response.data.id_customer);
                    selectCustomer(response.data);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: response.message
                    });
                }
                
                // Reset button
                $('#saveNewCustomerBtn').prop('disabled', false).html('<i class="fas fa-save me-2"></i>Simpan Customer');
            }).fail(function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Terjadi kesalahan saat menyimpan data'
                });
                $('#saveNewCustomerBtn').prop('disabled', false).html('<i class="fas fa-save me-2"></i>Simpan Customer');
            });
        }
        
        function addNewCustomer(nama, telepon) {
            $.post('<?= base_url("kasir/add_customer") ?>', {
                nama: nama,
                telepon: telepon
            }, function(response) {
                if (response.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.message,
                        timer: 2000,
                        showConfirmButton: false
                    });
                    
                    // Add to customers array and select
                    customers.push(response.data);
                    selectCustomer(response.data);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: response.message
                    });
                }
            });
        }

        function loadPriceInfo() {
            console.log('Loading price info...');
            
            // Load laundry prices
            $.ajax({
                url: '<?= base_url("kasir/get_laundry_prices") ?>',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log('Laundry prices response:', response);
                    if (response.status === 'success') {
                        displayLaundryPrices(response.data);
                    } else {
                        $('#laundryPriceList').html('Tidak ada data harga');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Failed to load laundry prices:', error);
                    $('#laundryPriceList').html('Error loading data');
                }
            });
            
            // Load ongkir prices
            $.ajax({
                url: '<?= base_url("kasir/get_ongkir_prices") ?>',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log('Ongkir prices response:', response);
                    if (response.status === 'success') {
                        displayOngkirPrices(response.data);
                    } else {
                        $('#ongkirPriceList').html('Tidak ada data ongkir');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Failed to load ongkir prices:', error);
                    $('#ongkirPriceList').html('Error loading data');
                }
            });
        }
        
        function displayLaundryPrices(prices) {
            console.log('displayLaundryPrices called with:', prices);
            let html = '';
            if (prices && prices.length > 0) {
                html = '<ul class="mb-0">';
                prices.forEach(price => {
                    html += `<li>${price.nama_tier}: <strong>Rp ${formatNumber(price.harga_per_kg)}/kg</strong> (Min ${price.min_kg}kg)</li>`;
                });
                html += '</ul>';
            } else {
                html = 'Tidak ada data harga';
            }
            console.log('Setting laundry HTML:', html);
            $('#laundryPriceList').html(html);
        }
        
        function displayOngkirPrices(ongkirs) {
            console.log('displayOngkirPrices called with:', ongkirs);
            let html = '';
            if (ongkirs && ongkirs.length > 0) {
                html = '<ul class="mb-0">';
                ongkirs.forEach(ongkir => {
                    html += `<li>${ongkir.nama_tier}: <strong>Rp ${formatNumber(ongkir.harga_per_km)}/km</strong> (Min ${ongkir.min_km}km)</li>`;
                });
                html += '</ul>';
            } else {
                html = 'Tidak ada data ongkir';
            }
            console.log('Setting ongkir HTML:', html);
            $('#ongkirPriceList').html(html);
        }

        function formatNumber(num) {
            return new Intl.NumberFormat('id-ID').format(num);
        }
    </script>
</body>
</html>