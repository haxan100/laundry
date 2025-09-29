<?php $this->load->view('owner/partials/header', ['pageTitle' => 'Master Admin']); ?>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    
                    <!-- Page Title -->
                    <div class="row">
                        <div class="col-12">
                            <h4 class="page-title">Master Admin</h4>
                        </div>
                    </div>

                    <!-- Stats Overview -->
                    <div class="row mb-4">
                        <?php 
                        $status_counts = ['aktif' => 0, 'nonaktif' => 0];
                        foreach($admins as $admin) {
                            $status_counts[$admin->status]++;
                        }
                        ?>
                        <div class="col-xl-3 col-md-6 mb-3">
                            <div class="stats-card">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="bg-success text-white rounded-3 p-3">
                                            <i class="mdi mdi-account-check font-size-20"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="stats-number"><?= $status_counts['aktif'] ?></div>
                                        <div class="text-muted">Admin Aktif</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-3">
                            <div class="stats-card">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="bg-danger text-white rounded-3 p-3">
                                            <i class="mdi mdi-account-off font-size-20"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="stats-number"><?= $status_counts['nonaktif'] ?></div>
                                        <div class="text-muted">Admin Nonaktif</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-3">
                            <div class="stats-card">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="bg-primary text-white rounded-3 p-3">
                                            <i class="mdi mdi-account-group font-size-20"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="stats-number"><?= count($admins) ?></div>
                                        <div class="text-muted">Total Admin</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-3">
                            <div class="stats-card">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="bg-info text-white rounded-3 p-3">
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
                    </div>

                    <!-- Admin Data -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h5 class="card-title mb-0">Data Admin</h5>
                                        <button type="button" class="btn btn-primary" onclick="addAdmin()">
                                            <i class="mdi mdi-plus me-1"></i>Tambah Admin
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="adminTable" class="table table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Admin</th>
                                                    <th>Role</th>
                                                    <th>Status</th>
                                                    <th>Last Update</th>
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
    let adminTable;
    
    $(document).ready(function() {
        adminTable = $('#adminTable').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: '<?= base_url('owner/get_admins_ajax') ?>',
                type: 'GET',
                dataSrc: ''
            },
            columns: [
                {
                    data: null,
                    render: function(data, type, row) {
                        return `
                            <div class="d-flex align-items-center">
                                <div class="bg-primary text-white rounded-3 p-2 me-3">
                                    <i class="mdi mdi-account"></i>
                                </div>
                                <div>
                                    <strong>${row.nama_lengkap}</strong>
                                    <br><small class="text-muted">${row.username}</small>
                                </div>
                            </div>
                        `;
                    }
                },
                {
                    data: 'nama_role',
                    render: function(data, type, row) {
                        return `<span class="badge bg-info">${data}</span>`;
                    }
                },
                {
                    data: 'status',
                    render: function(data, type, row) {
                        const badgeClass = data === 'aktif' ? 'bg-success' : 'bg-danger';
                        return `<span class="badge ${badgeClass}">${data.charAt(0).toUpperCase() + data.slice(1)}</span>`;
                    }
                },
                {
                    data: 'updated_at',
                    render: function(data, type, row) {
                        if (!data) return '-';
                        const date = new Date(data);
                        return `<small class="text-muted">${date.toLocaleDateString('id-ID')} ${date.toLocaleTimeString('id-ID', {hour: '2-digit', minute: '2-digit'})}</small>`;
                    }
                },
                {
                    data: null,
                    orderable: false,
                    render: function(data, type, row) {
                        return `
                            <button class="btn btn-info btn-sm me-1" onclick="viewAdmin(${row.id_admin})">
                                <i class="mdi mdi-eye"></i>
                            </button>
                            <button class="btn btn-warning btn-sm me-1" onclick="editAdmin(${row.id_admin})">
                                <i class="mdi mdi-pencil"></i>
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="deleteAdmin(${row.id_admin})">
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
        adminTable.ajax.reload(null, false);
    }

    function addAdmin() {
        Swal.fire({
            ...swalConfig,
            title: 'Tambah Admin Baru',
            html: `
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" id="admin_username" placeholder="Username">
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" id="admin_password" placeholder="Password">
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="admin_nama" placeholder="Nama lengkap">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" id="admin_email" placeholder="email@example.com">
                </div>
                <div class="mb-3">
                    <label class="form-label">Telepon</label>
                    <input type="text" class="form-control" id="admin_telepon" placeholder="08xxxxxxxxx">
                </div>
                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select class="form-control" id="admin_role">
                        <option value="">Pilih Role</option>
                        <?php foreach($roles as $role): ?>
                            <option value="<?= $role->id_role ?>"><?= $role->nama_role ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select class="form-control" id="admin_status">
                        <option value="aktif">Aktif</option>
                        <option value="nonaktif">Nonaktif</option>
                    </select>
                </div>
            `,
            showCancelButton: true,
            confirmButtonText: 'Simpan',
            cancelButtonText: 'Batal',
            preConfirm: () => {
                const username = document.getElementById('admin_username').value;
                const password = document.getElementById('admin_password').value;
                const nama = document.getElementById('admin_nama').value;
                const email = document.getElementById('admin_email').value;
                const telepon = document.getElementById('admin_telepon').value;
                const role = document.getElementById('admin_role').value;
                const status = document.getElementById('admin_status').value;
                
                if (!username || !password || !nama || !role) {
                    Swal.showValidationMessage('Username, password, nama lengkap, dan role harus diisi!');
                    return false;
                }
                
                return { username, password, nama, email, telepon, role, status };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $.post('<?= base_url('owner/add_admin') ?>', {
                    username: result.value.username,
                    password: result.value.password,
                    nama_lengkap: result.value.nama,
                    email: result.value.email,
                    telepon: result.value.telepon,
                    id_role: result.value.role,
                    status: result.value.status
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

    function viewAdmin(id) {
        $.post('<?= base_url('owner/get_admin') ?>', { id: id }, function(response) {
            const res = JSON.parse(response);
            if (res.status === 'success') {
                const admin = res.data;
                
                Swal.fire({
                    ...swalConfig,
                    title: 'Detail Admin',
                    html: `
                        <div class="text-start">
                            <table class="table table-borderless">
                                <tr><td><strong>Username:</strong></td><td>${admin.username}</td></tr>
                                <tr><td><strong>Nama:</strong></td><td>${admin.nama_lengkap}</td></tr>
                                <tr><td><strong>Email:</strong></td><td>${admin.email || '-'}</td></tr>
                                <tr><td><strong>Telepon:</strong></td><td>${admin.telepon || '-'}</td></tr>
                                <tr><td><strong>Role:</strong></td><td><span class="badge bg-info">${admin.nama_role}</span></td></tr>
                                <tr><td><strong>Status:</strong></td><td><span class="badge ${admin.status === 'aktif' ? 'bg-success' : 'bg-danger'}">${admin.status.charAt(0).toUpperCase() + admin.status.slice(1)}</span></td></tr>
                                <tr><td><strong>Dibuat:</strong></td><td>${admin.created_at ? new Date(admin.created_at).toLocaleString('id-ID') : '-'}</td></tr>
                                <tr><td><strong>Diupdate:</strong></td><td>${admin.updated_at ? new Date(admin.updated_at).toLocaleString('id-ID') : '-'}</td></tr>
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

    function editAdmin(id) {
        $.post('<?= base_url('owner/get_admin') ?>', { id: id }, function(response) {
            const res = JSON.parse(response);
            if (res.status === 'success') {
                const admin = res.data;
                Swal.fire({
                    ...swalConfig,
                    title: 'Edit Admin',
                    html: `
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" id="edit_username" value="${admin.username}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password Baru (kosongkan jika tidak diubah)</label>
                            <input type="password" class="form-control" id="edit_password">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="edit_nama" value="${admin.nama_lengkap}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" id="edit_email" value="${admin.email || ''}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Telepon</label>
                            <input type="text" class="form-control" id="edit_telepon" value="${admin.telepon || ''}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <select class="form-control" id="edit_role">
                                <?php foreach($roles as $role): ?>
                                    <option value="<?= $role->id_role ?>" ${admin.id_role == <?= $role->id_role ?> ? 'selected' : ''}><?= $role->nama_role ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-control" id="edit_status">
                                <option value="aktif" ${admin.status === 'aktif' ? 'selected' : ''}>Aktif</option>
                                <option value="nonaktif" ${admin.status === 'nonaktif' ? 'selected' : ''}>Nonaktif</option>
                            </select>
                        </div>
                    `,
                    showCancelButton: true,
                    confirmButtonText: 'Update',
                    cancelButtonText: 'Batal',
                    preConfirm: () => {
                        const username = document.getElementById('edit_username').value;
                        const password = document.getElementById('edit_password').value;
                        const nama = document.getElementById('edit_nama').value;
                        const email = document.getElementById('edit_email').value;
                        const telepon = document.getElementById('edit_telepon').value;
                        const role = document.getElementById('edit_role').value;
                        const status = document.getElementById('edit_status').value;
                        
                        if (!username || !nama || !role) {
                            Swal.showValidationMessage('Username, nama lengkap, dan role harus diisi!');
                            return false;
                        }
                        
                        return { username, password, nama, email, telepon, role, status };
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.post('<?= base_url('owner/update_admin') ?>', {
                            id: id,
                            username: result.value.username,
                            password: result.value.password,
                            nama_lengkap: result.value.nama,
                            email: result.value.email,
                            telepon: result.value.telepon,
                            id_role: result.value.role,
                            status: result.value.status
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

    function deleteAdmin(id) {
        confirmDelete(() => {
            $.post('<?= base_url('owner/delete_admin') ?>', { id: id }, function(response) {
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