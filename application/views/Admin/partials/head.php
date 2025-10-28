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

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 30px 50px -12px rgba(0, 0, 0, 0.3);
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

        .stats-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 30px 50px -12px rgba(0, 0, 0, 0.3);
        }

        .stats-number {
            font-size: 2.5em;
            margin-bottom: 8px;
            color: #2d3748;
            font-weight: 800;
        }

        .page-title {
            color: #2d3748;
            font-weight: 700;
            font-size: 2rem;
            margin-bottom: 2rem;
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
    </style>
</head>

<body data-sidebar="dark">
    <div id="layout-wrapper">