<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardModel extends CI_Model {

    public function getTotalCustomers() {
        return $this->db->count_all('customers');
    }

    public function getTotalOrdersThisMonth() {
        $this->db->where('MONTH(created_at)', date('m'));
        $this->db->where('YEAR(created_at)', date('Y'));
        return $this->db->count_all_results('transaksi');
    }

    public function getPendingOrders() {
        $this->db->where('status', 'pending');
        return $this->db->count_all_results('transaksi');
    }
}