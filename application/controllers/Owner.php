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
        $obj['roles'] = $this->RoleModel->getAll();
        $this->load->view('owner/master_role', $obj);
    }

    public function add_role()
    {
        $data = [
            'nama_role' => $this->input->post('nama_role'),
            'permissions' => json_encode($this->input->post('permissions')),
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        if ($this->RoleModel->insertRole($data)) {
            echo json_encode(['status' => 'success', 'message' => 'Role berhasil ditambahkan']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menambahkan role']);
        }
    }

    public function get_role()
    {
        $id = $this->input->post('id');
        $role = $this->RoleModel->findRoleById($id);
        if ($role) {
            $role->permissions = json_decode($role->permissions, true);
            echo json_encode(['status' => 'success', 'data' => $role]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Role tidak ditemukan']);
        }
    }

    public function update_role()
    {
        $id = $this->input->post('id');
        $data = [
            'nama_role' => $this->input->post('nama_role'),
            'permissions' => json_encode($this->input->post('permissions')),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        if ($this->RoleModel->updateRole($id, $data)) {
            echo json_encode(['status' => 'success', 'message' => 'Role berhasil diupdate']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal mengupdate role']);
        }
    }

    public function delete_role()
    {
        $id = $this->input->post('id');
        if ($this->RoleModel->deleteRole($id)) {
            echo json_encode(['status' => 'success', 'message' => 'Role berhasil dihapus']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus role']);
        }
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