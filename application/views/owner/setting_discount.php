<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title><?= $pageTitle ?> - <?= $this->config->item('title') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?= base_url('assets/assets/images/favicon.ico') ?>">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/assets/css/icons.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/assets/css/app.min.css') ?>" id="app-style" rel="stylesheet" type="text/css">
    
    <style>
        /* Fix Modal Background */
        .modal-backdrop {
            background-color: rgba(0, 0, 0, 0.5) !important;
            z-index: 1040 !important;
        }
        
        .modal {
            z-index: 1050 !important;
        }
        
        .modal-content {
            background-color: #fff !important;
            border: 1px solid rgba(0, 0, 0, 0.2) !important;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        }
        
        /* Fix SweetAlert2 Background */
        .swal2-container {
            z-index: 9999 !important;
        }
        
        .swal2-popup {
            background: #fff !important;
            box-shadow: 0 0 1.25rem rgba(31, 45, 61, 0.08) !important;
        }
        
        .swal2-backdrop-show {
            background-color: rgba(0, 0, 0, 0.4) !important;
        }
    </style>
</head>

<body data-sidebar="dark">
    <div id="layout-wrapper">
        
        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <div class="navbar-brand-box">
                        <a href="<?= base_url('owner') ?>" class="logo logo-light">
                            <span class="logo-sm">
                                <i class="mdi mdi-crown" style="font-size: 22px; color: #fff;"></i>
                            </span>
                            <span class="logo-lg">
                                <i class="mdi mdi-crown me-2"></i><?= $this->config->item('title') ?>
                            </span>
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                        <i class="mdi mdi-menu"></i>
                    </button>
                </div>

                <div class="d-flex">
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle header-profile-user" src="<?= base_url('assets/assets/images/users/user-4.jpg') ?>"
                                alt="Header Avatar">
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle font-size-17 align-middle me-1"></i> <?= $this->session->userdata('nama_lengkap') ?></a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="<?= base_url('owner/logout') ?>"><i class="bx bx-power-off font-size-17 align-middle me-1 text-danger"></i> Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="vertical-menu">
            <div data-simplebar class="h-100">
                <div id="sidebar-menu">
                    <ul class="metismenu list-unstyled" id="side-menu">
                        <li class="menu-title">Main</li>

                        <li>
                            <a href="<?= base_url('owner') ?>" class="waves-effect">
                                <i class="ti-home"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="menu-title">Management</li>

                        <li>
                            <a href="<?= base_url('owner/master_role') ?>" class="waves-effect">
                                <i class="ti-settings"></i>
                                <span>Master Role</span>
                            </a>
                        </li>

                        <li>
                            <a href="<?= base_url('owner/master_owner') ?>" class="waves-effect">
                                <i class="mdi mdi-crown"></i>
                                <span>Master Owner</span>
                            </a>
                        </li>

                        <li>
                            <a href="<?= base_url('owner/master_admin') ?>" class="waves-effect">
                                <i class="ti-user"></i>
                                <span>Master Admin</span>
                            </a>
                        </li>

                        <li>
                            <a href="<?= base_url('owner/master_customer') ?>" class="waves-effect">
                                <i class="ti-id-badge"></i>
                                <span>Master Customer</span>
                            </a>
                        </li>

                        <li class="menu-title">Settings</li>

                        <li class="mm-active">
                            <a href="<?= base_url('owner/setting_discount') ?>" class="waves-effect">
                                <i class="mdi mdi-percent"></i>
                                <span>Setting Diskon Tier</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    
                    <div class="page-title-box">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h6 class="page-title"><?= $pageTitle ?></h6>
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="<?= base_url('owner') ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active"><?= $pageTitle ?></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Setting Diskon Berdasarkan Tier Level</h4>
                                    <p class="card-title-desc">Atur besaran diskon untuk setiap tier level customer</p>
                                    
                                    <form id="discountForm">
                                        <div class="row">
                                            <?php 
                                            $tier_colors = [
                                                'bronze' => 'warning',
                                                'silver' => 'secondary', 
                                                'gold' => 'success',
                                                'platinum' => 'primary'
                                            ];
                                            $tier_icons = [
                                                'bronze' => 'mdi-medal',
                                                'silver' => 'mdi-medal',
                                                'gold' => 'mdi-medal',
                                                'platinum' => 'mdi-crown'
                                            ];
                                            foreach($discounts as $discount): 
                                            ?>
                                            <div class="col-md-6 col-lg-3">
                                                <div class="card border-<?= $tier_colors[$discount->tier_level] ?>">
                                                    <div class="card-header bg-<?= $tier_colors[$discount->tier_level] ?> text-white">
                                                        <h5 class="card-title mb-0">
                                                            <i class="mdi <?= $tier_icons[$discount->tier_level] ?> me-2"></i>
                                                            <?= ucfirst($discount->tier_level) ?>
                                                        </h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="mb-3">
                                                            <label class="form-label">Diskon (Rp)</label>
                                                            <input type="number" class="form-control" 
                                                                   name="discount[<?= $discount->tier_level ?>]" 
                                                                   value="<?= $discount->discount_amount ?>" 
                                                                   min="0" step="1000">
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" 
                                                                   name="active[<?= $discount->tier_level ?>]" 
                                                                   <?= $discount->is_active ? 'checked' : '' ?>>
                                                            <label class="form-check-label">Aktif</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endforeach; ?>
                                        </div>
                                        
                                        <div class="row mt-3">
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="mdi mdi-content-save me-2"></i>Simpan Pengaturan
                                                </button>
                                                <button type="button" class="btn btn-secondary" onclick="resetForm()">
                                                    <i class="mdi mdi-refresh me-2"></i>Reset
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Info Card -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Informasi Tier Level</h5>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Tier Level</th>
                                                    <th>Diskon Saat Ini</th>
                                                    <th>Status</th>
                                                    <th>Jumlah Customer</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($discounts as $discount): ?>
                                                <tr>
                                                    <td>
                                                        <span class="badge bg-<?= $tier_colors[$discount->tier_level] ?>">
                                                            <i class="mdi <?= $tier_icons[$discount->tier_level] ?> me-1"></i>
                                                            <?= ucfirst($discount->tier_level) ?>
                                                        </span>
                                                    </td>
                                                    <td>Rp <?= number_format($discount->discount_amount, 0, ',', '.') ?></td>
                                                    <td>
                                                        <span class="badge bg-<?= $discount->is_active ? 'success' : 'danger' ?>">
                                                            <?= $discount->is_active ? 'Aktif' : 'Non Aktif' ?>
                                                        </span>
                                                    </td>
                                                    <td><?= $discount->customer_count ?> customer</td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            © <script>document.write(new Date().getFullYear())</script> <?= $this->config->item('title') ?><span class="d-none d-sm-inline-block"> - Laundry Management System</span>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/assets/libs/metismenu/metisMenu.min.js') ?>"></script>
    <script src="<?= base_url('assets/assets/libs/simplebar/simplebar.min.js') ?>"></script>
    <script src="<?= base_url('assets/assets/libs/node-waves/waves.min.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?= base_url('assets/assets/js/app.js') ?>"></script>

    <script>
        $(document).ready(function() {
            // Format number input
            $('input[type="number"]').on('input', function() {
                let value = $(this).val();
                if (value < 0) $(this).val(0);
            });
        });

        $('#discountForm').on('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const data = {};
            
            // Process discount amounts
            $('input[name^="discount["]').each(function() {
                const tier = $(this).attr('name').match(/\[(.*?)\]/)[1];
                data[tier] = {
                    discount_amount: $(this).val(),
                    is_active: $(`input[name="active[${tier}]"]`).is(':checked') ? 1 : 0
                };
            });
            
            $.post('<?= base_url("owner/update_tier_discounts") ?>', {discounts: data}, function(response) {
                if(response.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Pengaturan diskon berhasil disimpan',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire('Error!', response.message, 'error');
                }
            }, 'json');
        });

        function resetForm() {
            Swal.fire({
                title: 'Reset Pengaturan?',
                text: "Pengaturan akan dikembalikan ke nilai default",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Reset!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Reset to default values
                    $('input[name="discount[bronze]"]').val(5000);
                    $('input[name="discount[silver]"]').val(7000);
                    $('input[name="discount[gold]"]').val(10000);
                    $('input[name="discount[platinum]"]').val(15000);
                    
                    // Set all to active
                    $('input[name^="active["]').prop('checked', true);
                    
                    Swal.fire('Reset!', 'Pengaturan telah direset ke nilai default', 'success');
                }
            });
        }
    </script>
</body>
</html>