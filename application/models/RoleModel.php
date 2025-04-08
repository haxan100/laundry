<?php

defined('BASEPATH') or exit('No direct script access allowed');

class RoleModel extends MY_Model
{
	protected $table = 'role'; // Nama tabel
	protected $primaryKey = 'id_role'; // Primary key

	public function getRolesWithPermissions()
	{
		// Mengambil semua data role dengan format yang cocok untuk ditampilkan
		return $this->getAll();
	}
	public function addRole($data)
    {
        // Ambil semua kolom dari tabel role
        $columns = $this->db->list_fields($this->table);

        // Filter data berdasarkan kolom yang ada di tabel
        $filteredData = array_filter(
            $data,
            function ($key) use ($columns) {
                return in_array($key, $columns); // Hanya ambil data yang sesuai dengan kolom tabel
            },
            ARRAY_FILTER_USE_KEY
        );

        // Insert data ke dalam tabel
        return $this->db->insert($this->table, $filteredData);
    }
	public function updateRolePermissions($id, $data)
	{
		return $this->update($id, $data);
	}
	public function deleteRoleById($id)
	{
		return $this->delete($id);
	}
	public function dt_roles($post)
	{
		$columns = $this->db->list_fields('role'); // Ambil semua kolom tabel role

		$this->db->from('role');
		if (!empty($post['search']['value'])) {
			$this->db->group_start();
			foreach ($columns as $column) {
				$this->db->or_like($column, $post['search']['value']);
			}
			$this->db->group_end();
		}

		$totalData = $this->db->count_all_results('', false);

		if (isset($post['length']) && $post['length'] != -1) {
			$this->db->limit($post['length'], $post['start']);
		}

		$query = $this->db->get();
		return [
			'totalData' => $totalData,
			'data' => $query
		];
	}
	public function findByIdR($table, $id)
	{
		$this->db->where('id_role', $id);
		$query = $this->db->get($table);
		return $query->row();
	}

	public function findById($tabel,$id,$row=true)
	{
		$this->db->where('id_role', $id);
		$query = $this->db->get($tabel);
		if ($row) {
			return $query->row();
		} else {
			return $query->result();
		}
	}
	public function countAdminsByRole($roleId)
    {
        $this->db->from('admin');
        $this->db->where('id_role', $roleId);
        return $this->db->count_all_results();
    }

}
