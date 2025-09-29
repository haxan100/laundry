<?php $this->load->view('owner/partials/header', ['pageTitle' => 'Master Owner']); ?>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    
                    <!-- Page Title -->
                    <div class="row">
                        <div class="col-12">
                            <h4 class="page-title">Master Owner</h4>
                        </div>
                    </div>

                    <!-- Stats Overview -->
                    <div class="row mb-4">
                        <?php 
                        $status_counts = ['aktif' => 0, 'nonaktif' => 0];
                        foreach($owners as $owner) {
                            $status_counts[$owner->status]++;
                        }
                        ?>
                        <div class="col-xl-3 col-md-6 mb-3">
                            <div class="stats-card">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="bg-success text-white rounded-3 p-3">
                                            <i class="mdi mdi-crown-outline font-size-20"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="stats-number"><?= $status_counts['aktif'] ?></div>
                                        <div class="text-muted">Owner Aktif</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-3">
                            <div class="stats-card">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="bg-danger text-white rounded-3 p-3">
                                            <i class="mdi mdi-crown-off font-size-20"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="stats-number"><?= $status_counts['nonaktif'] ?></div>
                                        <div class="text-muted">Owner Nonaktif</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-3">
                            <div class="stats-card">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="bg-primary text-white rounded-3 p-3">
                                            <i class="mdi mdi-crown font-size-20"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="stats-number"><?= count($owners) ?></div>
                                        <div class="text-muted">Total Owner</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-3">
                            <div class="stats-card">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="bg-info text-white rounded-3 p-3">
                                            <i class="mdi mdi-account-supervisor font-size-20"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="stats-number"><?= $this->session->userdata('user_id') ?></div>
                                        <div class="text-muted">Current Owner</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Owner Data -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h5 class="card-title mb-0">Data Owner</h5>
                                        <button type="button" class="btn btn-primary" onclick="addOwner()">
                                            <i class="mdi mdi-plus me-1"></i>Tambah Owner
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="ownerTable" class="table table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Owner</th>
                                                    <th>Kontak</th>
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
    let ownerTable;
    
    $(document).ready(function() {
        ownerTable = $('#ownerTable').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: '<?= base_url('owner/get_owners_ajax') ?>',
                type: 'GET',
                dataSrc: ''
            },
            columns: [
                {
                    data: null,
                    render: function(data, type, row) {
                        return `
                            <div class="d-flex align-items-center">
                                <div class="bg-warning text-white rounded-3 p-2 me-3">
                                    <i class="mdi mdi-crown"></i>
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
                    data: null,
                    render: function(data, type, row) {
                        return `
                            <div>
                                <div><i class="mdi mdi-email me-1"></i>${row.email || '-'}</div>
                                <div><i class="mdi mdi-phone me-1"></i>${row.telepon || '-'}</div>
                            </div>
                        `;
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
                        const currentUserId = <?= $this->session->userdata('user_id') ?>;
                        const deleteBtn = row.id_owner == currentUserId ? '' : `
                            <button class="btn btn-danger btn-sm" onclick="deleteOwner(${row.id_owner})">
                                <i class="mdi mdi-delete"></i>
                            </button>
                        `;
                        return `
                            <button class="btn btn-info btn-sm me-1" onclick="viewOwner(${row.id_owner})">
                                <i class="mdi mdi-eye"></i>
                            </button>
                            <button class="btn btn-warning btn-sm me-1" onclick="editOwner(${row.id_owner})">
                                <i class="mdi mdi-pencil"></i>
                            </button>
                            ${deleteBtn}
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
        ownerTable.ajax.reload(null, false);
    }

    function addOwner() {
        Swal.fire({
            ...swalConfig,
            title: 'Tambah Owner Baru',
            html: `
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" id="owner_username" placeholder="Username">
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" id="owner_password" placeholder="Password">
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="owner_nama" placeholder="Nama lengkap">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" id="owner_email" placeholder="email@example.com">
                </div>
                <div class="mb-3">
                    <label class="form-label">Telepon</label>
                    <input type="text" class="form-control" id="owner_telepon" placeholder="08xxxxxxxxx">
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea class="form-control" id="owner_alamat" rows="3" placeholder="Alamat lengkap"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select class="form-control" id="owner_status">
                        <option value="aktif">Aktif</option>
                        <option value="nonaktif">Nonaktif</option>
                    </select>
                </div>
            `,
            showCancelButton: true,
            confirmButtonText: 'Simpan',
            cancelButtonText: 'Batal',
            preConfirm: () => {
                const username = document.getElementById('owner_username').value;
                const password = document.getElementById('owner_password').value;
                const nama = document.getElementById('owner_nama').value;
                const email = document.getElementById('owner_email').value;
                const telepon = document.getElementById('owner_telepon').value;
                const alamat = document.getElementById('owner_alamat').value;
                const status = document.getElementById('owner_status').value;
                
                if (!username || !password || !nama) {
                    Swal.showValidationMessage('Username, password, dan nama lengkap harus diisi!');
                    return false;
                }
                
                return { username, password, nama, email, telepon, alamat, status };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $.post('<?= base_url('owner/add_owner') ?>', {
                    username: result.value.username,
                    password: result.value.password,
                    nama_lengkap: result.value.nama,
                    email: result.value.email,
                    telepon: result.value.telepon,
                    alamat: result.value.alamat,
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

    function viewOwner(id) {
        $.post('<?= base_url('owner/get_owner') ?>', { id: id }, function(response) {
            const res = JSON.parse(response);
            if (res.status === 'success') {
                const owner = res.data;
                
                Swal.fire({
                    ...swalConfig,
                    title: 'Detail Owner',
                    html: `
                        <div class="text-start">
                            <table class="table table-borderless">
                                <tr><td><strong>Username:</strong></td><td>${owner.username}</td></tr>
                                <tr><td><strong>Nama:</strong></td><td>${owner.nama_lengkap}</td></tr>
                                <tr><td><strong>Email:</strong></td><td>${owner.email || '-'}</td></tr>
                                <tr><td><strong>Telepon:</strong></td><td>${owner.telepon || '-'}</td></tr>
                                <tr><td><strong>Alamat:</strong></td><td>${owner.alamat || '-'}</td></tr>
                                <tr><td><strong>Status:</strong></td><td><span class="badge ${owner.status === 'aktif' ? 'bg-success' : 'bg-danger'}">${owner.status.charAt(0).toUpperCase() + owner.status.slice(1)}</span></td></tr>
                                <tr><td><strong>Dibuat:</strong></td><td>${owner.created_at ? new Date(owner.created_at).toLocaleString('id-ID') : '-'}</td></tr>
                                <tr><td><strong>Diupdate:</strong></td><td>${owner.updated_at ? new Date(owner.updated_at).toLocaleString('id-ID') : '-'}</td></tr>
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

    function editOwner(id) {
        $.post('<?= base_url('owner/get_owner') ?>', { id: id }, function(response) {
            const res = JSON.parse(response);
            if (res.status === 'success') {
                const owner = res.data;
                Swal.fire({
                    ...swalConfig,
                    title: 'Edit Owner',
                    html: `
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" id="edit_username" value="${owner.username}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password Baru (kosongkan jika tidak diubah)</label>
                            <input type="password" class="form-control" id="edit_password">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="edit_nama" value="${owner.nama_lengkap}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" id="edit_email" value="${owner.email || ''}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Telepon</label>
                            <input type="text" class="form-control" id="edit_telepon" value="${owner.telepon || ''}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea class="form-control" id="edit_alamat" rows="3">${owner.alamat || ''}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-control" id="edit_status">
                                <option value="aktif" ${owner.status === 'aktif' ? 'selected' : ''}>Aktif</option>
                                <option value="nonaktif" ${owner.status === 'nonaktif' ? 'selected' : ''}>Nonaktif</option>
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
                        const alamat = document.getElementById('edit_alamat').value;
                        const status = document.getElementById('edit_status').value;
                        
                        if (!username || !nama) {
                            Swal.showValidationMessage('Username dan nama lengkap harus diisi!');
                            return false;
                        }
                        
                        return { username, password, nama, email, telepon, alamat, status };
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.post('<?= base_url('owner/update_owner') ?>', {
                            id: id,
                            username: result.value.username,
                            password: result.value.password,
                            nama_lengkap: result.value.nama,
                            email: result.value.email,
                            telepon: result.value.telepon,
                            alamat: result.value.alamat,
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

    function deleteOwner(id) {
        confirmDelete(() => {
            $.post('<?= base_url('owner/delete_owner') ?>', { id: id }, function(response) {
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