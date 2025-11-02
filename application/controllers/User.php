<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('TransaksiModel');
    }

    public function index()
    {
        $data['pageTitle'] = 'Cek Transaksi';
        $this->load->view('user/index', $data);
    }

    public function check_transaction()
    {
        $phone = $this->input->post('phone');
        
        if (!$phone) {
            echo json_encode(['status' => 'error', 'message' => 'Nomor telepon harus diisi']);
            return;
        }
        
        // Format phone number - ensure it starts with 8
        $phone = preg_replace('/[^0-9]/', '', $phone);
        if (substr($phone, 0, 1) !== '8') {
            echo json_encode(['status' => 'error', 'message' => 'Nomor telepon harus dimulai dengan 8']);
            return;
        }
        
        // Search transactions by phone number
        $this->db->select('t.*, c.nama as customer_nama, k.nama_lengkap as kasir_nama');
        $this->db->from('transaksi t');
        $this->db->join('customers c', 't.id_customer = c.id_customer', 'left');
        $this->db->join('kasir k', 't.id_kasir = k.id_kasir', 'left');
        $this->db->where('t.no_hp', $phone);
        $this->db->or_where('c.telepon', $phone);
        $this->db->order_by('t.created_at', 'DESC');
        $this->db->limit(10); // Latest 10 transactions
        $transactions = $this->db->get()->result();
        
        if (empty($transactions)) {
            echo json_encode(['status' => 'error', 'message' => 'Tidak ada transaksi ditemukan dengan nomor telepon tersebut']);
            return;
        }
        
        echo json_encode(['status' => 'success', 'data' => $transactions]);
    }

    public function get_transaction_detail()
    {
        $id = $this->input->post('id');
        
        $this->db->select('t.*, c.nama as customer_nama, c.tier_level as customer_tier, k.nama_lengkap as kasir_nama');
        $this->db->from('transaksi t');
        $this->db->join('customers c', 't.id_customer = c.id_customer', 'left');
        $this->db->join('kasir k', 't.id_kasir = k.id_kasir', 'left');
        $this->db->where('t.id_transaksi', $id);
        $transaction = $this->db->get()->row();
        
        if ($transaction) {
            echo json_encode(['status' => 'success', 'data' => $transaction]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Transaksi tidak ditemukan']);
        }
    }
}