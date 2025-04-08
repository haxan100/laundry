<?php
class TokoModel extends MY_Model
{
	private $table = 'toko';

	public function get_datatables($postData)
    {
		$this->_get_datatables_query($postData);

		if ($_POST['length'] != -1) {
			$this->db->limit($_POST['length'], $_POST['start']);
		}

		$query = $this->db->get();
		return $query->result();
	}

	public function count_filtered($data)
	{
		$this->_get_datatables_query($data);
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function count_filtered_detail($id)
	{
		$this->_get_datatables_query_detail($id);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		return $this->db->count_all($this->table);
	}
	public function count_all_detail()
	{
		return $this->db->count_all('master_harga_details');
	}

	private function _get_datatables_query($data)
	{
		$columns = ['nama_toko', 'username', 'email', 'nomor_telpon', 'created_at', 'last_login'];
		$this->db->from($this->table);

		$i = 0;
		foreach ($columns as $item) {
			if ($_POST['search']['value']) {
				if ($i === 0) {
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if (count($columns) - 1 == $i) {
					$this->db->group_end();
				}
			}
			$i++;
		}
		$this->db->where('deleted_at', null);
		$this->db->where('id_mitra', $data['id']);
		if (isset($_POST['order'])) {
			$this->db->order_by($columns[$_POST['order'][0]['column']], $_POST['order'][0]['dir']);
		} else {
			$this->db->order_by('created_at', 'DESC');
		}
	}

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('deleted_at', null);
		
		$this->db->where('id_toko', $id);
		$query = $this->db->get();

		return $query->row();
	}

	public function save($data)
	{
		if (isset($data['id']) && !empty($data['id'])) {
			$this->db->where('id', $data['id']);
			return $this->db->update($this->table, $data);
		} else {
			return $this->db->insert($this->table, $data);
		}
	}

	public function softDelete($id, $id_tabel, $tabel)
	{
		$data = [
			'deleted_at' => date('Y-m-d H:i:s')
		];
		return $this->db->where($id_tabel, $id)->update($tabel, $data);
	}
	public function get_datatables_detail($id)
	{
		$this->_get_datatables_query_detail($id);

		if ($_POST['length'] != -1) {
			$this->db->limit($_POST['length'], $_POST['start']);
		}

		$query = $this->db->get();
		return $query->result();
	}
	private function _get_datatables_query_detail($id)
	{
		$columns = ['merk', 'model', 'type', 'storage', 'ram', 'harga_a', 'harga_d'];
		$this->db->from('master_harga_details'); // Nama tabel
		$this->db->where('master_harga_id', $id); // Filter berdasarkan ID master_harga

		$i = 0;
		foreach ($columns as $item) {
			if (!empty($_POST['search']['value'])) {
				if ($i === 0) {
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if (count($columns) - 1 == $i) {
					$this->db->group_end();
				}
			}
			$i++;
		}
		$this->db->where('deleted_at', null); // Filter data yang belum dihapus secara soft delete

		// Order berdasarkan kolom yang dipilih di DataTables
		if (isset($_POST['order'])) {
			$this->db->order_by($columns[$_POST['order'][0]['column']], $_POST['order'][0]['dir']);
		} else {
			$this->db->order_by('merk', 'ASC'); // Order default
		}
	}
	public function save_detail($data, $table)
	{
		$this->db->insert('master_harga_details', $data);
	}

	public function update_detail($id, $data, $table, $primaryKey)
	{
		$this->db->where($primaryKey, $id);
		$this->db->update($table, $data);
	}
	public function get_detail_by_id($id, $table)
	{
		return $this->db->get_where("master_harga_details", ['id' => $id])->row_array();
	}
	public function getAllDetails()
	{
		$this->db->select('*');
		$this->db->from('master_harga_details');
		return $this->db->get()->result();
	}
	public function getAllDetailsWithMasterHarga($id)
	{
		$this->db->select('
			master_harga_details.*,
			master_harga.judul_harga,
			master_harga.periode_awal,
			master_harga.periode_akhir
		');
		$this->db->from('master_harga_details');
		$this->db->join('master_harga', 'master_harga.id = master_harga_details.master_harga_id', 'left');
		$this->db->where('master_harga_id', $id);
		
		return $this->db->get()->result();
	}
	public function get_by_nomor($nomor_telpon)
    {
        return $this->db->get_where('toko', ['nomor_telpon' => $nomor_telpon])->row();
    }
	public function get_user_by_email($email)
    {
        return $this->db->get_where($this->table, ['email' => $email])->row();
    }
	public function get_by_field($field, $value)
	{
		return $this->db->get_where('toko', [$field => $value])->row();
	}
	public function get_by_username_or_email($username, $email, $excludeId = null)
	{
		$this->db->group_start();
		$this->db->where('username', $username);
		$this->db->or_where('email', $email);
		$this->db->group_end();

		if ($excludeId) {
			$this->db->where('id_toko !=', $excludeId);
		}
		
		return $this->db->get('toko')->row();
	}
	public function getMitraTokoByIdToko($id_toko) {
        $this->db->select('toko.id_toko, toko.nama_toko, toko.username, master_mitra.nama_mitra');
        $this->db->from('toko');
        $this->db->join('master_mitra', 'toko.id_mitra = master_mitra.id_master_mitra');
        $this->db->where('toko.id_toko', $id_toko);

        $query = $this->db->get();
        return $query->row(); // Mengembalikan satu hasil sebagai array
    }


}
