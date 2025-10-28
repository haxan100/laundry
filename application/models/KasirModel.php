<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KasirModel extends CI_Model
{
    private $table = 'kasir';

    public function getAll()
    {
        return $this->db->get($this->table)->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->table, ['id_kasir' => $id])->row();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id_kasir', $id);
        return $this->db->update($this->table, $data);
    }

    public function delete($id)
    {
        return $this->db->delete($this->table, ['id_kasir' => $id]);
    }

    public function findByUsername($username)
    {
        return $this->db->get_where($this->table, ['username' => $username])->row();
    }

    public function getByIdWithPassword($id)
    {
        $kasir = $this->db->get_where($this->table, ['id_kasir' => $id])->row();
        if ($kasir) {
            // For MD5, we can't decrypt, so we'll return a placeholder
            $kasir->password_display = 'hello'; // Default password for display
        }
        return $kasir;
    }
}