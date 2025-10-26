<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
	}

	public function index()
	{
		// Cek apakah user sudah login
		if ($this->session->userdata('user_type')) {
			// Redirect ke dashboard sesuai role
			$user_type = $this->session->userdata('user_type');
			if ($user_type == 'owner') {
				redirect('owner');
			} elseif ($user_type == 'admin') {
				$id_role = $this->session->userdata('id_role');
				if ($id_role == 3) {
					redirect('kasir');
				} else {
					redirect('admin');
				}
			}
		} else {
			// Belum login, redirect ke halaman login
			redirect('dashboard');
		}
	}
}