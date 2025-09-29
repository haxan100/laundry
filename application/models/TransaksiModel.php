<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TransaksiModel extends CI_Model
{
    private $table = 'transaksi';
    private $detail_table = 'transaksi_detail';

    public function getTodayTransactionCount($kasir_id)
    {
        $this->db->where('id_kasir', $kasir_id);
        $this->db->where('DATE(created_at)', date('Y-m-d'));
        return $this->db->count_all_results($this->table);
    }
    
    public function getTodayTransactions($kasir_id)
    {
        $this->db->where('id_kasir', $kasir_id);
        $this->db->where('DATE(created_at)', date('Y-m-d'));
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get($this->table)->result();
    }

    public function createTransaction($data)
    {
        $data['kode_transaksi'] = $this->generateTransactionCode();
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function createTransactionDetail($detail_data)
    {
        return $this->db->insert_batch($this->detail_table, $detail_data);
    }

    private function generateTransactionCode()
    {
        $date = date('Ymd');
        $this->db->like('kode_transaksi', 'TRX' . $date, 'after');
        $this->db->order_by('id_transaksi', 'DESC');
        $this->db->limit(1);
        $last = $this->db->get($this->table)->row();
        
        if ($last) {
            $last_number = (int) substr($last->kode_transaksi, -3);
            $new_number = $last_number + 1;
        } else {
            $new_number = 1;
        }
        
        return 'TRX' . $date . str_pad($new_number, 3, '0', STR_PAD_LEFT);
    }
}