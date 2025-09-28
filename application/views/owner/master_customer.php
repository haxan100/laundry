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

                        <li class="mm-active">
                            <a href="<?= base_url('owner/master_customer') ?>" class="waves-effect">
                                <i class="ti-id-badge"></i>
                                <span>Master Customer</span>
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
                            <div class="col-md-4">
                                <div class="float-end d-none d-md-block">
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCustomerModal">
                                        <i class="mdi mdi-plus me-2"></i> Tambah Customer
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Data Customer</h4>
                                    <div class="table-responsive">
                                        <table id="customerTable" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>Email</th>
                                                    <th>Telepon</th>
                                                    <th>Tier Level</th>
                                                    <th>Last Login</th>
                                                    <th>Last Wash</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; foreach($customers as $customer): ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= $customer->nama ?></td>
                                                    <td><?= $customer->email ?></td>
                                                    <td><?= $customer->telepon ?></td>
                                                    <td>
                                                        <?php
                                                        $tier_colors = [
                                                            'bronze' => 'warning',
                                                            'silver' => 'secondary', 
                                                            'gold' => 'success',
                                                            'platinum' => 'primary'
                                                        ];
                                                        ?>
                                                        <span class="badge bg-<?= $tier_colors[$customer->tier_level] ?>">
                                                            <?= ucfirst($customer->tier_level) ?>
                                                        </span>
                                                    </td>
                                                    <td><?= $customer->last_login ? date('d/m/Y H:i', strtotime($customer->last_login)) : '-' ?></td>
                                                    <td><?= $customer->last_wash ? date('d/m/Y H:i', strtotime($customer->last_wash)) : '-' ?></td>
                                                    <td>
                                                        <button class="btn btn-sm btn-info" onclick="viewCustomer(<?= $customer->id_customer ?>)">
                                                            <i class="mdi mdi-eye"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-warning" onclick="editCustomer(<?= $customer->id_customer ?>)">
                                                            <i class="mdi mdi-pencil"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-danger" onclick="deleteCustomer(<?= $customer->id_customer ?>)">
                                                            <i class="mdi mdi-delete"></i>
                                                        </button>
                                                    </td>
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

    <!-- Modal Add Customer -->
    <div class="modal fade" id="addCustomerModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Customer Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="addCustomerForm">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Telepon <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="telepon" placeholder="89xxxxxxxx" required>
                                    <small class="text-muted">Format: 89xxxxxxxx (tanpa 0)</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" name="password" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Tier Level</label>
                                    <select class="form-select" name="tier_level">
                                        <option value="bronze">Bronze</option>
                                        <option value="silver">Silver</option>
                                        <option value="gold">Gold</option>
                                        <option value="platinum">Platinum</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Customer -->
    <div class="modal fade" id="editCustomerModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="editCustomerForm">
                    <input type="hidden" name="id" id="edit_id">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama" id="edit_nama" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="edit_email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Telepon <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="telepon" id="edit_telepon" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Password Baru</label>
                                    <input type="password" class="form-control" name="password" placeholder="Kosongkan jika tidak ingin mengubah">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Tier Level</label>
                                    <select class="form-select" name="tier_level" id="edit_tier_level">
                                        <option value="bronze">Bronze</option>
                                        <option value="silver">Silver</option>
                                        <option value="gold">Gold</option>
                                        <option value="platinum">Platinum</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal View Customer -->
    <div class="modal fade" id="viewCustomerModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Nama</strong></td>
                                    <td>:</td>
                                    <td id="view_nama"></td>
                                </tr>
                                <tr>
                                    <td><strong>Email</strong></td>
                                    <td>:</td>
                                    <td id="view_email"></td>
                                </tr>
                                <tr>
                                    <td><strong>Telepon</strong></td>
                                    <td>:</td>
                                    <td id="view_telepon"></td>
                                </tr>
                                <tr>
                                    <td><strong>Tier Level</strong></td>
                                    <td>:</td>
                                    <td><span id="view_tier_level" class="badge"></span></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Last Login</strong></td>
                                    <td>:</td>
                                    <td id="view_last_login"></td>
                                </tr>
                                <tr>
                                    <td><strong>Last Wash</strong></td>
                                    <td>:</td>
                                    <td id="view_last_wash"></td>
                                </tr>
                                <tr>
                                    <td><strong>Dibuat</strong></td>
                                    <td>:</td>
                                    <td id="view_created_at"></td>
                                </tr>
                                <tr>
                                    <td><strong>Diupdate</strong></td>
                                    <td>:</td>
                                    <td id="view_updated_at"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/assets/libs/metismenu/metisMenu.min.js') ?>"></script>
    <script src="<?= base_url('assets/assets/libs/simplebar/simplebar.min.js') ?>"></script>
    <script src="<?= base_url('assets/assets/libs/node-waves/waves.min.js') ?>"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?= base_url('assets/assets/js/app.js') ?>"></script>

    <script>
        let customerTable;
        
        $(document).ready(function() {
            customerTable = $('#customerTable').DataTable();
            
            // Format telepon input
            $('input[name="telepon"]').on('input', function() {
                let value = $(this).val().replace(/\D/g, '');
                if (value.startsWith('0')) {
                    value = value.substring(1);
                }
                if (!value.startsWith('89') && value.length > 0) {
                    value = '89' + value.replace(/^89/, '');
                }
                $(this).val(value);
            });
        });

        function reloadCustomerTable() {
            $.get('<?= base_url("owner/get_customers_ajax") ?>', function(data) {
                customerTable.clear();
                data.forEach(function(customer, index) {
                    const tierColors = {
                        'bronze': 'warning',
                        'silver': 'secondary', 
                        'gold': 'success',
                        'platinum': 'primary'
                    };
                    const tierBadge = `<span class="badge bg-${tierColors[customer.tier_level]}">${customer.tier_level.charAt(0).toUpperCase() + customer.tier_level.slice(1)}</span>`;
                    const lastLogin = customer.last_login ? new Date(customer.last_login).toLocaleDateString('id-ID') + ' ' + new Date(customer.last_login).toLocaleTimeString('id-ID', {hour: '2-digit', minute: '2-digit'}) : '-';
                    const lastWash = customer.last_wash ? new Date(customer.last_wash).toLocaleDateString('id-ID') + ' ' + new Date(customer.last_wash).toLocaleTimeString('id-ID', {hour: '2-digit', minute: '2-digit'}) : '-';
                    
                    customerTable.row.add([
                        index + 1,
                        customer.nama,
                        customer.email || '-',
                        customer.telepon,
                        tierBadge,
                        lastLogin,
                        lastWash,
                        `<button class="btn btn-sm btn-info" onclick="viewCustomer(${customer.id_customer})"><i class="mdi mdi-eye"></i></button>
                         <button class="btn btn-sm btn-warning" onclick="editCustomer(${customer.id_customer})"><i class="mdi mdi-pencil"></i></button>
                         <button class="btn btn-sm btn-danger" onclick="deleteCustomer(${customer.id_customer})"><i class="mdi mdi-delete"></i></button>`
                    ]);
                });
                customerTable.draw();
            }, 'json');
        }

        // Add Customer
        $('#addCustomerForm').on('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const data = Object.fromEntries(formData);
            
            $.post('<?= base_url("owner/add_customer") ?>', data, function(response) {
                if(response.status === 'success') {
                    $('#addCustomerModal').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Customer berhasil ditambahkan',
                        timer: 1500,
                        showConfirmButton: false
                    });
                    reloadCustomerTable();
                } else {
                    Swal.fire('Error!', response.message, 'error');
                }
            }, 'json');
        });

        // Edit Customer
        $('#editCustomerForm').on('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const data = Object.fromEntries(formData);
            
            $.post('<?= base_url("owner/update_customer") ?>', data, function(response) {
                if(response.status === 'success') {
                    $('#editCustomerModal').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Customer berhasil diupdate',
                        timer: 1500,
                        showConfirmButton: false
                    });
                    reloadCustomerTable();
                } else {
                    Swal.fire('Error!', response.message, 'error');
                }
            }, 'json');
        });

        // Reset forms
        $('#addCustomerModal').on('hidden.bs.modal', function() {
            $('#addCustomerForm')[0].reset();
        });

        $('#editCustomerModal').on('hidden.bs.modal', function() {
            $('#editCustomerForm')[0].reset();
        });

        function viewCustomer(id) {
            $.post('<?= base_url("owner/get_customer") ?>', {id: id}, function(response) {
                if(response.status === 'success') {
                    const data = response.data;
                    const tierColors = {
                        'bronze': 'warning',
                        'silver': 'secondary', 
                        'gold': 'success',
                        'platinum': 'primary'
                    };
                    
                    $('#view_nama').text(data.nama);
                    $('#view_email').text(data.email || '-');
                    $('#view_telepon').text(data.telepon);
                    $('#view_last_login').text(data.last_login ? new Date(data.last_login).toLocaleString('id-ID') : '-');
                    $('#view_last_wash').text(data.last_wash ? new Date(data.last_wash).toLocaleString('id-ID') : '-');
                    $('#view_created_at').text(new Date(data.created_at).toLocaleString('id-ID'));
                    $('#view_updated_at').text(data.updated_at ? new Date(data.updated_at).toLocaleString('id-ID') : '-');
                    
                    const tierBadge = $('#view_tier_level');
                    tierBadge.text(data.tier_level.charAt(0).toUpperCase() + data.tier_level.slice(1));
                    tierBadge.removeClass('bg-warning bg-secondary bg-success bg-primary');
                    tierBadge.addClass('bg-' + tierColors[data.tier_level]);
                    
                    $('#viewCustomerModal').modal('show');
                } else {
                    Swal.fire('Error!', response.message, 'error');
                }
            }, 'json');
        }

        function editCustomer(id) {
            $.post('<?= base_url("owner/get_customer") ?>', {id: id}, function(response) {
                if(response.status === 'success') {
                    const data = response.data;
                    
                    $('#edit_id').val(data.id_customer);
                    $('#edit_nama').val(data.nama);
                    $('#edit_email').val(data.email);
                    $('#edit_telepon').val(data.telepon);
                    $('#edit_tier_level').val(data.tier_level);
                    
                    $('#editCustomerModal').modal('show');
                } else {
                    Swal.fire('Error!', response.message, 'error');
                }
            }, 'json');
        }

        function deleteCustomer(id) {
            Swal.fire({
                title: 'Hapus Customer?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post('<?= base_url("owner/delete_customer") ?>', {id: id}, function(response) {
                        if(response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: response.message,
                                timer: 1500,
                                showConfirmButton: false
                            });
                            reloadCustomerTable();
                        } else {
                            Swal.fire('Error!', response.message, 'error');
                        }
                    }, 'json');
                }
            });
        }
    </script>
</body>
</html>