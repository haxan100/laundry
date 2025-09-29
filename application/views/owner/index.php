<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title><?= $pageTitle ?> - <?= $this->config->item('title') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Laundry Management System" name="description">
    <link rel="shortcut icon" href="<?= base_url('assets/assets/images/favicon.ico') ?>">
    
    <!-- Bootstrap Css -->
    <link href="<?= base_url('assets/assets/css/bootstrap.min.css') ?>" id="bootstrap-style" rel="stylesheet" type="text/css">
    <!-- Icons Css -->
    <link href="<?= base_url('assets/assets/css/icons.min.css') ?>" rel="stylesheet" type="text/css">
    <!-- App Css-->
    <link href="<?= base_url('assets/assets/css/app.min.css') ?>" id="app-style" rel="stylesheet" type="text/css">
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

        <?php $this->load->view('owner/partials/sidebar'); ?>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    
                    <div class="page-title-box">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h6 class="page-title"><?= $pageTitle ?></h6>
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item active">Selamat datang di <?= $this->config->item('title') ?></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card mini-stat bg-primary text-white">
                                <div class="card-body">
                                    <div class="mb-4">
                                        <div class="float-start mini-stat-img me-4">
                                            <i class="ti-settings font-size-24"></i>
                                        </div>
                                        <h5 class="font-size-16 text-uppercase text-white-50">Total Role</h5>
                                        <h4 class="fw-medium font-size-24">3</h4>
                                    </div>
                                    <div class="pt-2">
                                        <div class="float-end">
                                            <a href="<?= base_url('owner/master_role') ?>" class="text-white-50"><i class="mdi mdi-arrow-right h5 text-white-50"></i></a>
                                        </div>
                                        <p class="text-white-50 mb-0 mt-1">Kelola Role Sistem</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xl-3 col-md-6">
                            <div class="card mini-stat bg-success text-white">
                                <div class="card-body">
                                    <div class="mb-4">
                                        <div class="float-start mini-stat-img me-4">
                                            <i class="mdi mdi-crown font-size-24"></i>
                                        </div>
                                        <h5 class="font-size-16 text-uppercase text-white-50">Total Owner</h5>
                                        <h4 class="fw-medium font-size-24">1</h4>
                                    </div>
                                    <div class="pt-2">
                                        <div class="float-end">
                                            <a href="<?= base_url('owner/master_owner') ?>" class="text-white-50"><i class="mdi mdi-arrow-right h5 text-white-50"></i></a>
                                        </div>
                                        <p class="text-white-50 mb-0 mt-1">Kelola Data Owner</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xl-3 col-md-6">
                            <div class="card mini-stat bg-info text-white">
                                <div class="card-body">
                                    <div class="mb-4">
                                        <div class="float-start mini-stat-img me-4">
                                            <i class="ti-user font-size-24"></i>
                                        </div>
                                        <h5 class="font-size-16 text-uppercase text-white-50">Total Admin</h5>
                                        <h4 class="fw-medium font-size-24">2</h4>
                                    </div>
                                    <div class="pt-2">
                                        <div class="float-end">
                                            <a href="<?= base_url('owner/master_admin') ?>" class="text-white-50"><i class="mdi mdi-arrow-right h5 text-white-50"></i></a>
                                        </div>
                                        <p class="text-white-50 mb-0 mt-1">Kelola Data Admin</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xl-3 col-md-6">
                            <div class="card mini-stat bg-warning text-white">
                                <div class="card-body">
                                    <div class="mb-4">
                                        <div class="float-start mini-stat-img me-4">
                                            <i class="mdi mdi-tshirt-crew font-size-24"></i>
                                        </div>
                                        <h5 class="font-size-16 text-uppercase text-white-50">Total Order</h5>
                                        <h4 class="fw-medium font-size-24">0</h4>
                                    </div>
                                    <div class="pt-2">
                                        <div class="float-end">
                                            <a href="#" class="text-white-50"><i class="mdi mdi-arrow-right h5 text-white-50"></i></a>
                                        </div>
                                        <p class="text-white-50 mb-0 mt-1">Total Pesanan</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4"><i class="mdi mdi-crown me-2"></i>Selamat Datang, Owner!</h4>
                                    <p class="mb-3">Anda berhasil login sebagai Owner sistem <strong><?= $this->config->item('title') ?></strong>.</p>
                                    <p class="mb-4">Gunakan menu di sebelah kiri untuk mengelola sistem:</p>
                                    
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="card bg-primary text-white border-0">
                                                <div class="card-body text-center">
                                                    <i class="ti-settings display-4 mb-3"></i>
                                                    <h5 class="text-white">Master Role</h5>
                                                    <p class="text-white-50 mb-0">Kelola role dan permission sistem RBAC</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card bg-success text-white border-0">
                                                <div class="card-body text-center">
                                                    <i class="mdi mdi-crown display-4 mb-3"></i>
                                                    <h5 class="text-white">Master Owner</h5>
                                                    <p class="text-white-50 mb-0">Kelola data owner sistem</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card bg-info text-white border-0">
                                                <div class="card-body text-center">
                                                    <i class="ti-user display-4 mb-3"></i>
                                                    <h5 class="text-white">Master Admin</h5>
                                                    <p class="text-white-50 mb-0">Kelola data administrator</p>
                                                </div>
                                            </div>
                                        </div>
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

    <!-- JAVASCRIPT -->
    <script src="<?= base_url('assets/assets/libs/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/assets/libs/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/assets/libs/metismenu/metisMenu.min.js') ?>"></script>
    <script src="<?= base_url('assets/assets/libs/simplebar/simplebar.min.js') ?>"></script>
    <script src="<?= base_url('assets/assets/libs/node-waves/waves.min.js') ?>"></script>
    <script src="<?= base_url('assets/assets/js/app.js') ?>"></script>
</body>
</html>