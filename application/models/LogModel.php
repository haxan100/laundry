<?php
class LogModel extends MY_Model
{
    protected $table = 'logs';
    protected $primaryKey = 'id_log';

    public function logAction($idKategoriLog, $jenisUser, $idUser, $message)
    {
        $data = [
            'id_kategori_log' => $idKategoriLog,
            'jenis_user' => $jenisUser,
            'id_user' => $idUser ? $idUser : 1,
            'log_message' => $message,
            'created_at' => date('Y-m-d H:i:s')
        ];
        $this->create($data);
    }

    public function getLogs($limit = null, $offset = null)
    {
        return $this->paginate($limit, $offset, [], 'created_at DESC');
    }

	public function getFilteredLogs($startDate = null, $endDate = null, $category = null,$year,$date)
	{
		// var_dump($year,$date);die;
		$this->db->select('logs.*, admin.username as admin_name, kategori_logs.nama_kategori_log');
		$this->db->from($this->table);
		$this->db->join('admin', 'admin.id_admin = logs.id_user', 'left');
		$this->db->join('kategori_logs', 'kategori_logs.id_kategori_log = logs.id_kategori_log', 'left');
		$currentMonth = date('m'); // Menentukan bulan saat ini

		$currentYear = isset($year) && $year != '' ? $year : date('Y');
		if (isset($date) && $date != '') {
			$date = explode(' / ', $date);
			if (count($date) == 1) {
				// Jika hanya satu tanggal
				$singleDate = date('Y-m-d', strtotime($year . "-" . $date[0])); // Format tanggal ke Y-m-d
				$this->db->where('DATE(logs.created_at)', $singleDate);
			} else {
				// Jika rentang tanggal
				$this->db->where('DATE(logs.created_at) >=', $date[0]);
				$this->db->where('DATE(logs.created_at) <=', $date[1]);
			}
		} else {
			// Jika tidak ada filter tanggal, gunakan tahun saat ini
			$startDate = "{$currentYear}-{$currentMonth}-01";
			$endDate = date('Y-m-d');
			$this->db->where('DATE(logs.created_at) >=', $startDate);
			$this->db->where('DATE(logs.created_at) <=', $endDate);
		}
	
		// Filter berdasarkan kategori log
		if (!empty($category)) {
			$this->db->where('logs.id_kategori_log', $category); // Perbaikan di sini
		}
	
		$this->db->order_by('logs.created_at', 'DESC');
	
		// Pagination
		$length = $this->input->post('length') ?? 10;
		$start = $this->input->post('start') ?? 0;
		$this->db->limit($length, $start);
	
		// Total records
		$totalRecords = $this->db->count_all_results('', false);
	
		// Execute query
		$query = $this->db->get();
		$data = $query->result();
		// Filtered records
		$filteredRecords = $query->num_rows();
	
		return [
			'totalRecords' => $totalRecords,
			'filteredRecords' => $filteredRecords,
			'data' => $data
		];
	}
	

    public function getCategories()
    {
        return $this->db->get('kategori_logs')->result();
    }
}
