<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LaundryModel extends CI_Model
{
    public function getHargaLaundry()
    {
        $this->db->where('status', 'active');
        return $this->db->get('setting_harga_laundry')->result();
    }

    public function getHargaOngkir()
    {
        $this->db->where('status', 'active');
        return $this->db->get('setting_harga_ongkir')->result();
    }

    public function getTierDiscount()
    {
        $this->db->where('status', 'active');
        $this->db->order_by('min_transaksi', 'ASC');
        return $this->db->get('tier_discounts')->result();
    }

    public function getCustomerTier($customer_id)
    {
        $this->db->select('td.*');
        $this->db->from('customers c');
        $this->db->join('tier_discounts td', 'c.tier_id = td.id_tier');
        $this->db->where('c.id_customer', $customer_id);
        return $this->db->get()->row();
    }
}