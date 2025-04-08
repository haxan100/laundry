<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PolicyModel extends CI_Model
{
    private $table = 'policies'; // Nama tabel kebijakan

    // Simpan kebijakan
    public function savePolicy($data)
    {
        $existingPolicy = $this->db->get($this->table)->row();

        if ($existingPolicy) {
            // Update kebijakan jika sudah ada
            $this->db->update($this->table, $data);
        } else {
            // Insert kebijakan jika belum ada
            $data['created_at'] = date('Y-m-d H:i:s');
            $this->db->insert($this->table, $data);
        }

        return $this->db->affected_rows() > 0;
    }

    // Ambil kebijakan
    public function getPolicy()
    {
        return $this->db->get($this->table)->row();
    }
}
