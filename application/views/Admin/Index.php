<?php $this->load->view('admin/partials/header', ['pageTitle' => 'Dashboard Admin']); ?>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    
                    <!-- Page Title -->
                    <div class="row">
                        <div class="col-12">
                            <h4 class="page-title">Dashboard Admin</h4>
                        </div>
                    </div>

                    <!-- Stats Cards -->
                    <div class="row mb-4">
                        <div class="col-xl-4 col-md-6 mb-3">
                            <div class="stats-card">
                                <i class="fas fa-shopping-cart" style="font-size: 3em; margin-bottom: 15px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;"></i>
                                <div class="stats-number"><?= $totalOrdersThisMonth ?></div>
                                <p style="color: #718096; font-size: 1rem; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px;">Orders This Month</p>
                            </div>
                        </div>
                        
                        <div class="col-xl-4 col-md-6 mb-3">
                            <div class="stats-card">
                                <i class="fas fa-users" style="font-size: 3em; margin-bottom: 15px; background: linear-gradient(135deg, #48bb78 0%, #38a169 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;"></i>
                                <div class="stats-number"><?= $totalCustomers ?></div>
                                <p style="color: #718096; font-size: 1rem; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px;">Total Customers</p>
                            </div>
                        </div>
                        
                        <div class="col-xl-4 col-md-6 mb-3">
                            <div class="stats-card">
                                <i class="fas fa-clock" style="font-size: 3em; margin-bottom: 15px; background: linear-gradient(135deg, #f6ad55 0%, #ed8936 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;"></i>
                                <div class="stats-number"><?= $pendingOrders ?></div>
                                <p style="color: #718096; font-size: 1rem; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px;">Pending Orders</p>
                            </div>
                        </div>
                    </div>

                    <!-- Charts Row -->
                    <div class="row mb-4">
                        <div class="col-xl-8">
                            <div class="card">
                                <h3 style="margin-bottom: 20px; color: #2d3748; font-size: 1.5rem; font-weight: 700;">Admin Overview</h3>
                                <div class="text-center py-5">
                                    <i class="fas fa-chart-line" style="font-size: 4rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;"></i>
                                    <h6 class="mt-3 text-muted">System Analytics</h6>
                                    <p class="text-muted">Analytics chart will be displayed here</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xl-4">
                            <div class="card">
                                <h3 style="margin-bottom: 20px; color: #2d3748; font-size: 1.5rem; font-weight: 700;">User Distribution</h3>
                                <div class="text-center py-4">
                                    <i class="fas fa-chart-pie" style="font-size: 3rem; background: linear-gradient(135deg, #48bb78 0%, #38a169 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;"></i>
                                    <h6 class="mt-3 text-muted">User Chart</h6>
                                    <p class="text-muted small">Distribution chart here</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <h3 style="margin-bottom: 0; color: #2d3748; font-size: 1.5rem; font-weight: 700;">Recent Activity</h3>
                                    <a href="#" class="btn btn-primary btn-sm">View All</a>
                                </div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Activity</th>
                                                <th>User</th>
                                                <th>Type</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><strong>User Login</strong></td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-xs me-2">
                                                            <div class="avatar-title rounded-circle bg-primary text-white">
                                                                A
                                                            </div>
                                                        </div>
                                                        <span>Admin User</span>
                                                    </div>
                                                </td>
                                                <td>Authentication</td>
                                                <td><span class="badge bg-success">Success</span></td>
                                                <td>2024-01-15</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Data Update</strong></td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-xs me-2">
                                                            <div class="avatar-title rounded-circle bg-success text-white">
                                                                S
                                                            </div>
                                                        </div>
                                                        <span>System Admin</span>
                                                    </div>
                                                </td>
                                                <td>Database</td>
                                                <td><span class="badge bg-warning">Processing</span></td>
                                                <td>2024-01-15</td>
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

<?php $this->load->view('admin/partials/footer'); ?>