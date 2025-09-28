<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - <?= isset($title) ? $title : 'Laundry System' ?></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

        .login-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            padding: 40px;
            text-align: center;
            max-width: 400px;
            width: 90%;
        }

        .back-btn {
            position: absolute;
            top: 20px;
            left: 20px;
            background: rgba(255, 255, 255, 0.2);
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .back-btn:hover {
            background: rgba(255, 255, 255, 0.3);
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

        h2 {
            color: #333;
            margin-bottom: 10px;
            font-size: 1.8rem;
            font-weight: 600;
        }

        .subtitle {
            color: #666;
            margin-bottom: 30px;
            font-size: 1rem;
        }

        .input-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .input-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
        }

        .input-container {
            position: relative;
        }

        .input-container input {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
            outline: none;
        }

        .input-container input:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .input-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
        }

        .toggle-password {
            cursor: pointer;
        }

        .login-btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }

        .login-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
            color: #999;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <button class="back-btn" onclick="window.location.href='<?= base_url('dashboard') ?>'">
        <i class="fas fa-arrow-left"></i>
    </button>

    <div class="login-container">
        <div class="logo">
            <i class="fas fa-user-tie"></i>
        </div>
        
        <h2>Login Admin</h2>
        <p class="subtitle">Masuk sebagai administrator</p>
        
        <form id="loginForm">
            <div class="input-group">
                <label for="username">Username</label>
                <div class="input-container">
                    <input type="text" id="username" name="username" required>
                    <i class="fas fa-user input-icon"></i>
                </div>
            </div>
            
            <div class="input-group">
                <label for="password">Password</label>
                <div class="input-container">
                    <input type="password" id="password" name="password" required>
                    <i class="fas fa-eye toggle-password input-icon" id="togglePassword"></i>
                </div>
            </div>
            
            <button type="submit" class="login-btn" id="loginBtn">
                <i class="fas fa-sign-in-alt"></i> Masuk
            </button>
        </form>
        
        <div class="footer">
            Akses administrator sistem
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#togglePassword').click(function() {
                const passwordField = $('#password');
                const type = passwordField.attr('type') === 'password' ? 'text' : 'password';
                passwordField.attr('type', type);
                $(this).removeClass('fa-eye fa-eye-slash').addClass(type === 'password' ? 'fa-eye' : 'fa-eye-slash');
            });

            $('#loginForm').submit(function(e) {
                e.preventDefault();
                
                const username = $('#username').val();
                const password = $('#password').val();
                const loginBtn = $('#loginBtn');
                
                loginBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Memproses...');
                
                $.ajax({
                    url: '<?= base_url("dashboard/process_login") ?>',
                    type: 'POST',
                    data: {
                        username: username,
                        password: password,
                        role: 'admin'
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: response.message,
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                window.location.href = response.redirect;
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: response.message
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Terjadi kesalahan pada server'
                        });
                    },
                    complete: function() {
                        loginBtn.prop('disabled', false).html('<i class="fas fa-sign-in-alt"></i> Masuk');
                    }
                });
            });
        });
    </script>
</body>
</html>