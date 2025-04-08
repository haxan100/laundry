<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminModel extends CI_Model
{
    protected $table = 'admin';
    protected $primaryKey = 'id_admin';

    public function findAdmin($username)
    {
        return $this->db->get_where($this->table, [
            'username' => $username,
        ])->row();
    }
	public function getFilteredAdmins($postData)
    {
        $this->db->select('admin.*, role.role_name');
        $this->db->from($this->table);
        $this->db->join('role', 'role.id_role = admin.id_role', 'left');

        if (!empty($postData['search']['value'])) {
            $this->db->group_start();
            $this->db->like('admin.username', $postData['search']['value']);
            $this->db->or_like('role.role_name', $postData['search']['value']);
            $this->db->group_end();
        }

        if (!empty($postData['id_role'])) {
            $this->db->where('admin.id_role', $postData['id_role']);
        }

        $this->db->limit($postData['length'], $postData['start']);
        $query = $this->db->get();

        $data = $query->result();

        $this->db->reset_query();
        $this->db->from($this->table);
        $totalRecords = $this->db->count_all_results();

        return [
            'totalRecords' => $totalRecords,
            'filteredRecords' => count($data),
            'data' => $data
        ];
    }
	public function findById($id, $row = true)
	{
		$this->db->where($this->primaryKey, $id);
		$query = $this->db->get($this->table);
		return $row ? $query->row() : $query->result();
	}
	public function update($id, $data)
	{
		return $this->db->where($this->primaryKey, $id)->update($this->table, $data);
	}
}
