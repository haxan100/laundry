// Laundry Management System - Main JavaScript
class LaundryApp {
    constructor() {
        this.currentPage = 'dashboard';
        this.isDarkMode = localStorage.getItem('darkMode') === 'true';
        this.init();
    }

    init() {
        this.setupEventListeners();
        this.applyTheme();
        this.loadPage('dashboard');
    }

    setupEventListeners() {
        // Sidebar navigation
        document.querySelectorAll('.sidebar-menu a').forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const page = e.target.closest('a').dataset.page;
                this.navigateTo(page);
            });
        });

        // Mobile menu toggle
        document.getElementById('menu-toggle').addEventListener('click', () => {
            this.toggleSidebar();
        });

        // Sidebar close button
        document.getElementById('sidebar-toggle').addEventListener('click', () => {
            this.toggleSidebar();
        });

        // Theme toggle
        document.getElementById('theme-toggle').addEventListener('click', () => {
            this.toggleTheme();
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', (e) => {
            const sidebar = document.getElementById('sidebar');
            const menuToggle = document.getElementById('menu-toggle');
            
            if (window.innerWidth <= 768 && 
                !sidebar.contains(e.target) && 
                !menuToggle.contains(e.target)) {
                sidebar.classList.remove('show');
            }
        });
    }

    navigateTo(page) {
        this.currentPage = page;
        
        // Update active menu item
        document.querySelectorAll('.sidebar-menu a').forEach(link => {
            link.classList.remove('active');
        });
        document.querySelector(`[data-page="${page}"]`).classList.add('active');
        
        // Load page content
        this.loadPage(page);
        
        // Close sidebar on mobile
        if (window.innerWidth <= 768) {
            document.getElementById('sidebar').classList.remove('show');
        }
    }

    toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');
        
        if (window.innerWidth <= 768) {
            sidebar.classList.toggle('show');
        } else {
            sidebar.classList.toggle('hidden');
            mainContent.classList.toggle('expanded');
        }
    }

    toggleTheme() {
        this.isDarkMode = !this.isDarkMode;
        localStorage.setItem('darkMode', this.isDarkMode);
        this.applyTheme();
    }

    applyTheme() {
        const body = document.body;
        const themeIcon = document.querySelector('#theme-toggle i');
        
        if (this.isDarkMode) {
            body.classList.add('dark');
            themeIcon.className = 'fas fa-sun';
        } else {
            body.classList.remove('dark');
            themeIcon.className = 'fas fa-moon';
        }
    }

    async loadPage(page) {
        const content = document.getElementById('page-content');
        content.innerHTML = '<div class="loading"><i class="fas fa-spinner"></i><p>Loading...</p></div>';
        
        try {
            const response = await fetch(`pages/${page}.html`);
            if (response.ok) {
                const html = await response.text();
                content.innerHTML = html;
                this.initPageScripts(page);
            } else {
                content.innerHTML = this.getPageContent(page);
                this.initPageScripts(page);
            }
        } catch (error) {
            content.innerHTML = this.getPageContent(page);
            this.initPageScripts(page);
        }
    }

    getPageContent(page) {
        const pages = {
            dashboard: this.getDashboardContent(),
            pos: this.getPOSContent(),
            orders: this.getOrdersContent(),
            production: this.getProductionContent(),
            customers: this.getCustomersContent(),
            finance: this.getFinanceContent(),
            settings: this.getSettingsContent()
        };
        
        return pages[page] || pages.dashboard;
    }

    getDashboardContent() {
        return `
            <div class="stats-grid">
                <div class="stat-card">
                    <i class="fas fa-tshirt"></i>
                    <h3 id="total-orders">0</h3>
                    <p>Total Orders Today</p>
                </div>
                <div class="stat-card">
                    <i class="fas fa-clock"></i>
                    <h3 id="pending-orders">0</h3>
                    <p>Pending Orders</p>
                </div>
                <div class="stat-card">
                    <i class="fas fa-check-circle"></i>
                    <h3 id="completed-orders">0</h3>
                    <p>Completed Orders</p>
                </div>
                <div class="stat-card">
                    <i class="fas fa-dollar-sign"></i>
                    <h3 id="daily-revenue">Rp 0</h3>
                    <p>Daily Revenue</p>
                </div>
            </div>
            
            <div class="card">
                <h3>Recent Orders</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Service</th>
                            <th>Status</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody id="recent-orders">
                        <tr>
                            <td colspan="5" class="loading">Loading orders...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        `;
    }

    getPOSContent() {
        return `
            <div class="card">
                <h3>New Order</h3>
                <form id="pos-form">
                    <div class="form-group">
                        <label>Customer Name</label>
                        <input type="text" id="customer-name" required>
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="tel" id="customer-phone" required>
                    </div>
                    <div class="form-group">
                        <label>Service Type</label>
                        <select id="service-type" required>
                            <option value="">Select Service</option>
                            <option value="wash-dry">Wash & Dry</option>
                            <option value="wash-iron">Wash & Iron</option>
                            <option value="dry-clean">Dry Clean</option>
                            <option value="iron-only">Iron Only</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Weight (kg)</label>
                        <input type="number" id="weight" min="1" required>
                    </div>
                    <div class="form-group">
                        <label>Notes</label>
                        <textarea id="notes" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Create Order</button>
                </form>
            </div>
        `;
    }

    getOrdersContent() {
        return `
            <div class="card">
                <h3>Order Management</h3>
                <div style="margin-bottom: 20px;">
                    <button class="btn btn-primary" onclick="app.refreshOrders()">
                        <i class="fas fa-refresh"></i> Refresh
                    </button>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Service</th>
                            <th>Weight</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="orders-table">
                        <tr>
                            <td colspan="7" class="loading">Loading orders...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        `;
    }

    getProductionContent() {
        return `
            <div class="card">
                <h3>Production Board</h3>
                <div class="stats-grid">
                    <div class="stat-card">
                        <i class="fas fa-hourglass-start"></i>
                        <h3 id="washing-count">0</h3>
                        <p>In Washing</p>
                    </div>
                    <div class="stat-card">
                        <i class="fas fa-wind"></i>
                        <h3 id="drying-count">0</h3>
                        <p>In Drying</p>
                    </div>
                    <div class="stat-card">
                        <i class="fas fa-iron"></i>
                        <h3 id="ironing-count">0</h3>
                        <p>In Ironing</p>
                    </div>
                    <div class="stat-card">
                        <i class="fas fa-box"></i>
                        <h3 id="packaging-count">0</h3>
                        <p>In Packaging</p>
                    </div>
                </div>
            </div>
        `;
    }

    getCustomersContent() {
        return `
            <div class="card">
                <h3>Customer Management</h3>
                <button class="btn btn-primary" style="margin-bottom: 20px;">
                    <i class="fas fa-plus"></i> Add Customer
                </button>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Total Orders</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="customers-table">
                        <tr>
                            <td colspan="5" class="loading">Loading customers...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        `;
    }

    getFinanceContent() {
        return `
            <div class="stats-grid">
                <div class="stat-card">
                    <i class="fas fa-calendar-day"></i>
                    <h3 id="today-revenue">Rp 0</h3>
                    <p>Today's Revenue</p>
                </div>
                <div class="stat-card">
                    <i class="fas fa-calendar-week"></i>
                    <h3 id="week-revenue">Rp 0</h3>
                    <p>This Week</p>
                </div>
                <div class="stat-card">
                    <i class="fas fa-calendar-alt"></i>
                    <h3 id="month-revenue">Rp 0</h3>
                    <p>This Month</p>
                </div>
                <div class="stat-card">
                    <i class="fas fa-chart-line"></i>
                    <h3 id="total-revenue">Rp 0</h3>
                    <p>Total Revenue</p>
                </div>
            </div>
            
            <div class="card">
                <h3>Financial Reports</h3>
                <p>Revenue tracking and financial analytics will be displayed here.</p>
            </div>
        `;
    }

    getSettingsContent() {
        return `
            <div class="card">
                <h3>System Settings</h3>
                <form id="settings-form">
                    <div class="form-group">
                        <label>Business Name</label>
                        <input type="text" id="business-name" value="Laundry Style">
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <textarea id="business-address" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="tel" id="business-phone">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" id="business-email">
                    </div>
                    <button type="submit" class="btn btn-success">Save Settings</button>
                </form>
            </div>
        `;
    }

    initPageScripts(page) {
        switch(page) {
            case 'dashboard':
                this.loadDashboardData();
                break;
            case 'pos':
                this.initPOSForm();
                break;
            case 'orders':
                this.loadOrders();
                break;
            case 'production':
                this.loadProductionData();
                break;
            case 'customers':
                this.loadCustomers();
                break;
            case 'finance':
                this.loadFinanceData();
                break;
            case 'settings':
                this.initSettingsForm();
                break;
        }
    }

    // Dashboard methods
    loadDashboardData() {
        // Simulate API call with counter animation
        setTimeout(() => {
            this.animateCounter('total-orders', 25);
            this.animateCounter('pending-orders', 8);
            this.animateCounter('completed-orders', 17);
            this.animateCounter('daily-revenue', 850000, 'currency');
            
            this.loadRecentOrders();
        }, 500);
    }
    
    animateCounter(elementId, targetValue, type = 'number') {
        const element = document.getElementById(elementId);
        const startValue = 0;
        const duration = 1000;
        const startTime = performance.now();
        
        const animate = (currentTime) => {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            
            const currentValue = Math.floor(startValue + (targetValue - startValue) * progress);
            
            if (type === 'currency') {
                element.textContent = `Rp ${currentValue.toLocaleString('id-ID')}`;
            } else {
                element.textContent = currentValue;
            }
            
            if (progress < 1) {
                requestAnimationFrame(animate);
            }
        };
        
        requestAnimationFrame(animate);
    }

    loadRecentOrders() {
        const tbody = document.getElementById('recent-orders');
        const orders = [
            { id: 'ORD001', customer: 'John Doe', service: 'Wash & Dry', status: 'Processing', total: 'Rp 35,000' },
            { id: 'ORD002', customer: 'Jane Smith', service: 'Dry Clean', status: 'Completed', total: 'Rp 50,000' },
            { id: 'ORD003', customer: 'Bob Johnson', service: 'Wash & Iron', status: 'Pending', total: 'Rp 40,000' }
        ];
        
        tbody.innerHTML = orders.map((order, index) => `
            <tr style="animation-delay: ${index * 0.1}s">
                <td><strong>${order.id}</strong></td>
                <td>${order.customer}</td>
                <td>${order.service}</td>
                <td><span class="badge ${order.status.toLowerCase()}">${order.status}</span></td>
                <td><strong>${order.total}</strong></td>
            </tr>
        `).join('');
    }

    // POS methods
    initPOSForm() {
        const form = document.getElementById('pos-form');
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            this.createOrder();
        });
    }

    createOrder() {
        const formData = {
            customerName: document.getElementById('customer-name').value,
            customerPhone: document.getElementById('customer-phone').value,
            serviceType: document.getElementById('service-type').value,
            weight: document.getElementById('weight').value,
            notes: document.getElementById('notes').value
        };
        
        // Show loading state
        const submitBtn = document.querySelector('#pos-form button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Creating Order...';
        submitBtn.disabled = true;
        
        // Simulate API call
        setTimeout(() => {
            this.showToast('Order created successfully!', 'success');
            document.getElementById('pos-form').reset();
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }, 1500);
    }

    // Orders methods
    loadOrders() {
        setTimeout(() => {
            const tbody = document.getElementById('orders-table');
            const orders = [
                { id: 'ORD001', customer: 'John Doe', service: 'Wash & Dry', weight: '3kg', status: 'Processing', total: 'Rp 35,000' },
                { id: 'ORD002', customer: 'Jane Smith', service: 'Dry Clean', weight: '2kg', status: 'Completed', total: 'Rp 50,000' },
                { id: 'ORD003', customer: 'Bob Johnson', service: 'Wash & Iron', weight: '4kg', status: 'Pending', total: 'Rp 40,000' }
            ];
            
            tbody.innerHTML = orders.map((order, index) => `
                <tr style="animation: fadeInUp 0.6s ease-out ${index * 0.1}s both">
                    <td><strong>${order.id}</strong></td>
                    <td>${order.customer}</td>
                    <td>${order.service}</td>
                    <td>${order.weight}</td>
                    <td><span class="badge ${order.status.toLowerCase()}">${order.status}</span></td>
                    <td><strong>${order.total}</strong></td>
                    <td>
                        <button class="btn btn-sm btn-primary" onclick="app.editOrder('${order.id}')"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-sm btn-danger" onclick="app.deleteOrder('${order.id}')"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
            `).join('');
        }, 500);
    }
    
    editOrder(orderId) {
        this.showToast(`Editing order ${orderId}`, 'success');
    }
    
    deleteOrder(orderId) {
        if (confirm(`Are you sure you want to delete order ${orderId}?`)) {
            this.showToast(`Order ${orderId} deleted successfully`, 'success');
            this.refreshOrders();
        }
    }

    refreshOrders() {
        document.getElementById('orders-table').innerHTML = '<tr><td colspan="7" class="loading">Loading orders...</td></tr>';
        this.loadOrders();
    }

    // Production methods
    loadProductionData() {
        setTimeout(() => {
            this.animateCounter('washing-count', 5);
            this.animateCounter('drying-count', 3);
            this.animateCounter('ironing-count', 2);
            this.animateCounter('packaging-count', 4);
        }, 500);
    }

    // Customers methods
    loadCustomers() {
        setTimeout(() => {
            const tbody = document.getElementById('customers-table');
            const customers = [
                { name: 'John Doe', phone: '081234567890', email: 'john@email.com', orders: 15 },
                { name: 'Jane Smith', phone: '081234567891', email: 'jane@email.com', orders: 8 },
                { name: 'Bob Johnson', phone: '081234567892', email: 'bob@email.com', orders: 12 }
            ];
            
            tbody.innerHTML = customers.map((customer, index) => `
                <tr style="animation: slideInRight 0.6s ease-out ${index * 0.1}s both">
                    <td><strong>${customer.name}</strong></td>
                    <td>${customer.phone}</td>
                    <td>${customer.email}</td>
                    <td><span class="badge completed">${customer.orders} orders</span></td>
                    <td>
                        <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
            `).join('');
        }, 500);
    }

    // Finance methods
    loadFinanceData() {
        setTimeout(() => {
            this.animateCounter('today-revenue', 850000, 'currency');
            this.animateCounter('week-revenue', 4200000, 'currency');
            this.animateCounter('month-revenue', 18500000, 'currency');
            this.animateCounter('total-revenue', 125000000, 'currency');
        }, 500);
    }

    // Settings methods
    initSettingsForm() {
        const form = document.getElementById('settings-form');
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
            submitBtn.disabled = true;
            
            setTimeout(() => {
                this.showToast('Settings saved successfully!', 'success');
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }, 1000);
        });
    }
    
    showToast(message, type = 'success') {
        // Remove existing toast
        const existingToast = document.querySelector('.toast');
        if (existingToast) {
            existingToast.remove();
        }
        
        // Create toast element
        const toast = document.createElement('div');
        toast.className = `toast ${type}`;
        toast.innerHTML = `
            <div style="display: flex; align-items: center; gap: 10px;">
                <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'}"></i>
                <span>${message}</span>
            </div>
        `;
        
        document.body.appendChild(toast);
        
        // Show toast
        setTimeout(() => toast.classList.add('show'), 100);
        
        // Hide toast after 3 seconds
        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => toast.remove(), 400);
        }, 3000);
    }
}

// Initialize app when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    window.app = new LaundryApp();
});