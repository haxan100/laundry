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

                    <!-- Role Table -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h5 class="card-title mb-0">Daftar Role</h5>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRoleModal">
                                            <i class="mdi mdi-plus"></i> Tambah Role
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover" id="roleTable">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Role</th>
                                                    <th>Deskripsi</th>
                                                    <th>Permissions</th>
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

<!-- Add Role Modal -->
<div class="modal fade" id="addRoleModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="addRoleForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Role</label>
                        <input type="text" class="form-control" name="nama_role" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Permissions</label>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="permissions[]" value="master_role" id="add_master_role">
                                    <label class="form-check-label" for="add_master_role">Master Role</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="permissions[]" value="master_admin" id="add_master_admin">
                                    <label class="form-check-label" for="add_master_admin">Master Admin</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="permissions[]" value="master_customer" id="add_master_customer">
                                    <label class="form-check-label" for="add_master_customer">Master Customer</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="permissions[]" value="master_kasir" id="add_master_kasir">
                                    <label class="form-check-label" for="add_master_kasir">Master Kasir</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="permissions[]" value="master_transaksi" id="add_master_transaksi">
                                    <label class="form-check-label" for="add_master_transaksi">Master Transaksi</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="permissions[]" value="setting_discount" id="add_setting_discount">
                                    <label class="form-check-label" for="add_setting_discount">Setting Diskon Tier</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="permissions[]" value="setting_harga" id="add_setting_harga">
                                    <label class="form-check-label" for="add_setting_harga">Setting Harga</label>
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

<!-- Edit Role Modal -->
<div class="modal fade" id="editRoleModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editRoleForm">
                <input type="hidden" name="id" id="editRoleId">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Role</label>
                        <input type="text" class="form-control" name="nama_role" id="editNamaRole" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" id="editDeskripsi" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Permissions</label>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="permissions[]" value="master_role" id="edit_master_role">
                                    <label class="form-check-label" for="edit_master_role">Master Role</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="permissions[]" value="master_admin" id="edit_master_admin">
                                    <label class="form-check-label" for="edit_master_admin">Master Admin</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="permissions[]" value="master_customer" id="edit_master_customer">
                                    <label class="form-check-label" for="edit_master_customer">Master Customer</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="permissions[]" value="master_kasir" id="edit_master_kasir">
                                    <label class="form-check-label" for="edit_master_kasir">Master Kasir</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="permissions[]" value="master_transaksi" id="edit_master_transaksi">
                                    <label class="form-check-label" for="edit_master_transaksi">Master Transaksi</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="permissions[]" value="setting_discount" id="edit_setting_discount">
                                    <label class="form-check-label" for="edit_setting_discount">Setting Diskon Tier</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="permissions[]" value="setting_harga" id="edit_setting_harga">
                                    <label class="form-check-label" for="edit_setting_harga">Setting Harga</label>
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

<?php $this->load->view('owner/partials/footer'); ?>

<script>
$(document).ready(function() {
    loadRoles();
    
    // Add Role Form
    $('#addRoleForm').on('submit', function(e) {
        e.preventDefault();
        const permissions = [];
        $('input[name="permissions[]"]:checked').each(function() {
            permissions.push($(this).val());
        });
        
        const formData = {
            nama_role: $('input[name="nama_role"]').val(),
            deskripsi: $('textarea[name="deskripsi"]').val(),
            permissions: JSON.stringify(permissions)
        };
        
        $.ajax({
            url: '<?= base_url('owner/add_role') ?>',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    $('#addRoleModal').modal('hide');
                    $('#addRoleForm')[0].reset();
                    loadRoles();
                    showSuccess(response.message);
                } else {
                    showError(response.message);
                }
            }
        });
    });
    
    // Edit Role Form
    $('#editRoleForm').on('submit', function(e) {
        e.preventDefault();
        const permissions = [];
        $('#editRoleForm input[name="permissions[]"]:checked').each(function() {
            permissions.push($(this).val());
        });
        
        const formData = {
            id: $('#editRoleId').val(),
            nama_role: $('#editNamaRole').val(),
            deskripsi: $('#editDeskripsi').val(),
            permissions: JSON.stringify(permissions)
        };
        
        $.ajax({
            url: '<?= base_url('owner/update_role') ?>',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    $('#editRoleModal').modal('hide');
                    loadRoles();
                    showSuccess(response.message);
                } else {
                    showError(response.message);
                }
            }
        });
    });
});

function loadRoles() {
    $('#roleTable').DataTable({
        destroy: true,
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
                render: function(data, type, row, meta) {
                    return meta.row + 1;
                }
            },
            { data: 'nama_role' },
            { data: 'deskripsi' },
            { 
                data: 'permissions',
                render: function(data, type, row) {
                    if (!data) return '-';
                    try {
                        const permissions = JSON.parse(data);
                        return permissions.map(p => `<span class="badge bg-info me-1">${p.replace('_', ' ')}</span>`).join('');
                    } catch (e) {
                        return data;
                    }
                }
            },
            {
                data: null,
                render: function(data, type, row) {
                    return `
                        <button class="btn btn-warning btn-sm" onclick="editRole(${row.id_role})">
                            <i class="mdi mdi-pencil"></i>
                        </button>
                        <button class="btn btn-danger btn-sm" onclick="deleteRole(${row.id_role})">
                            <i class="mdi mdi-delete"></i>
                        </button>
                    `;
                }
            }
        ]
    });
}

function editRole(id) {
    $.ajax({
        url: '<?= base_url('owner/get_role') ?>',
        type: 'POST',
        data: { id: id },
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                const data = response.data;
                $('#editRoleId').val(data.id_role);
                $('#editNamaRole').val(data.nama_role);
                $('#editDeskripsi').val(data.deskripsi);
                
                // Clear all checkboxes first
                $('#editRoleForm input[name="permissions[]"]').prop('checked', false);
                
                // Check permissions
                if (data.permissions) {
                    try {
                        const permissions = JSON.parse(data.permissions);
                        permissions.forEach(function(permission) {
                            $('#edit_' + permission).prop('checked', true);
                        });
                    } catch (e) {
                        console.log('Error parsing permissions:', e);
                    }
                }
                
                $('#editRoleModal').modal('show');
            }
        }
    });
}

function deleteRole(id) {
    if (confirm('Yakin ingin menghapus role ini?')) {
        $.ajax({
            url: '<?= base_url('owner/delete_role') ?>',
            type: 'POST',
            data: { id: id },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    loadRoles();
                    showSuccess(response.message);
                } else {
                    showError(response.message);
                }
            }
        });
    }
}

function showSuccess(message) {
    alert('Success: ' + message);
}

function showError(message) {
    alert('Error: ' + message);
}
</script>