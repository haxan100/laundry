<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RoleModel extends CI_Model
{
    private $table = 'roles';

    public function getAll()
    {
        return $this->db->get($this->table)->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->table, ['id_role' => $id])->row();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id_role', $id);
        return $this->db->update($this->table, $data);
    }

    public function delete($id)
    {
        return $this->db->delete($this->table, ['id_role' => $id]);
    }

    public function hasPermission($role_id, $permission)
    {
        $role = $this->getById($role_id);
        if (!$role || !$role->permissions) {
            return false;
        }
        
        $permissions = json_decode($role->permissions, true);
        return in_array($permission, $permissions);
    }
}