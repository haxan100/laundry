<?php $this->load->view('owner/partials/header', ['pageTitle' => 'Master Customer']); ?>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    
                    <!-- Page Title -->
                    <div class="row">
                        <div class="col-12">
                            <h4 class="page-title">Master Customer</h4>
                        </div>
                    </div>

                    <!-- Stats Overview -->
                    <div class="row mb-4">
                        <?php 
                        $tier_counts = ['bronze' => 0, 'silver' => 0, 'gold' => 0, 'platinum' => 0];
                        foreach($customers as $customer) {
                            $tier_counts[$customer->tier_level]++;
                        }
                        $tier_colors = ['bronze' => 'warning', 'silver' => 'secondary', 'gold' => 'success', 'platinum' => 'primary'];
                        $tier_icons = ['bronze' => 'mdi-medal', 'silver' => 'mdi-medal', 'gold' => 'mdi-medal', 'platinum' => 'mdi-crown'];
                        foreach($tier_counts as $tier => $count): 
                        ?>
                        <div class="col-xl-3 col-md-6 mb-3">
                            <div class="stats-card">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="bg-<?= $tier_colors[$tier] ?> text-white rounded-3 p-3">
                                            <i class="mdi <?= $tier_icons[$tier] ?> font-size-20"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="stats-number"><?= $count ?></div>
                                        <div class="text-muted"><?= ucfirst($tier) ?> Customer</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <!-- Customer Data -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h5 class="card-title mb-0">Data Customer</h5>
                                        <button type="button" class="btn btn-primary" onclick="addCustomer()">
                                            <i class="mdi mdi-plus me-1"></i>Tambah Customer
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="customerTable" class="table table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Customer</th>
                                                    <th>Kontak</th>
                                                    <th>Tier Level</th>
                                                    <th>Last Activity</th>
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
    let customerTable;
    
    $(document).ready(function() {
        customerTable = $('#customerTable').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: '<?= base_url('owner/get_customers_ajax') ?>',
                type: 'GET',
                dataSrc: ''
            },
            columns: [
                {
                    data: null,
                    render: function(data, type, row) {
                        const tierColors = { bronze: 'warning', silver: 'secondary', gold: 'success', platinum: 'primary' };
                        const tierIcons = { bronze: 'mdi-medal', silver: 'mdi-medal', gold: 'mdi-medal', platinum: 'mdi-crown' };
                        return `
                            <div class="d-flex align-items-center">
                                <div class="bg-${tierColors[row.tier_level]} text-white rounded-3 p-2 me-3">
                                    <i class="mdi ${tierIcons[row.tier_level]}"></i>
                                </div>
                                <div>
                                    <strong>${row.nama}</strong>
                                    <br><small class="text-muted">${row.email || 'No email'}</small>
                                </div>
                            </div>
                        `;
                    }
                },
                { data: 'telepon' },
                {
                    data: 'tier_level',
                    render: function(data, type, row) {
                        const tierColors = { bronze: 'warning', silver: 'secondary', gold: 'success', platinum: 'primary' };
                        return `<span class="badge bg-${tierColors[data]}">${data.charAt(0).toUpperCase() + data.slice(1)}</span>`;
                    }
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        const lastLogin = row.last_login ? new Date(row.last_login).toLocaleDateString('id-ID') : '-';
                        const lastWash = row.last_wash ? new Date(row.last_wash).toLocaleDateString('id-ID') : '-';
                        return `
                            <small class="text-muted">
                                Login: ${lastLogin}<br>
                                Wash: ${lastWash}
                            </small>
                        `;
                    }
                },
                {
                    data: null,
                    orderable: false,
                    render: function(data, type, row) {
                        return `
                            <button class="btn btn-info btn-sm me-1" onclick="viewCustomer(${row.id_customer})">
                                <i class="mdi mdi-eye"></i>
                            </button>
                            <button class="btn btn-warning btn-sm me-1" onclick="editCustomer(${row.id_customer})">
                                <i class="mdi mdi-pencil"></i>
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="deleteCustomer(${row.id_customer})">
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
        customerTable.ajax.reload(null, false);
    }

    function addCustomer() {
        Swal.fire({
            ...swalConfig,
            title: 'Tambah Customer Baru',
            html: `
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-control" id="customer_name" placeholder="Nama lengkap">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" id="customer_email" placeholder="email@example.com">
                </div>
                <div class="mb-3">
                    <label class="form-label">Telepon</label>
                    <input type="text" class="form-control" id="customer_phone" placeholder="89xxxxxxxx">
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" id="customer_password" placeholder="Password">
                </div>
                <div class="mb-3">
                    <label class="form-label">Tier Level</label>
                    <select class="form-control" id="customer_tier">
                        <option value="bronze">Bronze</option>
                        <option value="silver">Silver</option>
                        <option value="gold">Gold</option>
                        <option value="platinum">Platinum</option>
                    </select>
                </div>
            `,
            showCancelButton: true,
            confirmButtonText: 'Simpan',
            cancelButtonText: 'Batal',
            preConfirm: () => {
                const name = document.getElementById('customer_name').value;
                const email = document.getElementById('customer_email').value;
                const phone = document.getElementById('customer_phone').value;
                const password = document.getElementById('customer_password').value;
                const tier = document.getElementById('customer_tier').value;
                
                if (!name || !phone || !password) {
                    Swal.showValidationMessage('Nama, telepon, dan password harus diisi!');
                    return false;
                }
                
                return { name, email, phone, password, tier };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $.post('<?= base_url('owner/add_customer') ?>', {
                    nama: result.value.name,
                    email: result.value.email,
                    telepon: result.value.phone,
                    password: result.value.password,
                    tier_level: result.value.tier
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

    function viewCustomer(id) {
        $.post('<?= base_url('owner/get_customer') ?>', { id: id }, function(response) {
            const res = JSON.parse(response);
            if (res.status === 'success') {
                const customer = res.data;
                const tierColors = { bronze: 'warning', silver: 'secondary', gold: 'success', platinum: 'primary' };
                
                Swal.fire({
                    ...swalConfig,
                    title: 'Detail Customer',
                    html: `
                        <div class="text-start">
                            <table class="table table-borderless">
                                <tr><td><strong>Nama:</strong></td><td>${customer.nama}</td></tr>
                                <tr><td><strong>Email:</strong></td><td>${customer.email || '-'}</td></tr>
                                <tr><td><strong>Telepon:</strong></td><td>${customer.telepon}</td></tr>
                                <tr><td><strong>Tier:</strong></td><td><span class="badge bg-${tierColors[customer.tier_level]}">${customer.tier_level.charAt(0).toUpperCase() + customer.tier_level.slice(1)}</span></td></tr>
                                <tr><td><strong>Last Login:</strong></td><td>${customer.last_login ? new Date(customer.last_login).toLocaleString('id-ID') : '-'}</td></tr>
                                <tr><td><strong>Last Wash:</strong></td><td>${customer.last_wash ? new Date(customer.last_wash).toLocaleString('id-ID') : '-'}</td></tr>
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

    function editCustomer(id) {
        $.post('<?= base_url('owner/get_customer') ?>', { id: id }, function(response) {
            const res = JSON.parse(response);
            if (res.status === 'success') {
                const customer = res.data;
                Swal.fire({
                    ...swalConfig,
                    title: 'Edit Customer',
                    html: `
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" class="form-control" id="edit_name" value="${customer.nama}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" id="edit_email" value="${customer.email || ''}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Telepon</label>
                            <input type="text" class="form-control" id="edit_phone" value="${customer.telepon}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password Baru (kosongkan jika tidak diubah)</label>
                            <input type="password" class="form-control" id="edit_password">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tier Level</label>
                            <select class="form-control" id="edit_tier">
                                <option value="bronze" ${customer.tier_level === 'bronze' ? 'selected' : ''}>Bronze</option>
                                <option value="silver" ${customer.tier_level === 'silver' ? 'selected' : ''}>Silver</option>
                                <option value="gold" ${customer.tier_level === 'gold' ? 'selected' : ''}>Gold</option>
                                <option value="platinum" ${customer.tier_level === 'platinum' ? 'selected' : ''}>Platinum</option>
                            </select>
                        </div>
                    `,
                    showCancelButton: true,
                    confirmButtonText: 'Update',
                    cancelButtonText: 'Batal',
                    preConfirm: () => {
                        const name = document.getElementById('edit_name').value;
                        const email = document.getElementById('edit_email').value;
                        const phone = document.getElementById('edit_phone').value;
                        const password = document.getElementById('edit_password').value;
                        const tier = document.getElementById('edit_tier').value;
                        
                        if (!name || !phone) {
                            Swal.showValidationMessage('Nama dan telepon harus diisi!');
                            return false;
                        }
                        
                        return { name, email, phone, password, tier };
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.post('<?= base_url('owner/update_customer') ?>', {
                            id: id,
                            nama: result.value.name,
                            email: result.value.email,
                            telepon: result.value.phone,
                            password: result.value.password,
                            tier_level: result.value.tier
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

    function deleteCustomer(id) {
        confirmDelete(() => {
            $.post('<?= base_url('owner/delete_customer') ?>', { id: id }, function(response) {
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