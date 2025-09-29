<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title><?= isset($pageTitle) ? $pageTitle : 'Dashboard' ?> - <?= $this->config->item('title') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?= base_url('assets/assets/images/favicon.ico') ?>">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/assets/css/icons.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/assets/css/app.min.css') ?>" id="app-style" rel="stylesheet" type="text/css">
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #333;
            transition: all 0.2s ease;
            overflow-x: hidden;
        }

        body.dark-mode {
            background: linear-gradient(135deg, #0c0c0c 0%, #1a1a2e 50%, #16213e 100%);
            color: #e0e0e0;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="0.5" fill="%23ffffff" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>') repeat;
            pointer-events: none;
            z-index: -1;
        }

        #layout-wrapper {
            display: flex;
            height: 100vh;
        }

        /* Sidebar */
        .vertical-menu {
            width: 280px;
            background: linear-gradient(180deg, rgba(255,255,255,0.95) 0%, rgba(255,255,255,0.9) 100%);
            backdrop-filter: blur(20px);
            border-right: 1px solid rgba(255,255,255,0.2);
            color: #2d3748;
            transition: all 0.2s ease;
            position: fixed;
            height: 100vh;
            z-index: 1000;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        body.dark-mode .vertical-menu {
            background: linear-gradient(180deg, rgba(45,55,72,0.95) 0%, rgba(26,32,44,0.9) 100%);
            color: #e2e8f0;
            border-right-color: rgba(255,255,255,0.1);
        }

        .vertical-menu::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 280px;
            display: flex;
            flex-direction: column;
            transition: all 0.2s ease;
            min-height: 100vh;
        }

        /* Top Bar */
        .topnav {
            background: rgba(255, 255, 255, 0.9) !important;
            backdrop-filter: blur(20px);
            padding: 20px 30px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        body.dark-mode .topnav {
            background: rgba(45, 55, 72, 0.9) !important;
            border-bottom-color: rgba(255, 255, 255, 0.1);
        }

        /* Page Content */
        .page-content {
            flex: 1;
            padding: 30px;
            overflow-y: auto;
            min-height: calc(100vh - 80px);
        }

        /* Cards */
        .card {
            background: #ffffff;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            border: 1px solid #e5e7eb;
            transition: all 0.2s ease;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.5), transparent);
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 30px 50px -12px rgba(0, 0, 0, 0.3);
        }

        body.dark-mode .card {
            background: #1f2937;
            color: #f9fafb;
            border-color: #374151;
        }

        /* Stats Cards */
        .stats-card {
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            text-align: center;
            border: 1px solid #e5e7eb;
            transition: all 0.2s ease;
        }

        .stats-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .stats-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 30px 50px -12px rgba(0, 0, 0, 0.3);
        }

        body.dark-mode .stats-card {
            background: #1f2937;
            border-color: #374151;
        }

        body.dark-mode .stats-card::before {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        .stats-number {
            font-size: 2.5em;
            margin-bottom: 8px;
            color: #2d3748;
            font-weight: 800;
        }

        body.dark-mode .stats-number {
            color: #e2e8f0;
        }

        .page-title {
            color: #2d3748;
            font-weight: 700;
            font-size: 2rem;
            margin-bottom: 2rem;
        }

        body.dark-mode .page-title {
            color: #e2e8f0;
        }

        /* Buttons */
        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            position: relative;
            overflow: hidden;
        }



        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 10px 25px -5px rgba(102, 126, 234, 0.4);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 35px -5px rgba(102, 126, 234, 0.5);
        }

        .btn-success {
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
            color: white;
            box-shadow: 0 10px 25px -5px rgba(72, 187, 120, 0.4);
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 35px -5px rgba(72, 187, 120, 0.5);
        }

        .btn-danger {
            background: linear-gradient(135deg, #f56565 0%, #e53e3e 100%);
            color: white;
            box-shadow: 0 10px 25px -5px rgba(245, 101, 101, 0.4);
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 35px -5px rgba(245, 101, 101, 0.5);
        }

        .btn-warning {
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
            color: white;
            box-shadow: 0 10px 25px -5px rgba(251, 191, 36, 0.4);
        }

        .btn-warning:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 35px -5px rgba(251, 191, 36, 0.5);
        }

        /* Tables */
        .table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 20px;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .table th,
        .table td {
            padding: 18px 20px;
            text-align: left;
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
            transition: all 0.3s ease;
        }

        .table th {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
            font-weight: 700;
            color: #4a5568;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 12px;
        }

        .table tbody tr {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            background: rgba(102, 126, 234, 0.05);
        }

        body.dark-mode .table th {
            background: linear-gradient(135deg, rgba(79, 172, 254, 0.1) 0%, rgba(0, 242, 254, 0.1) 100%);
            color: #a0aec0;
        }

        body.dark-mode .table tbody tr {
            background: rgba(45, 55, 72, 0.9);
        }

        body.dark-mode .table tbody tr:hover {
            background: rgba(79, 172, 254, 0.05);
        }

        body.dark-mode .table th,
        body.dark-mode .table td {
            border-bottom-color: rgba(255, 255, 255, 0.1);
        }

        /* Badge */
        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* SweetAlert2 Modal - Solid Background */
        .swal2-container {
            z-index: 999999 !important;
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            width: 100vw !important;
            height: 100vh !important;
            background: rgba(0,0,0,0.7) !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
        }

        .swal2-popup {
            background: #ffffff !important;
            border-radius: 12px !important;
            z-index: 999999 !important;
            position: relative !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3) !important;
            border: 1px solid #e5e7eb !important;
        }

        /* Dark mode modal */
        body.dark-mode .swal2-popup {
            background: #1f2937 !important;
            color: #f9fafb !important;
            border-color: #374151 !important;
        }

        body.dark-mode .swal2-title {
            color: #f9fafb !important;
        }

        body.dark-mode .swal2-content {
            color: #d1d5db !important;
        }

        body.dark-mode .swal2-input,
        body.dark-mode .swal2-textarea {
            background: #374151 !important;
            border-color: #4b5563 !important;
            color: #f9fafb !important;
        }

        body.dark-mode .form-control {
            background: #374151 !important;
            border-color: #4b5563 !important;
            color: #f9fafb !important;
        }

        body.dark-mode .form-label {
            color: #d1d5db !important;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .card {
            animation: fadeInUp 0.3s ease-out;
        }

        .stats-card {
            animation: slideInRight 0.3s ease-out;
        }

        .stats-card:nth-child(2) { animation-delay: 0.05s; }
        .stats-card:nth-child(3) { animation-delay: 0.1s; }
        .stats-card:nth-child(4) { animation-delay: 0.15s; }

        /* Responsive */
        @media (max-width: 768px) {
            .vertical-menu {
                transform: translateX(-100%);
                width: 100%;
                max-width: 320px;
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .page-content {
                padding: 20px 15px;
            }
            
            .card {
                padding: 20px;
                border-radius: 16px;
            }
            
            .stats-card {
                padding: 25px;
            }
        }
    </style>
</head>

<body data-sidebar="dark">
    <div id="layout-wrapper">