<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminModel extends CI_Model
{
    private $table = 'admin';

    public function getAdminsWithRole()
    {
        $this->db->select('admin.*, roles.nama_role');
        $this->db->from($this->table);
        $this->db->join('roles', 'admin.id_role = roles.id_role', 'left');
        return $this->db->get()->result();
    }

    public function getAdminWithRole($id)
    {
        $this->db->select('admin.*, roles.nama_role');
        $this->db->from($this->table);
        $this->db->join('roles', 'admin.id_role = roles.id_role', 'left');
        $this->db->where('admin.id_admin', $id);
        return $this->db->get()->row();
    }

    public function findByUsername($username)
    {
        return $this->db->get_where($this->table, ['username' => $username])->row();
    }

    public function getAll()
    {
        return $this->db->get($this->table)->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->table, ['id_admin' => $id])->row();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data)
    {
        return $this->db->where('id_admin', $id)->update($this->table, $data);
    }

    public function delete($id)
    {
        return $this->db->where('id_admin', $id)->delete($this->table);
    }

    public function findAdmin($username)
    {
        return $this->db->get_where($this->table, ['username' => $username])->row();
    }
}