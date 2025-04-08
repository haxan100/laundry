<?php
defined('BASEPATH') or exit('No direct script access allowed');

class OtpModel extends CI_Model
{
    public function insert($data)
    {
        $this->db->insert('otp', $data);
    }

    public function verify($nomor_telpon, $kode_otp)
    {
        $this->db->select('otp.*')
            ->from('otp')
            ->join('toko', 'otp.id_toko = toko.id_toko')
            ->where('toko.nomor_telpon', $nomor_telpon)
            ->where('otp.kode_otp', $kode_otp)
            ->limit(1);

        return $this->db->get()->row();
    }
	public function get_active_otp($id_toko)
	{
		$this->db->where('id_toko', $id_toko);
		$this->db->where('expired_at >', date('Y-m-d H:i:s'));
		$this->db->order_by('created_at', 'DESC');
		return $this->db->get('otp')->row();
	}
	public function update($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('otp', $data);
	}
	public function delete_by_id_toko($id_toko)
	{
		$this->db->where('id_toko', $id_toko);
		$this->db->delete('otp');
	}
}
