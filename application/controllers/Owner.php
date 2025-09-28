<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Owner extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('OwnerModel');
        $this->load->model('RoleModel');
        $this->load->model('AdminModel');
        $this->check_owner_login();
    }

    private function check_owner_login()
    {
        if (!$this->session->userdata('user_id') || $this->session->userdata('user_type') !== 'owner') {
            redirect('dashboard');
        }
    }

    public function index()
    {
        $obj['ci'] = $this;
        $obj['page'] = 'dashboard';
        $obj['pageTitle'] = 'Dashboard Owner';
        $this->load->view('owner/index', $obj);
    }

    public function master_role()
    {
        $obj['ci'] = $this;
        $obj['page'] = 'master_role';
        $obj['pageTitle'] = 'Master Role';
        $this->load->view('owner/master_role', $obj);
    }

    public function master_owner()
    {
        $obj['ci'] = $this;
        $obj['page'] = 'master_owner';
        $obj['pageTitle'] = 'Master Owner';
        $this->load->view('owner/master_owner', $obj);
    }

    public function master_admin()
    {
        $obj['ci'] = $this;
        $obj['page'] = 'master_admin';
        $obj['pageTitle'] = 'Master Admin';
        $this->load->view('owner/master_admin', $obj);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('dashboard');
    }
}