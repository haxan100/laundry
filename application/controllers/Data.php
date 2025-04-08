<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data extends MY_Controller
{
	public function __construct()
	{
		ini_set('max_execution_time', 0);
		ini_set('memory_limit', '2048M');
		parent::__construct();
		$this->load->model('WartawanModel');
		$this->load->model('RoleModel');
		$this->load->model('AdminModel');

		$this->load->helper('url');
		$this->load->helper('button');
	}

	public function getWartawan()
	{
		$dt = $this->WartawanModel->dt_wartawan($this->input->post());

		$datatable = [
			'draw' => $this->input->post('draw') ?? 1,
			'recordsTotal' => $dt['totalData'],
			'recordsFiltered' => $dt['totalData'],
			'data' => []
		];

		$start = $this->input->post('start') ?? 0;
		$no = $start + 1;
		if (empty($dt['data']->result())) {
			echo json_encode([
				'draw' => $this->input->post('draw') ?? 1,
				'recordsTotal' => 0,
				'recordsFiltered' => 0,
				'data' => [],
				'error' => 'Data not found'
			]);
			return;
		}

		foreach ($dt['data']->result() as $row) {
			$dataEdit = 'data-id_wartawan="' . htmlspecialchars($row->id_wartawan, ENT_QUOTES, 'UTF-8') . '" 
			data-username="' . htmlspecialchars($row->username_wartawan, ENT_QUOTES, 'UTF-8') . '" 
			data-email="' . htmlspecialchars($row->email_wartawan, ENT_QUOTES, 'UTF-8') . '" 
			data-nama="' . htmlspecialchars($row->nama_wartawan, ENT_QUOTES, 'UTF-8') . '" 
			data-status="' . htmlspecialchars($row->status, ENT_QUOTES, 'UTF-8') . '"';

			$dataHapus = 'data-id_wartawan="' . htmlspecialchars($row->id_wartawan, ENT_QUOTES, 'UTF-8') . '"';


			$fields = [
				$no++, // Nomor
				$row->username_wartawan,
				$row->email_wartawan,
				$row->nama_wartawan,
				$row->foto_wartawan ? '<img src="' . base_url('uploads/wartawan/' . $row->foto_wartawan) . '" alt="Foto" class="img-thumbnail" style="width: 50px; height: 50px;">' : 'No Image',
				$row->status,
				
				createButton('edit', $dataEdit, 'Ubah', 'far fa-edit') .
				createButton('delete', $dataHapus, 'Hapus', 'fas fa-trash')
			];
			$datatable['data'][] = $fields;
		}

		echo json_encode($datatable);
	}
	public function updateWartawan()
	{
		$id = $this->input->post('id');
		$data = [
			'name' => $this->input->post('name'),
			'position' => $this->input->post('position'),
			'office' => $this->input->post('office'),
			'age' => $this->input->post('age'),
			'start_date' => $this->input->post('start_date'),
			'salary' => $this->input->post('salary')
		];

		$this->db->where('id', $id);
		$result = $this->db->update('wartawan', $data);

		if ($result) {
			echo json_encode(['status' => 'success', 'message' => 'Data berhasil diperbarui']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Terjadi kesalahan saat memperbarui data']);
		}
	}
	
	public function getAdmins()
    {
        $postData = $this->input->post();
        $admins = $this->AdminModel->getFilteredAdmins($postData);

        $datatable = [
            'draw' => $postData['draw'] ?? 1,
            'recordsTotal' => $admins['totalRecords'],
            'recordsFiltered' => $admins['filteredRecords'],
            'data' => []
        ];

		$no = $this->input->post('start') + 1;
		foreach ($admins['data'] as $admin) {
			$datatable['data'][] = [
				'no' => $no++,
				'username' => htmlspecialchars($admin->username, ENT_QUOTES, 'UTF-8'),
				'role_name' => htmlspecialchars($admin->role_name, ENT_QUOTES, 'UTF-8'),
				'created_at' => htmlspecialchars($admin->created_at, ENT_QUOTES, 'UTF-8'),
				'updated_at' => htmlspecialchars($admin->updated_at ?? '-', ENT_QUOTES, 'UTF-8'),
				'actions' => '<button class="btn btn-warning btn-edit" data-id="' . $admin->id_admin . '">Edit</button>
							  <button class="btn btn-danger btn-delete" data-id="' . $admin->id_admin . '">Hapus</button>'
			];
		}

        echo json_encode($datatable);
    }
	

}
