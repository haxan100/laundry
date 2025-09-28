<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('AdminModel');
        $this->load->model('OwnerModel');
    }

    public function index()
    {
        $data['title'] = $this->config->item('title');
        $this->load->view('dashboard/login_dashboard', $data);
    }

    public function login_owner()
    {
        $data['title'] = $this->config->item('title');
        $this->load->view('dashboard/login_owner', $data);
    }

    public function login_admin()
    {
        $data['title'] = $this->config->item('title');
        $this->load->view('dashboard/login_admin', $data);
    }

    public function process_login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $role = $this->input->post('role');

        if ($role === 'owner') {
            $user = $this->OwnerModel->findOwner($username);
            // var_dump($user);die;
            if ($user && md5($password) === $user->password) {
                $this->session->set_userdata([
                    'user_id' => $user->id_owner,
                    'username' => $user->username,
                    'user_type' => 'owner',
                    'nama_lengkap' => $user->nama_lengkap
                ]);
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Login berhasil!',
                    'redirect' => base_url() . "owner"
                ]);
                return;
            }
        } else {
            $user = $this->AdminModel->findAdmin($username);
            if ($user && decrypt_password($user->password) === $password) {
                $this->session->set_userdata([
                    'user_id' => $user->id_admin,
                    'username' => $user->username,
                    'id_role' => $user->id_role,
                    'user_type' => 'admin',
                    'nama_lengkap' => $user->nama_lengkap
                ]);
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Login berhasil!',
                    'redirect' => base_url() . "admin"
                ]);
                return;
            }
        }

        echo json_encode([
            'status' => 'error',
            'message' => 'Username atau password salah!'
        ]);
    }
}