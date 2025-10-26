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
    
    public function transactions()
    {
        $data['title'] = 'Daftar Transaksi - ' . $this->config->item('title');
        $data['user'] = $this->AdminModel->getById($this->session->userdata('user_id'));
        $data['transactions'] = $this->TransaksiModel->getTodayTransactions($this->session->userdata('user_id'));
        $this->load->view('kasir/transactions', $data);
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
    
    public function calculate_price()
    {
        $berat = (float) $this->input->post('berat');
        $jarak_km = (float) $this->input->post('jarak_km');
        $is_delivery = (bool) $this->input->post('is_delivery');
        $customer_id = $this->input->post('customer_id');
        
        // Get laundry price from database based on weight
        $this->db->where('status', 'aktif');
        $this->db->where('min_kg <=', $berat);
        $this->db->order_by('min_kg', 'DESC');
        $this->db->limit(1);
        $laundry_tier = $this->db->get('setting_harga_laundry')->row();
        
        if ($laundry_tier) {
            $harga_per_kg = $laundry_tier->harga_per_kg;
            $tier = $laundry_tier->nama_tier;
        } else {
            // Fallback jika tidak ada data
            $harga_per_kg = 5000;
            $tier = 'Default Tier';
        }
        
        $subtotal_laundry = $berat * $harga_per_kg;
        
        // Calculate delivery cost from database
        $ongkir = 0;
        $ongkir_tier = '';
        if ($is_delivery && $jarak_km >= 0.5) {
            $this->db->where('status', 'aktif');
            $this->db->where('min_km <=', $jarak_km);
            $this->db->order_by('min_km', 'DESC');
            $this->db->limit(1);
            $ongkir_data = $this->db->get('setting_harga_ongkir')->row();
            
            if ($ongkir_data) {
                $ongkir = $jarak_km * $ongkir_data->harga_per_km;
                $ongkir_tier = $ongkir_data->nama_tier . ' (Rp ' . number_format($ongkir_data->harga_per_km, 0, ',', '.') . '/km)';
            } else {
                // Fallback jika tidak ada data ongkir yang sesuai
                $ongkir = $jarak_km * 2000; // Default Rp 2.000/km
                $ongkir_tier = 'Default Tier (Rp 2.000/km)';
            }
        }
        
        // Get customer discount from tier_discounts table
        $discount_amount = 0;
        $customer_tier = '';
        if ($customer_id) {
            $customer = $this->db->get_where('customers', ['id_customer' => $customer_id])->row();
            if ($customer && $customer->tier_level) {
                $tier_discount = $this->db->get_where('tier_discounts', [
                    'tier_level' => $customer->tier_level,
                    'is_active' => 1
                ])->row();
                
                if ($tier_discount) {
                    $discount_amount = $tier_discount->discount_amount;
                }
                $customer_tier = ucfirst($customer->tier_level);
            }
        }
        
        $subtotal_before_discount = $subtotal_laundry + $ongkir;
        $subtotal_after_discount = $subtotal_before_discount - $discount_amount;
        $total = $subtotal_after_discount;
        
        echo json_encode([
            'status' => 'success',
            'data' => [
                'berat' => $berat,
                'tier' => $tier,
                'harga_per_kg' => $harga_per_kg,
                'subtotal_laundry' => $subtotal_laundry,
                'jarak_km' => $jarak_km,
                'ongkir' => $ongkir,
                'ongkir_tier' => $ongkir_tier,
                'discount_amount' => $discount_amount,
                'customer_tier' => $customer_tier,
                'subtotal_before_discount' => $subtotal_before_discount,
                'subtotal_after_discount' => $subtotal_after_discount,
                'total' => $total
            ]
        ]);
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
            'id_customer' => $this->input->post('customer_id') ?: null,
            'nama_customer' => $this->input->post('nama_customer'),
            'no_hp' => $this->input->post('no_hp'),
            'subtotal' => $this->input->post('total'),
            'pajak' => 0,
            'total' => $this->input->post('total'),
            'payment_method' => $this->input->post('payment_method'),
            'catatan' => $this->input->post('catatan'),
            'status' => 'pending',
            'id_kasir' => $this->session->userdata('user_id')
        ];

        $transaction_id = $this->TransaksiModel->createTransaction($data);
        
        if ($transaction_id) {
            
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

    public function get_laundry_prices()
    {
        $prices = $this->db->get('setting_harga_laundry')->result();
        echo json_encode(['status' => 'success', 'data' => $prices]);
    }
    
    public function get_ongkir_prices()
    {
        $ongkirs = $this->db->get('setting_harga_ongkir')->result();
        echo json_encode(['status' => 'success', 'data' => $ongkirs]);
    }

    public function logout()
    {
        $this->session->unset_userdata(['user_id', 'username', 'id_role', 'user_type', 'nama_lengkap']);
        $this->session->sess_destroy();
        redirect('dashboard');
    }
}