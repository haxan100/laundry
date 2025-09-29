<?php $this->load->view('owner/partials/header', ['pageTitle' => 'Master Role']); ?>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    
                    <!-- Page Title -->
                    <div class="row">
                        <div class="col-12">
                            <h4 class="page-title">Master Role</h4>
                        </div>
                    </div>

                    <!-- Stats Overview -->
                    <div class="row mb-4">
                        <div class="col-xl-3 col-md-6 mb-3">
                            <div class="stats-card">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="bg-primary text-white rounded-3 p-3">
                                            <i class="mdi mdi-shield-account font-size-20"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="stats-number"><?= count($roles) ?></div>
                                        <div class="text-muted">Total Role</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-3">
                            <div class="stats-card">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="bg-success text-white rounded-3 p-3">
                                            <i class="mdi mdi-account-multiple font-size-20"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="stats-number"><?= count($roles) > 0 ? count($roles) : 0 ?></div>
                                        <div class="text-muted">Active Roles</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-3">
                            <div class="stats-card">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="bg-info text-white rounded-3 p-3">
                                            <i class="mdi mdi-security font-size-20"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="stats-number">4</div>
                                        <div class="text-muted">Permission Types</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-3">
                            <div class="stats-card">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="bg-warning text-white rounded-3 p-3">
                                            <i class="mdi mdi-cog font-size-20"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="stats-number">System</div>
                                        <div class="text-muted">Management</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Role Data -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h5 class="card-title mb-0">Data Role</h5>
                                        <button type="button" class="btn btn-primary" onclick="addRole()">
                                            <i class="mdi mdi-plus me-1"></i>Tambah Role
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="roleTable" class="table table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Role</th>
                                                    <th>Permissions</th>
                                                    <th>Created</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

<?php $this->load->view('owner/partials/footer'); ?>

