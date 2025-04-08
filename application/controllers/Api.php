<?php
defined('BASEPATH') or exit('No direct script access allowed');
require 'vendor/autoload.php';

use Google\Client;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;

class Api extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('TokoModel');
		$this->load->model('OtpModel');
		$this->load->helper('jwt_helper');
		$this->load->helper('nodejs_helper');
		$this->load->model('TokenModel');
		$this->load->model('HargaModel');
		$this->load->model('SliderModel');
		$this->load->model('TradeModel');
		$this->load->model('SettingModel');
	}
	public function login()
	{
		$nomor_telpon = $this->input->post('nomor_telpon');

		if (!$nomor_telpon) {
			return
				$this->ResAPI([], false, "Nomor telepon diperlukan");
		}

		$toko = $this->TokoModel->get_by_nomor($nomor_telpon);
		if ($toko->deleted_at != null) {
			return
				$this->ResAPI([], false, "Toko Sudah Dihapus");
		}
		if (!$toko) {
			return
				$this->ResAPI([], false, "Data Tidak Ada");
		}

		// Cek OTP yang belum kedaluwarsa
		$existing_otp = $this->OtpModel->get_active_otp($toko->id_toko);
		$otp_code = null;

		if ($existing_otp && strtotime($existing_otp->expired_at) > time()) {
			// Jika OTP belum kedaluwarsa, gunakan kode OTP yang sama
			$otp_code = $existing_otp->kode_otp;
			$message = 'OTP masih berlaku, gunakan kode OTP yang sama';
		} else {
			// Jika OTP sudah kedaluwarsa atau tidak ada, buat OTP baru
			$otp_code = rand(100000, 999999);
			$expired_at = date('Y-m-d H:i:s', strtotime('+30 minutes'));

			if ($existing_otp) {
				// Perbarui OTP yang sudah ada
				$this->OtpModel->update($existing_otp->id, [
					'kode_otp' => $otp_code,
					'expired_at' => $expired_at,
				]);
			} else {
				// Tambahkan OTP baru
				$this->OtpModel->insert([
					'id_toko' => $toko->id_toko,
					'kode_otp' => $otp_code,
					'created_at' => date('Y-m-d H:i:s'),
					'expired_at' => $expired_at,
				]);
			}

			$message = 'OTP baru telah dibuat';
		}
		$this->ResAPI(
			[
				'kode_otp' => $otp_code,
			],
			true,
			$message
		);
	}
	public function verif_login_otp()
	{
		$nomor_telpon = $this->input->post('nomor_telpon');
		$otp_code = $this->input->post('kode_otp');

		if (!$nomor_telpon || !$otp_code) {
			return $this->ResAPI([], false, 'Data tidak lengkap');
		}

		$otp = $this->OtpModel->verify($nomor_telpon, $otp_code);

		if (!$otp || strtotime($otp->expired_at) < time()) {
			return $this->ResAPI([], false, 'OTP salah atau sudah expired');
		}

		$toko = $this->TokoModel->get_by_id($otp->id_toko);

		if ($toko->banned) {
			return $this->ResAPI([], false, 'Akun Anda telah diblokir');
		}
		$this->OtpModel->delete_by_id_toko($otp->id_toko, $otp_code);
		$access_token = generate_jwt(['id_toko' => $otp->id_toko]);
		$refresh_token = bin2hex(random_bytes(32));
		$refresh_expired_at = date('Y-m-d H:i:s', strtotime('+7 days'));

		// Simpan Refresh Token ke database
		$this->TokenModel->save_refresh_token($otp->id_toko, $refresh_token, $refresh_expired_at);

		return $this->ResAPI([
			'access_token' => $access_token,
			'refresh_token' => $refresh_token
		], true, 'Login berhasil');
	}
	public function profile()
	{
		$headers = $this->input->request_headers();
		if (!isset($headers['Authorization'])) {
			return $this->ResAPI([], false, "Unauthorized", 401);
		}
		$token = str_replace('Bearer ', '', $headers['Authorization']);
		$decoded = $this->validate_jwt($token);
		$id_mitra = $decoded->id_mitra; // ID mitra dari JWT

		$this->load->model('TokoModel');
		$toko = $this->TokoModel->get_by_id($decoded->id_toko);

		return $this->ResAPI([
			'id_toko' => $toko->id_toko,
			'id_mitra' => $toko->id_mitra,
			'nama_toko' => $toko->nama_toko,
			'nomor_telpon' => $toko->nomor_telpon
		], true, 'Data toko ditemukan');
	}
	public function logout()
	{
		$auth_header = $this->input->get_request_header('Authorization');
		$token = str_replace('Bearer ', '', $auth_header);
		$decoded = validate_jwt($token);
		if (!$decoded) {
			return $this->ResAPI([], false, 'Token tidak valid');
		}
		$this->load->model('TokenModel');
		$this->TokenModel->revoke_token($token);
		return $this->ResAPI([], true, 'Logout berhasil');
	}
	private function validate_request()
	{
		$auth_header = $this->input->get_request_header('Authorization');
		$token = str_replace('Bearer ', '', $auth_header);

		$decoded = validate_jwt($token);

		if (!$decoded) {
			return ['status' => false, 'message' => 'Token tidak valid'];
		}

		$this->load->model('TokoModel');
		$this->load->model('TokenModel');

		$toko = $this->TokoModel->get_by_id($decoded->id_toko);

		if (!$toko || $toko->banned) {
			return ['status' => false, 'message' => 'Akun Anda telah diblokir'];
		}

		if (!$this->TokenModel->is_token_valid($decoded->id_toko, $token)) {
			return ['status' => false, 'message' => 'Token telah dicabut'];
		}

		return ['status' => true, 'id_toko' => $decoded->id_toko];
	}
	public function refresh_token()
	{
		$refresh_token = $this->input->post('refresh_token');

		if (!$refresh_token) {
			return $this->ResAPI([], false, 'Refresh token diperlukan');
		}

		$this->load->model('TokenModel');

		$token_data = $this->TokenModel->get_refresh_token($refresh_token);

		if (!$token_data || $token_data->revoked || strtotime($token_data->expired_at) < time()) {
			return $this->ResAPI([], false, 'Refresh token tidak valid atau telah expired', 401);
		}

		// Generate Access Token baru
		$access_token = generate_jwt(['id_toko' => $token_data->id_toko]);

		return $this->ResAPI([
			'access_token' => $access_token
		], true, 'Access token berhasil diperbarui');
	}
	function send_notification()
	{
		// Baca JSON dari body
		$json = file_get_contents('php://input');
		$data = json_decode($json, true); // Decode JSON ke array PHP

		$this->send_fcm($data);
	}
	function getAccessToken()
	{

		$client = new Client();
		$client->setAuthConfig('path/to/service-account.json');
		$client->addScope('https://www.googleapis.com/auth/firebase.messaging');

		$accessToken = $client->fetchAccessTokenWithAssertion();
		echo 'Access Token: ' . $accessToken['access_token'];
	}
	public function login_by_google()
	{
		$client = new Google_Client();
		$client->setClientId($this->config->item('google_client_id'));
		$client->setClientSecret($this->config->item('google_client_secret'));
		$client->setRedirectUri($this->config->item('google_redirect_uri'));
		$client->addScope($this->config->item('google_scopes'));

		// Redirect ke Google OAuth
		redirect($client->createAuthUrl());
	}
	public function google_callback()
	{
		$client = new Google_Client();
		$client->setClientId($this->config->item('google_client_id'));
		$client->setClientSecret($this->config->item('google_client_secret'));
		$client->setRedirectUri($this->config->item('google_redirect_uri'));

		// Ambil authorization code dari URL
		$code = $this->input->get('code');
		if (!$code) {
			return $this->output
				->set_content_type('application/json')
				->set_output(json_encode([
					'status' => false,
					'message' => 'Authorization code not found.',
				]));
		}

		try {
			// Tukar authorization code dengan access token
			$token = $client->fetchAccessTokenWithAuthCode($code);

			// Ambil informasi user dari Google
			$client->setAccessToken($token);
			$google_service = new Google_Service_Oauth2($client);
			$google_user = $google_service->userinfo->get();

			// Email dari Google
			$email = $google_user->email;

			// Cek apakah email sudah ada di database
			$toko = $this->TokoModel->get_user_by_email($email);
			if ($toko) {
				// Login berhasil
				$this->session->set_userdata([
					'id_toko' => $toko->id_toko,
					'nama_toko' => $toko->nama_toko,
					'nomor_telpon' => $toko->nomor_telpon,
					'logged_in' => true,
				]);
				// Generate JWT dan Refresh Token
				$access_token = generate_jwt([
					'id_toko' => $toko->id_toko,
					'id_mitra' => $toko->id_mitra,
					'nama_toko' => $toko->nama_toko,
					'username' => $toko->username,
				]);
				$refresh_token = bin2hex(random_bytes(32));
				$refresh_expired_at = date('Y-m-d H:i:s', strtotime('+7 days'));

				// Simpan Refresh Token ke database
				$this->TokenModel->save_refresh_token($toko->id_toko, $refresh_token, $refresh_expired_at);

				return $this->ResAPI([
					'id_toko' => $toko->id_toko,
					'nama_toko' => $toko->nama_toko,
					'nomor_telpon' => $toko->nomor_telpon,
					'email' => $toko->email,
					'access_token' => $access_token,
					'refresh_token' => $refresh_token,
				], true, 'Login berhasil.');
			} else {
				// User tidak ditemukan
				return $this->output
					->set_content_type('application/json')
					->set_output(json_encode([
						'status' => false,
						'message' => 'Belum terdaftar, silahkan hubungi kepala toko.',
					]));
			}
		} catch (Exception $e) {
			return $this->output
				->set_content_type('application/json')
				->set_output(json_encode([
					'status' => false,
					'message' => 'Error during Google login: ' . $e->getMessage(),
				]));
		}
	}
	public function login_username()
	{
		$username = $this->input->post('username'); // Menggunakan username sebagai input utama
		$password_base64 = $this->input->post('password'); // Password dikirim dalam format Base64

		if (!$username || !$password_base64) {
			return $this->ResAPI([], false, "Username dan password diperlukan");
		}

		// Decode password dari Base64
		$password = base64_decode($password_base64);

		// Cari data pengguna berdasarkan username
		$user = $this->TokoModel->get_by_username_or_email($username, null);
		if (!$user) {
			return $this->ResAPI([], false, "Data Tidak Ada");
		}

		if ($user->deleted_at != null) {
			return $this->ResAPI([], false, "Akun telah dihapus");
		}
		// Validasi password (pastikan password disimpan dalam bentuk hash di database)
		if ($password != decrypt_password_toko($user->password)) {
			return $this->ResAPI([], false, "Password salah");
		}
		$access_token = generate_jwt([
			'id_toko' => $user->id_toko,
			'id_mitra' => $user->id_mitra,
			'nama_toko' => $user->nama_toko,
			'username' => $user->username,
		]);
		$refresh_token = bin2hex(random_bytes(32));
		$refresh_expired_at = date('Y-m-d H:i:s', strtotime('+7 days'));

		$this->db->where('id_toko', $user->id_toko);
		$this->db->update('toko', ['last_login' => date('Y-m-d H:i:s')]);
		// Simpan Refresh Token ke database
		$this->TokenModel->save_refresh_token($user->id_toko, $refresh_token, $refresh_expired_at);
		log_action(1, "toko", $user->id_toko,  'Login Username ' . $user->username);
		return $this->ResAPI([
			'access_token' => $access_token,
			'refresh_token' => $refresh_token
		], true, 'Login berhasil');
	}
	public function setting()
	{
		$settings = $this->SettingModel->getSettings();
		$data = array(
			'wa_admin' => $settings ? $settings->wa_admin : '',
			'link' => "https://wa.me/" . ($settings ? $settings->wa_admin : ''),
			'version_android' => $settings ? $settings->version_android : '',
			'version_ios' => $settings ? $settings->version_ios : '',
			'sliders' => $this->getSlidersData()
		);
		$this->ResAPI($data, true, "wa admin");
	}
	public function socket_url()
	{
		$socket_url = $this->config->item('socket_server_url');
		echo json_encode(['socket_url' => $socket_url]);
	}
	public function history()
	{
		$headers = $this->input->request_headers();
		if (!isset($headers['Authorization'])) {
			return $this->ResAPI([], false, "Authorization header is missing");
		}

		$token = str_replace('Bearer ', '', $headers['Authorization']);
		$decoded = $this->validate_jwt($token);

		if (!$decoded) {
			return $this->ResAPI([], false, "Invalid or expired token");
		}
		$id_toko = $decoded->id_toko;
		$status = $this->input->post('status');
		$history = $this->TradeModel->get_recent_transactions($id_toko, $status);
		return $this->ResAPI($history, true, "Data history ditemukan");
	}
}
