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
        $obj['owners'] = $this->OwnerModel->getAll();
        $this->load->view('owner/master_owner', $obj);
    }

    public function add_owner()
    {
        $data = [
            'username' => $this->input->post('username'),
            'password' => md5($this->input->post('password')),
            'nama_lengkap' => $this->input->post('nama_lengkap'),
            'email' => $this->input->post('email'),
            'telepon' => $this->input->post('telepon'),
            'alamat' => $this->input->post('alamat'),
            'status' => $this->input->post('status'),
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        // Check if username already exists
        if ($this->OwnerModel->findOwner($data['username'])) {
            echo json_encode(['status' => 'error', 'message' => 'Username sudah digunakan']);
            return;
        }
        
        if ($this->OwnerModel->insert($data)) {
            echo json_encode(['status' => 'success', 'message' => 'Owner berhasil ditambahkan']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menambahkan owner']);
        }
    }

    public function get_owner()
    {
        $id = $this->input->post('id');
        $owner = $this->OwnerModel->getById($id);
        if ($owner) {
            echo json_encode(['status' => 'success', 'data' => $owner]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Owner tidak ditemukan']);
        }
    }

    public function update_owner()
    {
        $id = $this->input->post('id');
        $data = [
            'username' => $this->input->post('username'),
            'nama_lengkap' => $this->input->post('nama_lengkap'),
            'email' => $this->input->post('email'),
            'telepon' => $this->input->post('telepon'),
            'alamat' => $this->input->post('alamat'),
            'status' => $this->input->post('status'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        // Check if username already exists (exclude current record)
        $existing = $this->OwnerModel->findOwner($data['username']);
        if ($existing && $existing->id_owner != $id) {
            echo json_encode(['status' => 'error', 'message' => 'Username sudah digunakan']);
            return;
        }
        
        // Add password if provided
        $password = $this->input->post('password');
        if (!empty($password)) {
            $data['password'] = md5($password);
        }
        
        if ($this->OwnerModel->update($id, $data)) {
            echo json_encode(['status' => 'success', 'message' => 'Owner berhasil diupdate']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal mengupdate owner']);
        }
    }

    public function delete_owner()
    {
        $id = $this->input->post('id');
        
        // Prevent deleting current logged in owner
        if ($id == $this->session->userdata('user_id')) {
            echo json_encode(['status' => 'error', 'message' => 'Tidak dapat menghapus akun yang sedang login']);
            return;
        }
        
        if ($this->OwnerModel->delete($id)) {
            echo json_encode(['status' => 'success', 'message' => 'Owner berhasil dihapus']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus owner']);
        }
    }

    public function master_admin()
    {
        $obj['ci'] = $this;
        $obj['page'] = 'master_admin';
        $obj['pageTitle'] = 'Master Admin';
        $this->load->view('owner/master_admin', $obj);
    }

    public function get_roles_ajax()
    {
        $roles = $this->RoleModel->getAll();
        echo json_encode($roles);
    }

    public function get_owners_ajax()
    {
        $owners = $this->OwnerModel->getAll();
        echo json_encode($owners);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('dashboard');
    }
}