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

                        <li class="mm-active">
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
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addOwnerModal">
                                        <i class="mdi mdi-plus me-2"></i> Tambah Owner
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Data Owner</h4>
                                    <div class="table-responsive">
                                        <table id="ownerTable" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Username</th>
                                                    <th>Nama Lengkap</th>
                                                    <th>Email</th>
                                                    <th>Telepon</th>
                                                    <th>Status</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; foreach($owners as $owner): ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= $owner->username ?></td>
                                                    <td><?= $owner->nama_lengkap ?></td>
                                                    <td><?= $owner->email ?></td>
                                                    <td><?= $owner->telepon ?></td>
                                                    <td>
                                                        <span class="badge bg-<?= $owner->status == 'aktif' ? 'success' : 'danger' ?>">
                                                            <?= ucfirst($owner->status) ?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-sm btn-info" onclick="viewOwner(<?= $owner->id_owner ?>)">
                                                            <i class="mdi mdi-eye"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-warning" onclick="editOwner(<?= $owner->id_owner ?>)">
                                                            <i class="mdi mdi-pencil"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-danger" onclick="deleteOwner(<?= $owner->id_owner ?>)">
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

    <!-- Modal Add Owner -->
    <div class="modal fade" id="addOwnerModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Owner Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="addOwnerForm">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Username <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="username" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" name="password" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama_lengkap" required>
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
                                    <label class="form-label">Telepon</label>
                                    <input type="text" class="form-control" name="telepon">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea class="form-control" name="alamat" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status">
                                <option value="aktif">Aktif</option>
                                <option value="nonaktif">Non Aktif</option>
                            </select>
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

    <!-- Modal Edit Owner -->
    <div class="modal fade" id="editOwnerModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Owner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="editOwnerForm">
                    <input type="hidden" name="id" id="edit_id">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Username <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="username" id="edit_username" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Password Baru</label>
                                    <input type="password" class="form-control" name="password" placeholder="Kosongkan jika tidak ingin mengubah">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama_lengkap" id="edit_nama_lengkap" required>
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
                                    <label class="form-label">Telepon</label>
                                    <input type="text" class="form-control" name="telepon" id="edit_telepon">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea class="form-control" name="alamat" id="edit_alamat" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status" id="edit_status">
                                <option value="aktif">Aktif</option>
                                <option value="nonaktif">Non Aktif</option>
                            </select>
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

    <!-- Modal View Owner -->
    <div class="modal fade" id="viewOwnerModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Owner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Username</strong></td>
                                    <td>:</td>
                                    <td id="view_username"></td>
                                </tr>
                                <tr>
                                    <td><strong>Nama Lengkap</strong></td>
                                    <td>:</td>
                                    <td id="view_nama_lengkap"></td>
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
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Status</strong></td>
                                    <td>:</td>
                                    <td><span id="view_status" class="badge"></span></td>
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
                    <div class="row">
                        <div class="col-12">
                            <strong>Alamat:</strong>
                            <p id="view_alamat" class="mt-2"></p>
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
        let ownerTable;
        
        $(document).ready(function() {
            ownerTable = $('#ownerTable').DataTable();
        });

        function reloadOwnerTable() {
            $.get('<?= base_url("owner/get_owners_ajax") ?>', function(data) {
                ownerTable.clear();
                data.forEach(function(owner, index) {
                    const statusBadge = `<span class="badge bg-${owner.status === 'aktif' ? 'success' : 'danger'}">${owner.status.charAt(0).toUpperCase() + owner.status.slice(1)}</span>`;
                    ownerTable.row.add([
                        index + 1,
                        owner.username,
                        owner.nama_lengkap,
                        owner.email || '-',
                        owner.telepon || '-',
                        statusBadge,
                        `<button class="btn btn-sm btn-info" onclick="viewOwner(${owner.id_owner})"><i class="mdi mdi-eye"></i></button>
                         <button class="btn btn-sm btn-warning" onclick="editOwner(${owner.id_owner})"><i class="mdi mdi-pencil"></i></button>
                         <button class="btn btn-sm btn-danger" onclick="deleteOwner(${owner.id_owner})"><i class="mdi mdi-delete"></i></button>`
                    ]);
                });
                ownerTable.draw();
            }, 'json');
        }

        // Add Owner
        $('#addOwnerForm').on('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const data = Object.fromEntries(formData);
            
            $.post('<?= base_url("owner/add_owner") ?>', data, function(response) {
                if(response.status === 'success') {
                    $('#addOwnerModal').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Owner berhasil ditambahkan',
                        timer: 1500,
                        showConfirmButton: false
                    });
                    reloadOwnerTable();
                } else {
                    Swal.fire('Error!', response.message, 'error');
                }
            }, 'json');
        });

        // Edit Owner
        $('#editOwnerForm').on('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const data = Object.fromEntries(formData);
            
            $.post('<?= base_url("owner/update_owner") ?>', data, function(response) {
                if(response.status === 'success') {
                    $('#editOwnerModal').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Owner berhasil diupdate',
                        timer: 1500,
                        showConfirmButton: false
                    });
                    reloadOwnerTable();
                } else {
                    Swal.fire('Error!', response.message, 'error');
                }
            }, 'json');
        });

        // Reset forms
        $('#addOwnerModal').on('hidden.bs.modal', function() {
            $('#addOwnerForm')[0].reset();
        });

        $('#editOwnerModal').on('hidden.bs.modal', function() {
            $('#editOwnerForm')[0].reset();
        });

        function viewOwner(id) {
            $.post('<?= base_url("owner/get_owner") ?>', {id: id}, function(response) {
                if(response.status === 'success') {
                    const data = response.data;
                    
                    $('#view_username').text(data.username);
                    $('#view_nama_lengkap').text(data.nama_lengkap);
                    $('#view_email').text(data.email || '-');
                    $('#view_telepon').text(data.telepon || '-');
                    $('#view_alamat').text(data.alamat || '-');
                    $('#view_created_at').text(data.created_at);
                    $('#view_updated_at').text(data.updated_at || '-');
                    
                    const statusBadge = $('#view_status');
                    statusBadge.text(data.status.charAt(0).toUpperCase() + data.status.slice(1));
                    statusBadge.removeClass('bg-success bg-danger');
                    statusBadge.addClass(data.status === 'aktif' ? 'bg-success' : 'bg-danger');
                    
                    $('#viewOwnerModal').modal('show');
                } else {
                    Swal.fire('Error!', response.message, 'error');
                }
            }, 'json');
        }

        function editOwner(id) {
            $.post('<?= base_url("owner/get_owner") ?>', {id: id}, function(response) {
                if(response.status === 'success') {
                    const data = response.data;
                    
                    $('#edit_id').val(data.id_owner);
                    $('#edit_username').val(data.username);
                    $('#edit_nama_lengkap').val(data.nama_lengkap);
                    $('#edit_email').val(data.email);
                    $('#edit_telepon').val(data.telepon);
                    $('#edit_alamat').val(data.alamat);
                    $('#edit_status').val(data.status);
                    
                    $('#editOwnerModal').modal('show');
                } else {
                    Swal.fire('Error!', response.message, 'error');
                }
            }, 'json');
        }

        function deleteOwner(id) {
            Swal.fire({
                title: 'Hapus Owner?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post('<?= base_url("owner/delete_owner") ?>', {id: id}, function(response) {
                        if(response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: response.message,
                                timer: 1500,
                                showConfirmButton: false
                            });
                            reloadOwnerTable();
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