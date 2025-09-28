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

                        <li class="mm-active">
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

                        <li>
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
                            <div class="col-md-4">
                                <div class="float-end d-none d-md-block">
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRoleModal">
                                        <i class="mdi mdi-plus me-2"></i> Tambah Role
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Data Role</h4>
                                    <div class="table-responsive">
                                        <table id="roleTable" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Role</th>
                                                    <th>Permissions</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; foreach($roles as $role): ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= $role->nama_role ?></td>
                                                    <td>
                                                        <?php 
                                                        $permissions = json_decode($role->permissions, true);
                                                        if($permissions) {
                                                            echo '<span class="badge bg-primary me-1">' . implode('</span> <span class="badge bg-primary me-1">', $permissions) . '</span>';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-sm btn-warning" onclick="editRole(<?= $role->id_role ?>)">
                                                            <i class="mdi mdi-pencil"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-danger" onclick="deleteRole(<?= $role->id_role ?>)">
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

    <!-- Modal Add Role -->
    <div class="modal fade" id="addRoleModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Role Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="addRoleForm">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Role <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama_role" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Permissions</label>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="master_admin" id="perm_admin">
                                        <label class="form-check-label" for="perm_admin">Master Admin</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="master_role_admin" id="perm_role">
                                        <label class="form-check-label" for="perm_role">Master Role Admin</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="master_owner" id="perm_owner">
                                        <label class="form-check-label" for="perm_owner">Master Owner</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="master_customer" id="perm_customer">
                                        <label class="form-check-label" for="perm_customer">Master Customer</label>
                                    </div>
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

    <!-- Modal Edit Role -->
    <div class="modal fade" id="editRoleModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="editRoleForm">
                    <input type="hidden" name="id" id="edit_id">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Role <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama_role" id="edit_nama_role" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Permissions</label>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="master_admin" id="edit_perm_admin">
                                        <label class="form-check-label" for="edit_perm_admin">Master Admin</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="master_role_admin" id="edit_perm_role">
                                        <label class="form-check-label" for="edit_perm_role">Master Role Admin</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="master_owner" id="edit_perm_owner">
                                        <label class="form-check-label" for="edit_perm_owner">Master Owner</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="master_customer" id="edit_perm_customer">
                                        <label class="form-check-label" for="edit_perm_customer">Master Customer</label>
                                    </div>
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
        let roleTable;
        
        $(document).ready(function() {
            roleTable = $('#roleTable').DataTable();
        });

        function reloadTable() {
            $.get('<?= base_url("owner/get_roles_ajax") ?>', function(data) {
                roleTable.clear();
                data.forEach(function(role, index) {
                    const permissions = role.permissions ? JSON.parse(role.permissions).map(p => `<span class="badge bg-primary me-1">${p}</span>`).join('') : '';
                    roleTable.row.add([
                        index + 1,
                        role.nama_role,
                        permissions,
                        `<button class="btn btn-sm btn-warning" onclick="editRole(${role.id_role})"><i class="mdi mdi-pencil"></i></button>
                         <button class="btn btn-sm btn-danger" onclick="deleteRole(${role.id_role})"><i class="mdi mdi-delete"></i></button>`
                    ]);
                });
                roleTable.draw();
            }, 'json');
        }

        // Add Role
        $('#addRoleForm').on('submit', function(e) {
            e.preventDefault();
            
            const permissions = [];
            $('#addRoleModal input[name="permissions[]"]:checked').each(function() {
                permissions.push($(this).val());
            });
            
            $.post('<?= base_url("owner/add_role") ?>', {
                nama_role: $('input[name="nama_role"]').val(),
                permissions: permissions
            }, function(response) {
                if(response.status === 'success') {
                    $('#addRoleModal').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Role berhasil ditambahkan',
                        timer: 1500,
                        showConfirmButton: false
                    });
                    reloadTable();
                } else {
                    Swal.fire('Error!', response.message, 'error');
                }
            }, 'json');
        });

        // Edit Role
        $('#editRoleForm').on('submit', function(e) {
            e.preventDefault();
            
            const permissions = [];
            $('#editRoleModal input[name="permissions[]"]:checked').each(function() {
                permissions.push($(this).val());
            });
            
            $.post('<?= base_url("owner/update_role") ?>', {
                id: $('#edit_id').val(),
                nama_role: $('#edit_nama_role').val(),
                permissions: permissions
            }, function(response) {
                if(response.status === 'success') {
                    $('#editRoleModal').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Role berhasil diupdate',
                        timer: 1500,
                        showConfirmButton: false
                    });
                    reloadTable();
                } else {
                    Swal.fire('Error!', response.message, 'error');
                }
            }, 'json');
        });

        // Reset forms
        $('#addRoleModal').on('hidden.bs.modal', function() {
            $('#addRoleForm')[0].reset();
        });

        $('#editRoleModal').on('hidden.bs.modal', function() {
            $('#editRoleForm')[0].reset();
        });

        function editRole(id) {
            $.post('<?= base_url("owner/get_role") ?>', {id: id}, function(response) {
                if(response.status === 'success') {
                    const data = response.data;
                    const permissions = data.permissions || [];
                    
                    $('#edit_id').val(data.id_role);
                    $('#edit_nama_role').val(data.nama_role);
                    
                    $('#editRoleModal input[type="checkbox"]').prop('checked', false);
                    
                    permissions.forEach(function(perm) {
                        $('#editRoleModal input[value="' + perm + '"]').prop('checked', true);
                    });
                    
                    $('#editRoleModal').modal('show');
                } else {
                    Swal.fire('Error!', response.message, 'error');
                }
            }, 'json');
        }

        function deleteRole(id) {
            Swal.fire({
                title: 'Hapus Role?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post('<?= base_url("owner/delete_role") ?>', {id: id}, function(response) {
                        if(response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: response.message,
                                timer: 1500,
                                showConfirmButton: false
                            });
                            reloadTable();
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