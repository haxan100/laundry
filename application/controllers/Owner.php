<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Owner extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('OwnerModel');
        $this->load->model('RoleModel');
        $this->load->model('AdminModel');
        $this->load->model('CustomerModel');
        $this->load->model('TierDiscountModel');
        $this->load->model('DashboardModel');
        $this->load->library('encryption');
        $this->load->helper('transaksi');
        $this->check_owner_login();
    }

    private function check_owner_login()
    {
        if (!$this->session->userdata('user_id') || $this->session->userdata('user_type') === 'kasir') {
            redirect('dashboard');
        }
    }

    public function index()
    {
        $obj['ci'] = $this;
        $obj['page'] = 'dashboard';
        $obj['pageTitle'] = 'Dashboard Owner';
        $this->load->view('owner/index', $obj);
    }

    public function master_role()
    {
        $this->load->helper('permission');
        if ($this->session->userdata('user_type') === 'admin' && !check_access_sidebar('master_role')) {
            redirect('admin');
        }
        
        $obj['ci'] = $this;
        $obj['page'] = 'master_role';
        $obj['pageTitle'] = 'Master Role';
        $obj['roles'] = $this->RoleModel->getAll();
        $this->load->view('owner/master_role', $obj);
    }

    public function delete_role()
    {
        $id = $this->input->post('id');
        if ($this->RoleModel->deleteRole($id)) {
            echo json_encode(['status' => 'success', 'message' => 'Role berhasil dihapus']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus role']);
        }
    }

    public function master_owner()
    {
        $this->load->helper('permission');
        if ($this->session->userdata('user_type') === 'admin' && !check_access_sidebar('master_owner')) {
            redirect('admin');
        }
        
        $obj['ci'] = $this;
        $obj['page'] = 'master_owner';
        $obj['pageTitle'] = 'Master Owner';
        $obj['owners'] = $this->OwnerModel->getAll();
        $this->load->view('owner/master_owner', $obj);
    }

    public function add_owner()
    {
        $data = [
            'username' => $this->input->post('username'),
            'password' => md5($this->input->post('password')),
            'nama_lengkap' => $this->input->post('nama_lengkap'),
            'email' => $this->input->post('email'),
            'telepon' => $this->input->post('telepon'),
            'alamat' => $this->input->post('alamat'),
            'status' => $this->input->post('status'),
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        // Check if username already exists
        if ($this->OwnerModel->findOwner($data['username'])) {
            echo json_encode(['status' => 'error', 'message' => 'Username sudah digunakan']);
            return;
        }
        
        if ($this->OwnerModel->insert($data)) {
            echo json_encode(['status' => 'success', 'message' => 'Owner berhasil ditambahkan']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menambahkan owner']);
        }
    }

    public function get_owner()
    {
        $id = $this->input->post('id');
        $owner = $this->OwnerModel->getById($id);
        if ($owner) {
            echo json_encode(['status' => 'success', 'data' => $owner]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Owner tidak ditemukan']);
        }
    }

    public function update_owner()
    {
        $id = $this->input->post('id');
        $data = [
            'username' => $this->input->post('username'),
            'nama_lengkap' => $this->input->post('nama_lengkap'),
            'email' => $this->input->post('email'),
            'telepon' => $this->input->post('telepon'),
            'alamat' => $this->input->post('alamat'),
            'status' => $this->input->post('status'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        // Check if username already exists (exclude current record)
        $existing = $this->OwnerModel->findOwner($data['username']);
        if ($existing && $existing->id_owner != $id) {
            echo json_encode(['status' => 'error', 'message' => 'Username sudah digunakan']);
            return;
        }
        
        // Add password if provided
        $password = $this->input->post('password');
        if (!empty($password)) {
            $data['password'] = md5($password);
        }
        
        if ($this->OwnerModel->update($id, $data)) {
            echo json_encode(['status' => 'success', 'message' => 'Owner berhasil diupdate']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal mengupdate owner']);
        }
    }

    public function delete_owner()
    {
        $id = $this->input->post('id');
        
        // Prevent deleting current logged in owner
        if ($id == $this->session->userdata('user_id')) {
            echo json_encode(['status' => 'error', 'message' => 'Tidak dapat menghapus akun yang sedang login']);
            return;
        }
        
        if ($this->OwnerModel->delete($id)) {
            echo json_encode(['status' => 'success', 'message' => 'Owner berhasil dihapus']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus owner']);
        }
    }

    public function master_admin()
    {
        $this->load->helper('permission');
        if ($this->session->userdata('user_type') === 'admin' && !check_access_sidebar('master_admin')) {
            redirect('admin');
        }
        
        $obj['ci'] = $this;
        $obj['page'] = 'master_admin';
        $obj['pageTitle'] = 'Master Admin';
        $obj['admins'] = $this->AdminModel->getAdminsWithRole();
        $obj['roles'] = $this->RoleModel->getAll();
        $this->load->view('owner/master_admin', $obj);
    }

    public function add_admin()
    {
        $data = [
            'username' => $this->input->post('username'),
            'password' => md5($this->input->post('password')),
            'nama_lengkap' => $this->input->post('nama_lengkap'),
            'email' => $this->input->post('email'),
            'telepon' => $this->input->post('telepon'),
            'id_role' => $this->input->post('id_role'),
            'status' => $this->input->post('status'),
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        // Check if username already exists
        if ($this->AdminModel->findByUsername($data['username'])) {
            echo json_encode(['status' => 'error', 'message' => 'Username sudah digunakan']);
            return;
        }
        
        if ($this->AdminModel->insert($data)) {
            echo json_encode(['status' => 'success', 'message' => 'Admin berhasil ditambahkan']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menambahkan admin']);
        }
    }

    public function get_admin()
    {
        $id = $this->input->post('id');
        $admin = $this->AdminModel->getAdminWithRole($id);
        if ($admin) {
            echo json_encode(['status' => 'success', 'data' => $admin]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Admin tidak ditemukan']);
        }
    }

    public function update_admin()
    {
        $id = $this->input->post('id');
        $data = [
            'username' => $this->input->post('username'),
            'nama_lengkap' => $this->input->post('nama_lengkap'),
            'email' => $this->input->post('email'),
            'telepon' => $this->input->post('telepon'),
            'id_role' => $this->input->post('id_role'),
            'status' => $this->input->post('status'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        // Check if username already exists (exclude current record)
        $existing = $this->AdminModel->findByUsername($data['username']);
        if ($existing && $existing->id_admin != $id) {
            echo json_encode(['status' => 'error', 'message' => 'Username sudah digunakan']);
            return;
        }
        
        // Add password if provided
        $password = $this->input->post('password');
        if (!empty($password)) {
            $data['password'] = md5($password);
        }
        
        if ($this->AdminModel->update($id, $data)) {
            echo json_encode(['status' => 'success', 'message' => 'Admin berhasil diupdate']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal mengupdate admin']);
        }
    }

    public function delete_admin()
    {
        $id = $this->input->post('id');
        
        if ($this->AdminModel->delete($id)) {
            echo json_encode(['status' => 'success', 'message' => 'Admin berhasil dihapus']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus admin']);
        }
    }

    public function get_admins_ajax()
    {
        $admins = $this->AdminModel->getAdminsWithRole();
        echo json_encode($admins);
    }

    private function encrypt_password($password)
    {
        // Use the same encryption method as existing admin system
        // Based on database, admin uses encrypted password, owner uses MD5
        return $this->encryption->encrypt($password);
    }

    public function master_customer()
    {
        $this->load->helper('permission');
        if ($this->session->userdata('user_type') === 'admin' && !check_access_sidebar('master_customer')) {
            redirect('owner');
        }
        
        $obj['ci'] = $this;
        $obj['page'] = 'master_customer';
        $obj['pageTitle'] = 'Master Customer';
        $obj['customers'] = $this->CustomerModel->getAll();
        $this->load->view('owner/master_customer', $obj);
    }

    public function get_customers_ajax()
    {
        $this->load->helper('permission');
        if ($this->session->userdata('user_type') === 'admin' && !check_access_sidebar('master_customer')) {
            echo json_encode([]);
            return;
        }
        
        $customers = $this->CustomerModel->getAll();
        echo json_encode($customers);
    }

    public function add_customer()
    {
        $this->load->helper('permission');
        if ($this->session->userdata('user_type') === 'admin' && !check_access_sidebar('master_customer')) {
            echo json_encode(['status' => 'error', 'message' => 'Access denied']);
            return;
        }
        
        $data = [
            'nama' => $this->input->post('nama'),
            'email' => $this->input->post('email'),
            'telepon' => $this->input->post('telepon'),
            'password' => md5($this->input->post('password')),
            'tier_level' => $this->input->post('tier_level'),
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        if ($this->CustomerModel->insert($data)) {
            echo json_encode(['status' => 'success', 'message' => 'Customer berhasil ditambahkan']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menambahkan customer']);
        }
    }

    public function get_customer()
    {
        $this->load->helper('permission');
        if ($this->session->userdata('user_type') === 'admin' && !check_access_sidebar('master_customer')) {
            echo json_encode(['status' => 'error', 'message' => 'Access denied']);
            return;
        }
        
        $id = $this->input->post('id');
        $customer = $this->CustomerModel->getById($id);
        if ($customer) {
            echo json_encode(['status' => 'success', 'data' => $customer]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Customer tidak ditemukan']);
        }
    }

    public function update_customer()
    {
        $this->load->helper('permission');
        if ($this->session->userdata('user_type') === 'admin' && !check_access_sidebar('master_customer')) {
            echo json_encode(['status' => 'error', 'message' => 'Access denied']);
            return;
        }
        
        $id = $this->input->post('id');
        $data = [
            'nama' => $this->input->post('nama'),
            'email' => $this->input->post('email'),
            'telepon' => $this->input->post('telepon'),
            'tier_level' => $this->input->post('tier_level'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        $password = $this->input->post('password');
        if (!empty($password)) {
            $data['password'] = md5($password);
        }
        
        if ($this->CustomerModel->update($id, $data)) {
            echo json_encode(['status' => 'success', 'message' => 'Customer berhasil diupdate']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal mengupdate customer']);
        }
    }

    public function delete_customer()
    {
        $this->load->helper('permission');
        if ($this->session->userdata('user_type') === 'admin' && !check_access_sidebar('master_customer')) {
            echo json_encode(['status' => 'error', 'message' => 'Access denied']);
            return;
        }
        
        $id = $this->input->post('id');
        if ($this->CustomerModel->delete($id)) {
            echo json_encode(['status' => 'success', 'message' => 'Customer berhasil dihapus']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus customer']);
        }
    }

    public function get_roles_ajax()
    {
        $roles = $this->RoleModel->getAll();
        echo json_encode($roles);
    }

    public function get_owners_ajax()
    {
        $owners = $this->OwnerModel->getAll();
        echo json_encode($owners);
    }




  


    public function setting_discount()
    {
        $obj['ci'] = $this;
        $obj['page'] = 'setting_discount';
        $obj['pageTitle'] = 'Setting Diskon Tier';
        $obj['discounts'] = $this->TierDiscountModel->getDiscountsWithCustomerCount();
        $this->load->view('owner/setting_discount', $obj);
    }

    public function setting_harga()
    {
        $this->load->model('Setting_harga_model');
        $obj['ci'] = $this;
        $obj['page'] = 'setting_harga';
        $obj['pageTitle'] = 'Setting Harga';
        $obj['laundry_services'] = $this->Setting_harga_model->get_all_laundry();
        $obj['ongkir_rates'] = $this->Setting_harga_model->get_all_ongkir();
        $obj['stats'] = $this->Setting_harga_model->get_stats();
        $this->load->view('owner/setting_harga', $obj);
    }

    // Laundry Service CRUD
    public function add_laundry_service()
    {
        $this->load->model('Setting_harga_model');
        $data = [
            'nama_tier' => $this->input->post('nama_tier'),
            'harga_per_kg' => $this->input->post('harga_per_kg'),
            'min_kg' => $this->input->post('min_kg'),
            'status' => 'aktif'
        ];
        
        if ($this->Setting_harga_model->insert_laundry($data)) {
            echo json_encode(['status' => 'success', 'message' => 'Layanan berhasil ditambahkan']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menambahkan layanan']);
        }
    }

    public function get_laundry_service()
    {
        $this->load->model('Setting_harga_model');
        $id = $this->input->post('id');
        $service = $this->Setting_harga_model->get_laundry_by_id($id);
        if ($service) {
            echo json_encode(['status' => 'success', 'data' => $service]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Layanan tidak ditemukan']);
        }
    }

    public function update_laundry_service()
    {
        $this->load->model('Setting_harga_model');
        $id = $this->input->post('id');
        $data = [
            'nama_tier' => $this->input->post('nama_tier'),
            'harga_per_kg' => $this->input->post('harga_per_kg'),
            'min_kg' => $this->input->post('min_kg'),
            'status' => $this->input->post('status')
        ];
        
        if ($this->Setting_harga_model->update_laundry($id, $data)) {
            echo json_encode(['status' => 'success', 'message' => 'Layanan berhasil diupdate']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal mengupdate layanan']);
        }
    }

    public function delete_laundry_service()
    {
        $this->load->model('Setting_harga_model');
        $id = $this->input->post('id');
        
        if ($this->Setting_harga_model->delete_laundry($id)) {
            echo json_encode(['status' => 'success', 'message' => 'Layanan berhasil dihapus']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus layanan']);
        }
    }

    // Delivery Rate CRUD
    public function add_ongkir_rate()
    {
        $this->load->model('Setting_harga_model');
        $data = [
            'nama_tier' => $this->input->post('nama_tier'),
            'harga_per_km' => $this->input->post('harga_per_km'),
            'min_km' => $this->input->post('min_km'),
            'status' => 'aktif'
        ];
        
        if ($this->Setting_harga_model->insert_ongkir($data)) {
            echo json_encode(['status' => 'success', 'message' => 'Tarif ongkir berhasil ditambahkan']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menambahkan tarif ongkir']);
        }
    }

    public function get_ongkir_rate()
    {
        $this->load->model('Setting_harga_model');
        $id = $this->input->post('id');
        $rate = $this->Setting_harga_model->get_ongkir_by_id($id);
        if ($rate) {
            echo json_encode(['status' => 'success', 'data' => $rate]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Tarif tidak ditemukan']);
        }
    }

    public function update_ongkir_rate()
    {
        $this->load->model('Setting_harga_model');
        $id = $this->input->post('id');
        $data = [
            'nama_tier' => $this->input->post('nama_tier'),
            'harga_per_km' => $this->input->post('harga_per_km'),
            'min_km' => $this->input->post('min_km'),
            'status' => $this->input->post('status')
        ];
        
        if ($this->Setting_harga_model->update_ongkir($id, $data)) {
            echo json_encode(['status' => 'success', 'message' => 'Tarif ongkir berhasil diupdate']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal mengupdate tarif ongkir']);
        }
    }

    public function delete_ongkir_rate()
    {
        $this->load->model('Setting_harga_model');
        $id = $this->input->post('id');
        
        if ($this->Setting_harga_model->delete_ongkir($id)) {
            echo json_encode(['status' => 'success', 'message' => 'Tarif ongkir berhasil dihapus']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus tarif ongkir']);
        }
    }

    public function update_tier_discounts()
    {
        $discounts = $this->input->post('discounts');
        
        if (!$discounts) {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak valid']);
            return;
        }
        
        $success_count = 0;
        foreach ($discounts as $tier => $data) {
            $update_data = [
                'discount_amount' => (int)$data['discount_amount'],
                'is_active' => (int)$data['is_active'],
                'updated_at' => date('Y-m-d H:i:s')
            ];
            
            if ($this->TierDiscountModel->updateDiscount($tier, $update_data)) {
                $success_count++;
            }
        }
        
        if ($success_count > 0) {
            echo json_encode(['status' => 'success', 'message' => 'Pengaturan diskon berhasil disimpan']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan pengaturan']);
        }
    }

    public function get_tier_discount($tier_level)
    {
        return $this->TierDiscountModel->getDiscountAmount($tier_level);
    }

    public function get_dashboard_stats()
    {
        // Get recent orders (5 latest)
        $this->db->select('t.*, c.nama as customer_nama');
        $this->db->from('transaksi t');
        $this->db->join('customers c', 't.id_customer = c.id_customer', 'left');
        $this->db->order_by('t.created_at', 'DESC');
        $this->db->limit(5);
        $recent_orders = $this->db->get()->result();
        
        // Get monthly revenue (completed transactions only)
        $this->db->select('SUM(total) as monthly_revenue');
        $this->db->from('transaksi');
        $this->db->where('status', 'completed');
        $this->db->where('MONTH(created_at)', date('m'));
        $this->db->where('YEAR(created_at)', date('Y'));
        $revenue_result = $this->db->get()->row();
        $monthly_revenue = $revenue_result ? $revenue_result->monthly_revenue : 0;
        
        $data = [
            'totalCustomers' => $this->DashboardModel->getTotalCustomers(),
            'totalOrdersThisMonth' => $this->DashboardModel->getTotalOrdersThisMonth(),
            'pendingOrders' => $this->DashboardModel->getPendingOrders(),
            'recentOrders' => $recent_orders,
            'monthlyRevenue' => $monthly_revenue
        ];
        
        echo json_encode(['status' => 'success', 'data' => $data]);
    }

    public function master_transaksi()
    {
        $this->load->helper('permission');
        if ($this->session->userdata('user_type') === 'admin' && !check_access_sidebar('master_transaksi')) {
            redirect('admin');
        }
        
        $obj['ci'] = $this;
        $obj['page'] = 'master_transaksi';
        $obj['pageTitle'] = 'Master Transaksi';
        $obj['start_date'] = date('Y-m-01'); // First day of current month
        $obj['end_date'] = date('Y-m-d'); // Today
        $this->load->view('owner/master_transaksi', $obj);
    }

    public function get_transaksi_ajax()
    {
        $start_date = $this->input->post('start_date') ?: date('Y-m-01');
        $end_date = $this->input->post('end_date') ?: date('Y-m-d');
        
        $this->db->select('t.*, c.nama as customer_nama, c.tier_level as customer_tier, a.nama_lengkap as kasir_nama');
        $this->db->from('transaksi t');
        $this->db->join('customers c', 't.id_customer = c.id_customer', 'left');
        $this->db->join('admin a', 't.id_kasir = a.id_admin', 'left');
        $this->db->where('DATE(t.created_at) >=', $start_date);
        $this->db->where('DATE(t.created_at) <=', $end_date);
        $this->db->order_by('t.created_at', 'DESC');
        $transaksi = $this->db->get()->result();
        
        echo json_encode($transaksi);
    }

    public function get_transaksi_detail()
    {
        $id = $this->input->post('id');
        
        $this->db->select('t.*, c.nama as customer_nama, c.tier_level as customer_tier, a.nama_lengkap as kasir_nama');
        $this->db->from('transaksi t');
        $this->db->join('customers c', 't.id_customer = c.id_customer', 'left');
        $this->db->join('admin a', 't.id_kasir = a.id_admin', 'left');
        $this->db->where('t.id_transaksi', $id);
        $transaksi = $this->db->get()->row();
        
        if ($transaksi) {
            echo json_encode(['status' => 'success', 'data' => $transaksi]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Transaksi tidak ditemukan']);
        }
    }

    public function add_role()
    {
        $this->load->model('RoleModel');
        $data = [
            'nama_role' => $this->input->post('nama_role'),
            'deskripsi' => $this->input->post('deskripsi'),
            'permissions' => $this->input->post('permissions')
        ];
        
        if ($this->RoleModel->insert($data)) {
            echo json_encode(['status' => 'success', 'message' => 'Role berhasil ditambahkan']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menambahkan role']);
        }
    }

    public function get_role()
    {
        $this->load->model('RoleModel');
        $id = $this->input->post('id');
        $role = $this->RoleModel->getById($id);
        if ($role) {
            echo json_encode(['status' => 'success', 'data' => $role]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Role tidak ditemukan']);
        }
    }

    public function update_role()
    {
        $this->load->model('RoleModel');
        $id = $this->input->post('id');
        $data = [
            'nama_role' => $this->input->post('nama_role'),
            'deskripsi' => $this->input->post('deskripsi'),
            'permissions' => $this->input->post('permissions'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        if ($this->RoleModel->update($id, $data)) {
            echo json_encode(['status' => 'success', 'message' => 'Role berhasil diupdate']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal mengupdate role']);
        }
    }

    public function master_kasir()
    {
        $this->load->helper('permission');
        if ($this->session->userdata('user_type') === 'admin' && !check_access_sidebar('master_kasir')) {
            redirect('admin');
        }
        
        $obj['ci'] = $this;
        $obj['page'] = 'master_kasir';
        $obj['pageTitle'] = 'Master Kasir';
        $this->load->view('owner/master_kasir', $obj);
    }

    public function get_kasir_ajax()
    {
        $this->load->model('KasirModel');
        $kasir = $this->KasirModel->getAll();
        echo json_encode($kasir);
    }

    public function add_kasir()
    {
        $this->load->model('KasirModel');
        $data = [
            'username' => $this->input->post('username'),
            'password' => md5($this->input->post('password')),
            'nama_lengkap' => $this->input->post('nama_lengkap'),
            'email' => $this->input->post('email'),
            'telepon' => $this->input->post('telepon'),
            'alamat' => $this->input->post('alamat'),
            'status' => 'aktif'
        ];
        
        if ($this->KasirModel->insert($data)) {
            echo json_encode(['status' => 'success', 'message' => 'Kasir berhasil ditambahkan']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menambahkan kasir']);
        }
    }

    public function get_kasir()
    {
        $this->load->model('KasirModel');
        $id = $this->input->post('id');
        $kasir = $this->KasirModel->getByIdWithPassword($id);
        if ($kasir) {
            echo json_encode(['status' => 'success', 'data' => $kasir]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Kasir tidak ditemukan']);
        }
    }

    public function update_kasir()
    {
        $this->load->model('KasirModel');
        $id = $this->input->post('id');
        $data = [
            'username' => $this->input->post('username'),
            'nama_lengkap' => $this->input->post('nama_lengkap'),
            'email' => $this->input->post('email'),
            'telepon' => $this->input->post('telepon'),
            'alamat' => $this->input->post('alamat'),
            'status' => $this->input->post('status'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        if ($this->input->post('password')) {
            $data['password'] = md5($this->input->post('password'));
        }
        
        if ($this->KasirModel->update($id, $data)) {
            echo json_encode(['status' => 'success', 'message' => 'Kasir berhasil diupdate']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal mengupdate kasir']);
        }
    }

    public function delete_kasir()
    {
        $this->load->model('KasirModel');
        $id = $this->input->post('id');
        
        if ($this->KasirModel->delete($id)) {
            echo json_encode(['status' => 'success', 'message' => 'Kasir berhasil dihapus']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus kasir']);
        }
    }

    public function logout()
    {
        $this->session->unset_userdata(['user_id', 'username', 'user_type', 'nama_lengkap', 'id_role', 'permissions']);
        $this->session->sess_destroy();
        redirect('dashboard');
    }
}