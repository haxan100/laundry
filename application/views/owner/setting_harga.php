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
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
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
                                    <li class="breadcrumb-item"><a href="<?= base_url('owner') ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active"><?= $pageTitle ?></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Harga Laundry -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h4 class="card-title">Setting Harga Laundry</h4>
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addLaundryModal">
                                            <i class="mdi mdi-plus me-2"></i> Tambah Tier
                                        </button>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Tier</th>
                                                    <th>Harga per KG</th>
                                                    <th>Minimum KG</th>
                                                    <th>Status</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Tier 1 - Retail</td>
                                                    <td>Rp 3.500</td>
                                                    <td>5 KG</td>
                                                    <td><span class="badge bg-success">Aktif</span></td>
                                                    <td>
                                                        <button class="btn btn-sm btn-warning">
                                                            <i class="mdi mdi-pencil"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-danger">
                                                            <i class="mdi mdi-delete"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Tier 2 - Grosir Kecil</td>
                                                    <td>Rp 2.500</td>
                                                    <td>10 KG</td>
                                                    <td><span class="badge bg-success">Aktif</span></td>
                                                    <td>
                                                        <button class="btn btn-sm btn-warning">
                                                            <i class="mdi mdi-pencil"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-danger">
                                                            <i class="mdi mdi-delete"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Tier 3 - Grosir Besar</td>
                                                    <td>Rp 2.000</td>
                                                    <td>50 KG</td>
                                                    <td><span class="badge bg-success">Aktif</span></td>
                                                    <td>
                                                        <button class="btn btn-sm btn-warning">
                                                            <i class="mdi mdi-pencil"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-danger">
                                                            <i class="mdi mdi-delete"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Harga Ongkir -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h4 class="card-title">Setting Harga Ongkir</h4>
                                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addOngkirModal">
                                            <i class="mdi mdi-plus me-2"></i> Tambah Tier
                                        </button>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Tier</th>
                                                    <th>Harga per KM</th>
                                                    <th>Minimum KM</th>
                                                    <th>Status</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Tier 1 - Dekat</td>
                                                    <td>Rp 2.000</td>
                                                    <td>10 KM</td>
                                                    <td><span class="badge bg-success">Aktif</span></td>
                                                    <td>
                                                        <button class="btn btn-sm btn-warning">
                                                            <i class="mdi mdi-pencil"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-danger">
                                                            <i class="mdi mdi-delete"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Tier 2 - Sedang</td>
                                                    <td>Rp 1.500</td>
                                                    <td>25 KM</td>
                                                    <td><span class="badge bg-success">Aktif</span></td>
                                                    <td>
                                                        <button class="btn btn-sm btn-warning">
                                                            <i class="mdi mdi-pencil"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-danger">
                                                            <i class="mdi mdi-delete"></i>
                                                        </button>
                                                    </td>
                                                </tr>
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

    <!-- Modal Tambah Harga Laundry -->
    <div class="modal fade" id="addLaundryModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Tier Harga Laundry</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Nama Tier</label>
                            <input type="text" class="form-control" placeholder="Contoh: Tier 4 - VIP">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Harga per KG</label>
                            <input type="number" class="form-control" placeholder="3500">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Minimum KG</label>
                            <input type="number" class="form-control" placeholder="5">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select">
                                <option value="aktif">Aktif</option>
                                <option value="nonaktif">Non Aktif</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Harga Ongkir -->
    <div class="modal fade" id="addOngkirModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Tier Harga Ongkir</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Nama Tier</label>
                            <input type="text" class="form-control" placeholder="Contoh: Tier 3 - Jauh">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Harga per KM</label>
                            <input type="number" class="form-control" placeholder="2000">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Minimum KM</label>
                            <input type="number" class="form-control" placeholder="10">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select">
                                <option value="aktif">Aktif</option>
                                <option value="nonaktif">Non Aktif</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="<?= base_url('assets/assets/libs/jquery/jquery.min.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/assets/libs/metismenu/metisMenu.min.js') ?>"></script>
    <script src="<?= base_url('assets/assets/libs/simplebar/simplebar.min.js') ?>"></script>
    <script src="<?= base_url('assets/assets/libs/node-waves/waves.min.js') ?>"></script>
    <script src="<?= base_url('assets/assets/js/app.js') ?>"></script>
</body>
</html>