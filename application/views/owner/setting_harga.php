<?php $this->load->view('owner/partials/header', ['pageTitle' => 'Setting Harga']); ?>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    
                    <!-- Page Title -->
                    <div class="row">
                        <div class="col-12">
                            <h4 class="page-title">Setting Harga</h4>
                        </div>
                    </div>

                    <!-- Stats Overview -->
                    <div class="row mb-4">
                        <div class="col-xl-3 col-md-6 mb-3">
                            <div class="stats-card">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="bg-primary text-white rounded-3 p-3">
                                            <i class="mdi mdi-washing-machine font-size-20"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="stats-number"><?= $stats['total_layanan'] ?></div>
                                        <div class="text-muted">Total Layanan</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xl-3 col-md-6 mb-3">
                            <div class="stats-card">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="bg-success text-white rounded-3 p-3">
                                            <i class="mdi mdi-truck font-size-20"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="stats-number"><?= $stats['total_ongkir'] ?></div>
                                        <div class="text-muted">Tarif Ongkir</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xl-3 col-md-6 mb-3">
                            <div class="stats-card">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="bg-info text-white rounded-3 p-3">
                                            <i class="mdi mdi-currency-usd font-size-20"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="stats-number">Rp <?= number_format($stats['min_price'], 0, ',', '.') ?></div>
                                        <div class="text-muted">Harga Terendah</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xl-3 col-md-6 mb-3">
                            <div class="stats-card">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="bg-warning text-white rounded-3 p-3">
                                            <i class="mdi mdi-chart-line font-size-20"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="stats-number">Rp <?= number_format($stats['max_price'], 0, ',', '.') ?></div>
                                        <div class="text-muted">Harga Tertinggi</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Service Pricing -->
                    <div class="row">
                        <div class="col-xl-8">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h5 class="card-title mb-0">Harga Layanan Laundry</h5>
                                        <button type="button" class="btn btn-primary" onclick="addService()">
                                            <i class="mdi mdi-plus me-1"></i>Tambah Layanan
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Layanan</th>
                                                    <th>Harga/Kg</th>
                                                    <th>Deskripsi</th>
                                                    <th>Status</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($laundry_services as $service): ?>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="bg-primary text-white rounded-3 p-2 me-3">
                                                                <i class="mdi mdi-tshirt-crew"></i>
                                                            </div>
                                                            <strong><?= $service->nama_tier ?></strong>
                                                        </div>
                                                    </td>
                                                    <td><strong>Rp <?= number_format($service->harga_per_kg, 0, ',', '.') ?></strong></td>
                                                    <td>Min <?= $service->min_kg ?>kg</td>
                                                    <td>
                                                        <span class="badge bg-<?= $service->status == 'aktif' ? 'success' : 'secondary' ?>">
                                                            <?= ucfirst($service->status) ?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-warning btn-sm me-1" onclick="editService(<?= $service->id_harga_laundry ?>)">
                                                            <i class="mdi mdi-pencil"></i>
                                                        </button>
                                                        <button class="btn btn-danger btn-sm" onclick="deleteService(<?= $service->id_harga_laundry ?>)">
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

                        <!-- Delivery Pricing -->
                        <div class="col-xl-4">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h5 class="card-title mb-0">Tarif Ongkir</h5>
                                        <button type="button" class="btn btn-primary btn-sm" onclick="addOngkir()">
                                            <i class="mdi mdi-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="list-group list-group-flush">
                                        <?php foreach($ongkir_rates as $rate): ?>
                                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                            <div>
                                                <h6 class="mb-1"><?= $rate->nama_tier ?></h6>
                                                <small class="text-muted">Rp <?= number_format($rate->harga_per_km, 0, ',', '.') ?>/km - Min <?= $rate->min_km ?>km</small>
                                            </div>
                                            <div class="text-end">
                                                <span class="badge bg-<?= $rate->status == 'aktif' ? 'success' : 'secondary' ?> mb-2">
                                                    <?= ucfirst($rate->status) ?>
                                                </span>
                                                <div>
                                                    <button class="btn btn-warning btn-sm me-1" onclick="editOngkir(<?= $rate->id_harga_ongkir ?>)">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </button>
                                                    <button class="btn btn-danger btn-sm" onclick="deleteOngkir(<?= $rate->id_harga_ongkir ?>)">
                                                        <i class="mdi mdi-delete"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<script>
    // Laundry Service Functions
    function addService() {
        Swal.fire({
            ...swalConfig,
            title: 'Tambah Tier Laundry',
            html: `
                <div class="mb-3">
                    <label class="form-label">Nama Tier</label>
                    <input type="text" class="form-control" id="service_name" placeholder="Contoh: Tier 1 - Retail">
                </div>
                <div class="mb-3">
                    <label class="form-label">Harga per Kg</label>
                    <input type="number" class="form-control" id="service_price" placeholder="5000">
                </div>
                <div class="mb-3">
                    <label class="form-label">Minimum Kg</label>
                    <input type="number" class="form-control" id="service_min" placeholder="5">
                </div>
            `,
            showCancelButton: true,
            confirmButtonText: 'Simpan',
            cancelButtonText: 'Batal',
            preConfirm: () => {
                const name = document.getElementById('service_name').value;
                const price = document.getElementById('service_price').value;
                const min = document.getElementById('service_min').value;
                
                if (!name || !price || !min) {
                    Swal.showValidationMessage('Semua field harus diisi!');
                    return false;
                }
                
                return { name, price, min };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $.post('<?= base_url('owner/add_laundry_service') ?>', {
                    nama_tier: result.value.name,
                    harga_per_kg: result.value.price,
                    min_kg: result.value.min
                }, function(response) {
                    const res = JSON.parse(response);
                    if (res.status === 'success') {
                        showSuccess(res.message);
                        setTimeout(() => location.reload(), 1500);
                    } else {
                        showError(res.message);
                    }
                });
            }
        });
    }

    function editService(id) {
        $.post('<?= base_url('owner/get_laundry_service') ?>', { id: id }, function(response) {
            const res = JSON.parse(response);
            if (res.status === 'success') {
                const service = res.data;
                Swal.fire({
                    ...swalConfig,
                    title: 'Edit Tier Laundry',
                    html: `
                        <div class="mb-3">
                            <label class="form-label">Nama Tier</label>
                            <input type="text" class="form-control" id="service_name" value="${service.nama_tier}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Harga per Kg</label>
                            <input type="number" class="form-control" id="service_price" value="${service.harga_per_kg}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Minimum Kg</label>
                            <input type="number" class="form-control" id="service_min" value="${service.min_kg}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-control" id="service_status">
                                <option value="aktif" ${service.status === 'aktif' ? 'selected' : ''}>Aktif</option>
                                <option value="nonaktif" ${service.status === 'nonaktif' ? 'selected' : ''}>Non-aktif</option>
                            </select>
                        </div>
                    `,
                    showCancelButton: true,
                    confirmButtonText: 'Update',
                    cancelButtonText: 'Batal',
                    preConfirm: () => {
                        const name = document.getElementById('service_name').value;
                        const price = document.getElementById('service_price').value;
                        const min = document.getElementById('service_min').value;
                        const status = document.getElementById('service_status').value;
                        
                        if (!name || !price || !min) {
                            Swal.showValidationMessage('Semua field harus diisi!');
                            return false;
                        }
                        
                        return { name, price, min, status };
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.post('<?= base_url('owner/update_laundry_service') ?>', {
                            id: id,
                            nama_tier: result.value.name,
                            harga_per_kg: result.value.price,
                            min_kg: result.value.min,
                            status: result.value.status
                        }, function(response) {
                            const res = JSON.parse(response);
                            if (res.status === 'success') {
                                showSuccess(res.message);
                                setTimeout(() => location.reload(), 1500);
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

    function deleteService(id) {
        confirmDelete(() => {
            $.post('<?= base_url('owner/delete_laundry_service') ?>', { id: id }, function(response) {
                const res = JSON.parse(response);
                if (res.status === 'success') {
                    showSuccess(res.message);
                    setTimeout(() => location.reload(), 1500);
                } else {
                    showError(res.message);
                }
            });
        });
    }

    // Ongkir Functions
    function addOngkir() {
        Swal.fire({
            ...swalConfig,
            title: 'Tambah Tier Ongkir',
            html: `
                <div class="mb-3">
                    <label class="form-label">Nama Tier</label>
                    <input type="text" class="form-control" id="ongkir_name" placeholder="Tier 1 - Dekat">
                </div>
                <div class="mb-3">
                    <label class="form-label">Harga per KM</label>
                    <input type="number" class="form-control" id="ongkir_price" placeholder="2000">
                </div>
                <div class="mb-3">
                    <label class="form-label">Minimum KM</label>
                    <input type="number" class="form-control" id="ongkir_min" placeholder="10">
                </div>
            `,
            showCancelButton: true,
            confirmButtonText: 'Simpan',
            cancelButtonText: 'Batal',
            preConfirm: () => {
                const name = document.getElementById('ongkir_name').value;
                const price = document.getElementById('ongkir_price').value;
                const min = document.getElementById('ongkir_min').value;
                
                if (!name || !price || !min) {
                    Swal.showValidationMessage('Semua field harus diisi!');
                    return false;
                }
                
                return { name, price, min };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $.post('<?= base_url('owner/add_ongkir_rate') ?>', {
                    nama_tier: result.value.name,
                    harga_per_km: result.value.price,
                    min_km: result.value.min
                }, function(response) {
                    const res = JSON.parse(response);
                    if (res.status === 'success') {
                        showSuccess(res.message);
                        setTimeout(() => location.reload(), 1500);
                    } else {
                        showError(res.message);
                    }
                });
            }
        });
    }

    function editOngkir(id) {
        $.post('<?= base_url('owner/get_ongkir_rate') ?>', { id: id }, function(response) {
            const res = JSON.parse(response);
            if (res.status === 'success') {
                const rate = res.data;
                Swal.fire({
                    ...swalConfig,
                    title: 'Edit Tier Ongkir',
                    html: `
                        <div class="mb-3">
                            <label class="form-label">Nama Tier</label>
                            <input type="text" class="form-control" id="ongkir_name" value="${rate.nama_tier}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Harga per KM</label>
                            <input type="number" class="form-control" id="ongkir_price" value="${rate.harga_per_km}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Minimum KM</label>
                            <input type="number" class="form-control" id="ongkir_min" value="${rate.min_km}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-control" id="ongkir_status">
                                <option value="aktif" ${rate.status === 'aktif' ? 'selected' : ''}>Aktif</option>
                                <option value="nonaktif" ${rate.status === 'nonaktif' ? 'selected' : ''}>Non-aktif</option>
                            </select>
                        </div>
                    `,
                    showCancelButton: true,
                    confirmButtonText: 'Update',
                    cancelButtonText: 'Batal',
                    preConfirm: () => {
                        const name = document.getElementById('ongkir_name').value;
                        const price = document.getElementById('ongkir_price').value;
                        const min = document.getElementById('ongkir_min').value;
                        const status = document.getElementById('ongkir_status').value;
                        
                        if (!name || !price || !min) {
                            Swal.showValidationMessage('Semua field harus diisi!');
                            return false;
                        }
                        
                        return { name, price, min, status };
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.post('<?= base_url('owner/update_ongkir_rate') ?>', {
                            id: id,
                            nama_tier: result.value.name,
                            harga_per_km: result.value.price,
                            min_km: result.value.min,
                            status: result.value.status
                        }, function(response) {
                            const res = JSON.parse(response);
                            if (res.status === 'success') {
                                showSuccess(res.message);
                                setTimeout(() => location.reload(), 1500);
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

    function deleteOngkir(id) {
        confirmDelete(() => {
            $.post('<?= base_url('owner/delete_ongkir_rate') ?>', { id: id }, function(response) {
                const res = JSON.parse(response);
                if (res.status === 'success') {
                    showSuccess(res.message);
                    setTimeout(() => location.reload(), 1500);
                } else {
                    showError(res.message);
                }
            });
        });
    }
</script>

<?php $this->load->view('owner/partials/footer'); ?>