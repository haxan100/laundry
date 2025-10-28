<?php $this->load->view('owner/partials/header', ['pageTitle' => 'Master Kasir']); ?>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    
                    <!-- Page Title -->
                    <div class="row">
                        <div class="col-12">
                            <h4 class="page-title">Master Kasir</h4>
                        </div>
                    </div>

                    <!-- Kasir Table -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h5 class="card-title mb-0">Daftar Kasir</h5>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addKasirModal">
                                            <i class="mdi mdi-plus"></i> Tambah Kasir
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover" id="kasirTable">
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
                                                <!-- Data will be loaded via AJAX -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<!-- Add Kasir Modal -->
<div class="modal fade" id="addKasirModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Kasir</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="addKasirForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" name="password" id="addPassword" required>
                            <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('addPassword', this)">
                                <i class="mdi mdi-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama_lengkap" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Telepon</label>
                        <input type="text" class="form-control" name="telepon">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea class="form-control" name="alamat" rows="3"></textarea>
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

<!-- Edit Kasir Modal -->
<div class="modal fade" id="editKasirModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Kasir</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editKasirForm">
                <input type="hidden" name="id" id="editKasirId">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" id="editUsername" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password <small class="text-muted">(kosongkan jika tidak diubah)</small></label>
                        <div class="input-group">
                            <input type="password" class="form-control" name="password" id="editPassword">
                            <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('editPassword', this)">
                                <i class="mdi mdi-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama_lengkap" id="editNamaLengkap" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="editEmail">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Telepon</label>
                        <input type="text" class="form-control" name="telepon" id="editTelepon">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea class="form-control" name="alamat" id="editAlamat" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status" id="editStatus">
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

<?php $this->load->view('owner/partials/footer'); ?>

<script>
$(document).ready(function() {
    loadKasir();
    
    // Add Kasir Form
    $('#addKasirForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: '<?= base_url('owner/add_kasir') ?>',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    $('#addKasirModal').modal('hide');
                    $('#addKasirForm')[0].reset();
                    loadKasir();
                    showSuccess(response.message);
                } else {
                    showError(response.message);
                }
            }
        });
    });
    
    // Edit Kasir Form
    $('#editKasirForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: '<?= base_url('owner/update_kasir') ?>',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    $('#editKasirModal').modal('hide');
                    loadKasir();
                    showSuccess(response.message);
                } else {
                    showError(response.message);
                }
            }
        });
    });
});

function loadKasir() {
    $('#kasirTable').DataTable({
        destroy: true,
        processing: true,
        serverSide: false,
        ajax: {
            url: '<?= base_url('owner/get_kasir_ajax') ?>',
            type: 'GET',
            dataSrc: ''
        },
        columns: [
            { 
                data: null,
                render: function(data, type, row, meta) {
                    return meta.row + 1;
                }
            },
            { data: 'username' },
            { data: 'nama_lengkap' },
            { data: 'email' },
            { data: 'telepon' },
            { 
                data: 'status',
                render: function(data, type, row) {
                    return data === 'aktif' ? 
                        '<span class="badge bg-success">Aktif</span>' : 
                        '<span class="badge bg-danger">Non Aktif</span>';
                }
            },
            {
                data: null,
                render: function(data, type, row) {
                    return `
                        <button class="btn btn-warning btn-sm" onclick="editKasir(${row.id_kasir})">
                            <i class="mdi mdi-pencil"></i>
                        </button>
                        <button class="btn btn-danger btn-sm" onclick="deleteKasir(${row.id_kasir})">
                            <i class="mdi mdi-delete"></i>
                        </button>
                    `;
                }
            }
        ]
    });
}

function editKasir(id) {
    $.ajax({
        url: '<?= base_url('owner/get_kasir') ?>',
        type: 'POST',
        data: { id: id },
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                const data = response.data;
                $('#editKasirId').val(data.id_kasir);
                $('#editUsername').val(data.username);
                $('#editPassword').val(data.password_display || '');
                $('#editNamaLengkap').val(data.nama_lengkap);
                $('#editEmail').val(data.email);
                $('#editTelepon').val(data.telepon);
                $('#editAlamat').val(data.alamat);
                $('#editStatus').val(data.status);
                $('#editKasirModal').modal('show');
            }
        }
    });
}

function deleteKasir(id) {
    if (confirm('Yakin ingin menghapus kasir ini?')) {
        $.ajax({
            url: '<?= base_url('owner/delete_kasir') ?>',
            type: 'POST',
            data: { id: id },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    loadKasir();
                    showSuccess(response.message);
                } else {
                    showError(response.message);
                }
            }
        });
    }
}

function showSuccess(message) {
    // Add your success notification here
    alert('Success: ' + message);
}

function showError(message) {
    // Add your error notification here
    alert('Error: ' + message);
}

function togglePassword(inputId, button) {
    const input = document.getElementById(inputId);
    const icon = button.querySelector('i');
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('mdi-eye');
        icon.classList.add('mdi-eye-off');
    } else {
        input.type = 'password';
        icon.classList.remove('mdi-eye-off');
        icon.classList.add('mdi-eye');
    }
}
</script>