<script>
    let roleTable;
    
    $(document).ready(function() {
        roleTable = $('#roleTable').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: '<?= base_url('owner/get_roles_ajax') ?>',
                type: 'GET',
                dataSrc: ''
            },
            columns: [
                {
                    data: null,
                    render: function(data, type, row) {
                        return `
                            <div class="d-flex align-items-center">
                                <div class="bg-info text-white rounded-3 p-2 me-3">
                                    <i class="mdi mdi-shield-account"></i>
                                </div>
                                <div>
                                    <strong>${row.nama_role}</strong>
                                    <br><small class="text-muted">Role ID: ${row.id_role}</small>
                                </div>
                            </div>
                        `;
                    }
                },
                {
                    data: 'permissions',
                    render: function(data, type, row) {
                        if (!data) return '-';
                        try {
                            const permissions = JSON.parse(data);
                            return permissions.map(p => `<span class="badge bg-primary me-1">${p}</span>`).join('');
                        } catch(e) {
                            return '-';
                        }
                    }
                },
                {
                    data: 'created_at',
                    render: function(data, type, row) {
                        if (!data) return '-';
                        const date = new Date(data);
                        return `<small class="text-muted">${date.toLocaleDateString('id-ID')}</small>`;
                    }
                },
                {
                    data: null,
                    orderable: false,
                    render: function(data, type, row) {
                        return `
                            <button class="btn btn-info btn-sm me-1" onclick="viewRole(${row.id_role})">
                                <i class="mdi mdi-eye"></i>
                            </button>
                            <button class="btn btn-warning btn-sm me-1" onclick="editRole(${row.id_role})">
                                <i class="mdi mdi-pencil"></i>
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="deleteRole(${row.id_role})">
                                <i class="mdi mdi-delete"></i>
                            </button>
                        `;
                    }
                }
            ],
            language: {
                processing: "Memuat data...",
                lengthMenu: "Tampilkan _MENU_ data",
                zeroRecords: "Data tidak ditemukan",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                infoFiltered: "(disaring dari _MAX_ total data)",
                search: "Cari:",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Selanjutnya",
                    previous: "Sebelumnya"
                }
            }
        });
    });
    
    function reloadTable() {
        roleTable.ajax.reload(null, false);
    }

    function addRole() {
        Swal.fire({
            ...swalConfig,
            title: 'Tambah Role Baru',
            html: `
                <div class="mb-3">
                    <label class="form-label">Nama Role</label>
                    <input type="text" class="form-control" id="role_nama" placeholder="Nama role">
                </div>
                <div class="mb-3">
                    <label class="form-label">Permissions</label>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="perm_admin" value="master_admin">
                                <label class="form-check-label" for="perm_admin">Master Admin</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="perm_role" value="master_role">
                                <label class="form-check-label" for="perm_role">Master Role</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="perm_owner" value="master_owner">
                                <label class="form-check-label" for="perm_owner">Master Owner</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="perm_customer" value="master_customer">
                                <label class="form-check-label" for="perm_customer">Master Customer</label>
                            </div>
                        </div>
                    </div>
                </div>
            `,
            showCancelButton: true,
            confirmButtonText: 'Simpan',
            cancelButtonText: 'Batal',
            preConfirm: () => {
                const nama = document.getElementById('role_nama').value;
                const permissions = [];
                document.querySelectorAll('#swal2-html-container input[type="checkbox"]:checked').forEach(cb => {
                    permissions.push(cb.value);
                });
                
                if (!nama) {
                    Swal.showValidationMessage('Nama role harus diisi!');
                    return false;
                }
                
                return { nama, permissions };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $.post('<?= base_url('owner/add_role') ?>', {
                    nama_role: result.value.nama,
                    permissions: result.value.permissions
                }, function(response) {
                    const res = JSON.parse(response);
                    if (res.status === 'success') {
                        showSuccess(res.message);
                        reloadTable();
                    } else {
                        showError(res.message);
                    }
                });
            }
        });
    }

    function viewRole(id) {
        $.post('<?= base_url('owner/get_role') ?>', { id: id }, function(response) {
            const res = JSON.parse(response);
            if (res.status === 'success') {
                const role = res.data;
                const permissions = role.permissions ? role.permissions.map(p => `<span class="badge bg-primary me-1">${p}</span>`).join('') : '-';
                
                Swal.fire({
                    ...swalConfig,
                    title: 'Detail Role',
                    html: `
                        <div class="text-start">
                            <table class="table table-borderless">
                                <tr><td><strong>Nama Role:</strong></td><td>${role.nama_role}</td></tr>
                                <tr><td><strong>Permissions:</strong></td><td>${permissions}</td></tr>
                                <tr><td><strong>Dibuat:</strong></td><td>${role.created_at ? new Date(role.created_at).toLocaleString('id-ID') : '-'}</td></tr>
                                <tr><td><strong>Diupdate:</strong></td><td>${role.updated_at ? new Date(role.updated_at).toLocaleString('id-ID') : '-'}</td></tr>
                            </table>
                        </div>
                    `,
                    showConfirmButton: false,
                    showCancelButton: true,
                    cancelButtonText: 'Tutup'
                });
            } else {
                showError(res.message);
            }
        });
    }

    function editRole(id) {
        $.post('<?= base_url('owner/get_role') ?>', { id: id }, function(response) {
            const res = JSON.parse(response);
            if (res.status === 'success') {
                const role = res.data;
                const permissions = role.permissions || [];
                
                Swal.fire({
                    ...swalConfig,
                    title: 'Edit Role',
                    html: `
                        <div class="mb-3">
                            <label class="form-label">Nama Role</label>
                            <input type="text" class="form-control" id="edit_nama" value="${role.nama_role}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Permissions</label>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="edit_perm_admin" value="master_admin" ${permissions.includes('master_admin') ? 'checked' : ''}>
                                        <label class="form-check-label" for="edit_perm_admin">Master Admin</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="edit_perm_role" value="master_role" ${permissions.includes('master_role') ? 'checked' : ''}>
                                        <label class="form-check-label" for="edit_perm_role">Master Role</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="edit_perm_owner" value="master_owner" ${permissions.includes('master_owner') ? 'checked' : ''}>
                                        <label class="form-check-label" for="edit_perm_owner">Master Owner</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="edit_perm_customer" value="master_customer" ${permissions.includes('master_customer') ? 'checked' : ''}>
                                        <label class="form-check-label" for="edit_perm_customer">Master Customer</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `,
                    showCancelButton: true,
                    confirmButtonText: 'Update',
                    cancelButtonText: 'Batal',
                    preConfirm: () => {
                        const nama = document.getElementById('edit_nama').value;
                        const permissions = [];
                        document.querySelectorAll('#swal2-html-container input[type="checkbox"]:checked').forEach(cb => {
                            permissions.push(cb.value);
                        });
                        
                        if (!nama) {
                            Swal.showValidationMessage('Nama role harus diisi!');
                            return false;
                        }
                        
                        return { nama, permissions };
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.post('<?= base_url('owner/update_role') ?>', {
                            id: id,
                            nama_role: result.value.nama,
                            permissions: result.value.permissions
                        }, function(response) {
                            const res = JSON.parse(response);
                            if (res.status === 'success') {
                                showSuccess(res.message);
                                reloadTable();
                            } else {
                                showError(res.message);
                            }
                        });
                    }
                });
            } else {
                showError(res.message);
            }
        });
    }

    function deleteRole(id) {
        confirmDelete(() => {
            $.post('<?= base_url('owner/delete_role') ?>', { id: id }, function(response) {
                const res = JSON.parse(response);
                if (res.status === 'success') {
                    showSuccess(res.message);
                    reloadTable();
                } else {
                    showError(res.message);
                }
            });
        });
    }
</script>