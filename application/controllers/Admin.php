<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->helper('encryption');
		$this->load->helper('permission');
		check_login();
		
		$this->load->model('RoleModel');
		$this->load->model('AdminModel');
		$this->load->model('HargaModel','harga');
		$this->load->model('TokoModel');
		$this->load->model('SettingModel');
		$this->load->model('DashboardModel');
	}
	public function index()
	{
		$obj['ci'] = $this;
		$obj['page'] = 'dashboard';
		$obj['pageTitle'] = 'Dashboard';
		$obj['totalCustomers'] = $this->DashboardModel->getTotalCustomers();
		$obj['totalOrdersThisMonth'] = $this->DashboardModel->getTotalOrdersThisMonth();
		$obj['pendingOrders'] = $this->DashboardModel->getPendingOrders();
		$this->load->view('admin/index', $obj);
	}

	public function logout()
	{
		$this->session->unset_userdata(['user_id', 'username', 'user_type', 'nama_lengkap', 'id_role', 'permissions']);
		$this->session->sess_destroy();
		redirect('dashboard');
	}
}