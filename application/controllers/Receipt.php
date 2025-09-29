<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Receipt extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('TransaksiModel');
        check_login();
    }

    public function print_receipt($transaction_id)
    {
        $transaction = $this->db->get_where('transaksi', ['id_transaksi' => $transaction_id])->row();
        
        if (!$transaction) {
            show_404();
        }

        $laundry_setting = $this->db->get('setting_laundry')->row();
        
        $data['transaction'] = $transaction;
        $data['laundry_setting'] = $laundry_setting;
        $data['title'] = 'Receipt #' . $transaction->kode_transaksi;
        
        $this->load->view('receipt/print', $data);
    }
}