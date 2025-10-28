<?php $this->load->view('owner/partials/header', ['pageTitle' => 'Dashboard']); ?>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    
                    <!-- Page Title -->
                    <div class="row">
                        <div class="col-12">
                            <h4 class="page-title">Dashboard</h4>
                        </div>
                    </div>

                    <!-- Stats Cards -->
                    <div class="row mb-4">
                        <div class="col-xl-4 col-md-6 mb-3">
                            <div class="stats-card">
                                <i class="fas fa-shopping-cart" style="font-size: 3em; margin-bottom: 15px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;"></i>
                                <div class="stats-number" id="ordersThisMonth">-</div>
                                <p style="color: #718096; font-size: 1rem; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px;">Orders This Month</p>
                            </div>
                        </div>
                        
                        <div class="col-xl-4 col-md-6 mb-3">
                            <div class="stats-card">
                                <i class="fas fa-users" style="font-size: 3em; margin-bottom: 15px; background: linear-gradient(135deg, #48bb78 0%, #38a169 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;"></i>
                                <div class="stats-number" id="totalCustomers">-</div>
                                <p style="color: #718096; font-size: 1rem; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px;">Total Customers</p>
                            </div>
                        </div>
                        
                        <div class="col-xl-4 col-md-6 mb-3">
                            <div class="stats-card">
                                <i class="fas fa-clock" style="font-size: 3em; margin-bottom: 15px; background: linear-gradient(135deg, #f6ad55 0%, #ed8936 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;"></i>
                                <div class="stats-number" id="pendingOrders">-</div>
                                <p style="color: #718096; font-size: 1rem; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px;">Pending Orders</p>
                            </div>
                        </div>
                    </div>

                    <!-- Revenue Overview -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card">
                                <h3 style="margin-bottom: 20px; color: #2d3748; font-size: 1.5rem; font-weight: 700;">Revenue Overview - Bulan Ini</h3>
                                <div class="text-center py-5">
                                    <i class="fas fa-money-bill-wave" style="font-size: 4rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;"></i>
                                    <h2 class="mt-3" style="color: #2d3748; font-weight: 800;" id="monthlyRevenue">Rp 0</h2>
                                    <p class="text-muted">Total pendapatan dari transaksi yang sudah selesai</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Orders -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <h3 style="margin-bottom: 0; color: #2d3748; font-size: 1.5rem; font-weight: 700;">Recent Orders</h3>
                                    <a href="<?= base_url('owner/master_transaksi') ?>" class="btn btn-primary btn-sm">View All</a>
                                </div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Customer</th>
                                                <th>Service</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody id="recentOrdersTable">
                                            <tr>
                                                <td colspan="6" class="text-center">Loading...</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php $this->load->view('owner/partials/footer'); ?>