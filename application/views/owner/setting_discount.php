<?php $this->load->view('owner/partials/header', ['pageTitle' => 'Setting Diskon Tier']); ?>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    
                    <!-- Page Title -->
                    <div class="row">
                        <div class="col-12">
                            <h4 class="page-title">Setting Diskon Tier</h4>
                        </div>
                    </div>

                    <!-- Stats Overview -->
                    <div class="row mb-4">
                        <?php 
                        $tier_colors = ['bronze' => 'warning', 'silver' => 'secondary', 'gold' => 'success', 'platinum' => 'primary'];
                        $tier_icons = ['bronze' => 'mdi-medal', 'silver' => 'mdi-medal', 'gold' => 'mdi-medal', 'platinum' => 'mdi-crown'];
                        foreach($discounts as $discount): 
                        ?>
                        <div class="col-xl-3 col-md-6 mb-3">
                            <div class="stats-card">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="bg-<?= $tier_colors[$discount->tier_level] ?> text-white rounded-3 p-3">
                                            <i class="mdi <?= $tier_icons[$discount->tier_level] ?> font-size-20"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="stats-number">Rp <?= number_format($discount->discount_amount, 0, ',', '.') ?></div>
                                        <div class="text-muted"><?= ucfirst($discount->tier_level) ?> (<?= $discount->customer_count ?> customer)</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <!-- Discount Settings -->
                    <div class="row">
                        <div class="col-xl-8">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h5 class="card-title mb-0">Setting Diskon Tier</h5>
                                        <button type="button" class="btn btn-primary" onclick="saveSettings()">
                                            <i class="mdi mdi-content-save me-1"></i>Simpan Pengaturan
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form id="discountForm">
                                        <div class="table-responsive">
                                            <table class="table table-hover mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Tier Level</th>
                                                        <th>Diskon (Rp)</th>
                                                        <th>Status</th>
                                                        <th>Customer</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($discounts as $discount): ?>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="bg-<?= $tier_colors[$discount->tier_level] ?> text-white rounded-3 p-2 me-3">
                                                                    <i class="mdi <?= $tier_icons[$discount->tier_level] ?>"></i>
                                                                </div>
                                                                <strong><?= ucfirst($discount->tier_level) ?></strong>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="number" class="form-control" style="width: 150px;"
                                                                   name="discount[<?= $discount->tier_level ?>]" 
                                                                   value="<?= $discount->discount_amount ?>" 
                                                                   min="0" step="1000">
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" 
                                                                       name="active[<?= $discount->tier_level ?>]" 
                                                                       <?= $discount->is_active ? 'checked' : '' ?>>
                                                                <label class="form-check-label">Aktif</label>
                                                            </div>
                                                        </td>
                                                        <td><?= $discount->customer_count ?> customer</td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="col-xl-4">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h5 class="card-title mb-0">Quick Actions</h5>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="list-group list-group-flush">
                                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                            <div>
                                                <h6 class="mb-1">Reset ke Default</h6>
                                                <small class="text-muted">Kembalikan ke nilai standar</small>
                                            </div>
                                            <button class="btn btn-warning btn-sm" onclick="resetForm()">
                                                <i class="mdi mdi-refresh"></i>
                                            </button>
                                        </div>
                                        
                                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                            <div>
                                                <h6 class="mb-1">Aktifkan Semua</h6>
                                                <small class="text-muted">Aktifkan semua tier</small>
                                            </div>
                                            <button class="btn btn-success btn-sm" onclick="activateAll()">
                                                <i class="mdi mdi-check-all"></i>
                                            </button>
                                        </div>
                                        
                                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                            <div>
                                                <h6 class="mb-1">Nonaktifkan Semua</h6>
                                                <small class="text-muted">Nonaktifkan semua tier</small>
                                            </div>
                                            <button class="btn btn-danger btn-sm" onclick="deactivateAll()">
                                                <i class="mdi mdi-close-circle"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

<script>
    function saveSettings() {
        const data = {};
        
        $('input[name^="discount["]').each(function() {
            const tier = $(this).attr('name').match(/\[(.*?)\]/)[1];
            data[tier] = {
                discount_amount: $(this).val(),
                is_active: $(`input[name="active[${tier}]"]`).is(':checked') ? 1 : 0
            };
        });
        
        $.post('<?= base_url("owner/update_tier_discounts") ?>', {discounts: data}, function(response) {
            if(response.status === 'success') {
                showSuccess(response.message);
                setTimeout(() => location.reload(), 1500);
            } else {
                showError(response.message);
            }
        }, 'json');
    }

    function resetForm() {
        confirmDelete(() => {
            $('input[name="discount[bronze]"]').val(5000);
            $('input[name="discount[silver]"]').val(7000);
            $('input[name="discount[gold]"]').val(10000);
            $('input[name="discount[platinum]"]').val(15000);
            $('input[name^="active["]').prop('checked', true);
            showSuccess('Pengaturan telah direset ke nilai default');
        });
    }

    function activateAll() {
        $('input[name^="active["]').prop('checked', true);
        showSuccess('Semua tier telah diaktifkan');
    }

    function deactivateAll() {
        $('input[name^="active["]').prop('checked', false);
        showSuccess('Semua tier telah dinonaktifkan');
    }
</script>

<?php $this->load->view('owner/partials/footer'); ?>