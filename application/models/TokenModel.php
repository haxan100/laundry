<?php
class TokenModel extends MY_Model
{
	public function save_token($id_toko, $token)
	{
		$data = [
			'id_toko' => $id_toko,
			'token' => password_hash($token, PASSWORD_BCRYPT),
			'revoked' => false
		];
		$this->db->insert('tokens', $data);
	}

	public function revoke_token($token)
	{
		$this->db->where('revoked', false);
		$tokens = $this->db->get('tokens')->result();

		foreach ($tokens as $row) {
			if (password_verify($token, $row->token)) {
				$this->db->where('id', $row->id);
				$this->db->update('tokens', ['revoked' => true]);
				return true;
			}
		}
		return false;
	}
	public function is_token_valid($user_id, $token)
	{
		$this->db->where('id_toko', $user_id);
		$this->db->where('revoked', false);
		$result = $this->db->get('tokens')->row();

		if ($result && password_verify($token, $result->token)) {
			return true;
		}
		return false;
	}
	public function save_refresh_token($id_toko, $refresh_token, $expired_at)
	{
		$data = [
			'id_toko' => $id_toko,
			'refresh_token' => password_hash($refresh_token, PASSWORD_BCRYPT),
			'revoked' => false,
			'expired_at' => $expired_at
		];
		$this->db->insert('refresh_tokens', $data);
	}

	public function get_refresh_token($refresh_token)
	{
		$this->db->where('revoked', false);
		$tokens = $this->db->get('refresh_tokens')->result();

		foreach ($tokens as $row) {
			if (password_verify($refresh_token, $row->refresh_token)) {
				return $row;
			}
		}
		return null;
	}
}
