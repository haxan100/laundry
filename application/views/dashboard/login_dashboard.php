<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'Laundry Management System' ?></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            padding: 40px;
            text-align: center;
            max-width: 500px;
            width: 90%;
        }

        .logo {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 50%;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
        }

        h1 {
            color: #333;
            margin-bottom: 10px;
            font-size: 2rem;
            font-weight: 600;
        }

        .subtitle {
            color: #666;
            margin-bottom: 40px;
            font-size: 1.1rem;
        }

        .role-selection {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
        }

        .role-card {
            flex: 1;
            background: white;
            border: 2px solid #e0e0e0;
            border-radius: 15px;
            padding: 30px 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            color: inherit;
        }

        .role-card:hover {
            border-color: #667eea;
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.2);
        }

        .role-icon {
            font-size: 3rem;
            margin-bottom: 15px;
            color: #667eea;
        }

        .role-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .role-desc {
            color: #666;
            font-size: 0.9rem;
        }

        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
            color: #999;
            font-size: 0.9rem;
        }

        @media (max-width: 600px) {
            .role-selection {
                flex-direction: column;
            }
            
            .container {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <i class="fas fa-tshirt"></i>
        </div>
        
        <h1><?= isset($title) ? $title : 'Laundry System' ?></h1>
        <p class="subtitle">Silakan login untuk masuk ke sistem</p>
        
        <div class="role-selection">
            <a href="<?= base_url('dashboard/login_owner') ?>" class="role-card">
                <div class="role-icon">
                    <i class="fas fa-crown"></i>
                </div>
                <div class="role-title">Owner</div>
                <div class="role-desc">Akses penuh sistem</div>
            </a>
            
            <a href="<?= base_url('dashboard/login_admin') ?>" class="role-card">
                <div class="role-icon">
                    <i class="fas fa-user-tie"></i>
                </div>
                <div class="role-title">Admin</div>
                <div class="role-desc">Kelola operasional</div>
            </a>
        </div>
        
        <div class="footer">
            © 2024 Laundry Management System
        </div>
    </div>
</body>
</html>