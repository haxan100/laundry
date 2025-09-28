<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CustomerModel extends CI_Model
{
    private $table = 'customers';

    public function getAll()
    {
        return $this->db->get($this->table)->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->table, ['id_customer' => $id])->row();
    }

    public function findByEmail($email)
    {
        return $this->db->get_where($this->table, ['email' => $email])->row();
    }

    public function findByTelepon($telepon)
    {
        return $this->db->get_where($this->table, ['telepon' => $telepon])->row();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data)
    {
        return $this->db->where('id_customer', $id)->update($this->table, $data);
    }

    public function delete($id)
    {
        return $this->db->where('id_customer', $id)->delete($this->table);
    }

    public function updateLastLogin($id)
    {
        return $this->db->where('id_customer', $id)->update($this->table, ['last_login' => date('Y-m-d H:i:s')]);
    }

    public function updateLastWash($id)
    {
        return $this->db->where('id_customer', $id)->update($this->table, ['last_wash' => date('Y-m-d H:i:s')]);
    }
}