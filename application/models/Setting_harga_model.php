<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_harga_model extends CI_Model {

    // Laundry Services CRUD
    public function get_all_laundry() {
        return $this->db->get('setting_harga_laundry')->result();
    }

    public function get_laundry_by_id($id) {
        return $this->db->get_where('setting_harga_laundry', ['id_harga_laundry' => $id])->row();
    }

    public function insert_laundry($data) {
        return $this->db->insert('setting_harga_laundry', $data);
    }

    public function update_laundry($id, $data) {
        return $this->db->update('setting_harga_laundry', $data, ['id_harga_laundry' => $id]);
    }

    public function delete_laundry($id) {
        return $this->db->delete('setting_harga_laundry', ['id_harga_laundry' => $id]);
    }

    // Delivery Pricing CRUD
    public function get_all_ongkir() {
        return $this->db->get('setting_harga_ongkir')->result();
    }

    public function get_ongkir_by_id($id) {
        return $this->db->get_where('setting_harga_ongkir', ['id_harga_ongkir' => $id])->row();
    }

    public function insert_ongkir($data) {
        return $this->db->insert('setting_harga_ongkir', $data);
    }

    public function update_ongkir($id, $data) {
        return $this->db->update('setting_harga_ongkir', $data, ['id_harga_ongkir' => $id]);
    }

    public function delete_ongkir($id) {
        return $this->db->delete('setting_harga_ongkir', ['id_harga_ongkir' => $id]);
    }

    // Statistics
    public function get_stats() {
        $total_layanan = $this->db->count_all('setting_harga_laundry');
        $total_ongkir = $this->db->count_all('setting_harga_ongkir');
        
        $min_price = $this->db->select_min('harga_per_kg')->get('setting_harga_laundry')->row()->harga_per_kg;
        $max_price = $this->db->select_max('harga_per_kg')->get('setting_harga_laundry')->row()->harga_per_kg;
        
        return [
            'total_layanan' => $total_layanan,
            'total_ongkir' => $total_ongkir,
            'min_price' => $min_price ?: 0,
            'max_price' => $max_price ?: 0
        ];
    }
}