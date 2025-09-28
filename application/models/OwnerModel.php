<?php
defined('BASEPATH') or exit('No direct script access allowed');

class OwnerModel extends CI_Model
{
    private $table = 'owners';

    public function findOwner($username)
    {
        return $this->db->get_where($this->table, ['username' => $username])->row();
    }

    public function getAll()
    {
        return $this->db->get($this->table)->result();
    }

    public function findById($id)
    {
        return $this->db->get_where($this->table, ['id_owner' => $id])->row();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data)
    {
        return $this->db->where('id_owner', $id)->update($this->table, $data);
    }

    public function delete($id)
    {
        return $this->db->where('id_owner', $id)->delete($this->table);
    }

    public function getById($id)
    {
        return $this->findById($id);
    }
}