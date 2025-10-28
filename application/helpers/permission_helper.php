<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('has_permission')) {
    function has_permission($permission)
    {
        $CI =& get_instance();
        
        // Owner always has all permissions
        if ($CI->session->userdata('user_type') === 'owner') {
            return true;
        }
        
        // Check admin permissions
        if ($CI->session->userdata('user_type') === 'admin') {
            $role_id = $CI->session->userdata('id_role');
            if ($role_id) {
                $CI->load->model('RoleModel');
                return $CI->RoleModel->hasPermission($role_id, $permission);
            }
        }
        
        return false;
    }
}

if (!function_exists('check_permission')) {
    function check_permission($permission)
    {
        if (!has_permission($permission)) {
            show_error('Access Denied', 403);
        }
    }
}