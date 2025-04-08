<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TermsModel extends CI_Model
{
    protected $table = 'terms_conditions';

    public function saveTerms($data)
    {
        $existing = $this->db->get($this->table)->row();
        if ($existing) {
            // Jika data sudah ada, update
            return $this->db->update($this->table, $data);
        } else {
            // Jika belum ada, insert
            return $this->db->insert($this->table, $data);
        }
    }

    public function getLatestTerms()
    {
        return $this->db->get($this->table)->row();
    }
}
