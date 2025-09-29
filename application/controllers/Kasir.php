<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kasir extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('AdminModel');
        $this->load->model('CustomerModel');
        $this->load->model('LaundryModel');
        $this->load->model('TransaksiModel');
        $this->load->helper('encryption');
        check_login();
        
        // Check if user is cashier
        if ($this->session->userdata('id_role') != 3) {
            redirect('dashboard');
        }
    }

    public function index()
    {
        $data['title'] = 'POS Kasir - ' . $this->config->item('title');
        $data['user'] = $this->AdminModel->getById($this->session->userdata('user_id'));
        $data['today_transactions'] = $this->TransaksiModel->getTodayTransactionCount($this->session->userdata('user_id'));
        $this->load->view('kasir/index', $data);
    }

    public function get_customers()
    {
        $customers = $this->db->get('customers')->result();
        echo json_encode(['status' => 'success', 'data' => $customers]);
    }
    
    public function debug_customers()
    {
        // Show table structure and data for debugging
        $tables = $this->db->query("SHOW TABLES LIKE 'customers'")->result();
        if (empty($tables)) {
            echo "<h3>Table 'customers' does not exist!</h3>";
            return;
        }
        
        $structure = $this->db->query("DESCRIBE customers")->result();
        $data = $this->db->get('customers')->result();
        
        echo "<h3>Customers Table Structure:</h3>";
        echo "<table border='1' style='border-collapse: collapse; margin-bottom: 20px;'>";
        echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th></tr>";
        foreach ($structure as $field) {
            echo "<tr><td>{$field->Field}</td><td>{$field->Type}</td><td>{$field->Null}</td><td>{$field->Key}</td><td>{$field->Default}</td></tr>";
        }
        echo "</table>";
        
        echo "<h3>Customers Data (" . count($data) . " records):</h3>";
        if (empty($data)) {
            echo "<p>No data found in customers table.</p>";
        } else {
            echo "<table border='1' style='border-collapse: collapse;'>";
            echo "<tr><th>ID</th><th>Nama</th><th>Email</th><th>Telepon</th><th>Tier Level</th><th>Created At</th></tr>";
            foreach ($data as $customer) {
                echo "<tr>";
                echo "<td>" . (isset($customer->id_customer) ? $customer->id_customer : 'N/A') . "</td>";
                echo "<td>" . (isset($customer->nama) ? $customer->nama : 'N/A') . "</td>";
                echo "<td>" . (isset($customer->email) ? $customer->email : 'N/A') . "</td>";
                echo "<td>" . (isset($customer->telepon) ? $customer->telepon : 'N/A') . "</td>";
                echo "<td>" . (isset($customer->tier_level) ? $customer->tier_level : 'N/A') . "</td>";
                echo "<td>" . (isset($customer->created_at) ? $customer->created_at : 'N/A') . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    }

    public function add_customer()
    {
        $nama = $this->input->post('nama');
        $telepon = $this->input->post('telepon');
        
        $data = [
            'nama' => $nama,
            'telepon' => $telepon,
            'tier_level' => 'bronze',
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        if ($this->db->insert('customers', $data)) {
            $customer_id = $this->db->insert_id();
            $customer = $this->db->get_where('customers', ['id_customer' => $customer_id])->row();
            echo json_encode([
                'status' => 'success',
                'message' => 'Customer berhasil ditambahkan!',
                'data' => $customer
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Gagal menambahkan customer!'
            ]);
        }
    }

    public function get_services()
    {
        $services = $this->LaundryModel->getHargaLaundry();
        echo json_encode(['status' => 'success', 'data' => $services]);
    }

    public function get_ongkir()
    {
        $ongkir = $this->LaundryModel->getHargaOngkir();
        echo json_encode(['status' => 'success', 'data' => $ongkir]);
    }

    public function get_customer_tier()
    {
        $customer_id = $this->input->post('customer_id');
        $tier = $this->LaundryModel->getCustomerTier($customer_id);
        echo json_encode(['status' => 'success', 'data' => $tier]);
    }

    public function create_order()
    {
        $data = [
            'customer_type' => $this->input->post('customer_type'),
            'id_customer' => $this->input->post('customer_id'),
            'nama_customer' => $this->input->post('nama_customer'),
            'no_hp' => $this->input->post('no_hp'),
            'total_kilo' => $this->input->post('total_kilo'),
            'id_layanan' => $this->input->post('id_layanan'),
            'harga_per_kilo' => $this->input->post('harga_per_kilo'),
            'subtotal_laundry' => $this->input->post('subtotal_laundry'),
            'is_delivery' => $this->input->post('is_delivery'),
            'id_ongkir' => $this->input->post('id_ongkir'),
            'harga_ongkir' => $this->input->post('harga_ongkir'),
            'discount_percent' => $this->input->post('discount_percent'),
            'discount_amount' => $this->input->post('discount_amount'),
            'subtotal' => $this->input->post('subtotal'),
            'pajak' => $this->input->post('pajak'),
            'total' => $this->input->post('total'),
            'payment_method' => $this->input->post('payment_method'),
            'catatan' => $this->input->post('catatan'),
            'id_kasir' => $this->session->userdata('user_id'),
            'status' => 'pending'
        ];

        $transaction_id = $this->TransaksiModel->createTransaction($data);
        
        if ($transaction_id) {
            // Update customer transaction count if customer exists
            if ($data['id_customer']) {
                $this->db->set('total_transaksi', 'total_transaksi + 1', FALSE);
                $this->db->where('id_customer', $data['id_customer']);
                $this->db->update('customers');
            }
            
            echo json_encode([
                'status' => 'success',
                'message' => 'Transaksi berhasil dibuat!',
                'transaction_id' => $transaction_id
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Gagal membuat transaksi!'
            ]);
        }
    }

    public function logout()
    {
        $this->session->unset_userdata(['user_id', 'username', 'id_role', 'user_type', 'nama_lengkap']);
        $this->session->sess_destroy();
        redirect('dashboard');
    }
}