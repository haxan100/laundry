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

if (!function_exists('check_access_sidebar')) {
    function check_access_sidebar($permission)
    {
        $CI =& get_instance();
        
        // Owner always has all permissions
        if ($CI->session->userdata('user_type') === 'owner') {
            return true;
        }
        
        // Check admin permissions from session
        if ($CI->session->userdata('user_type') === 'admin') {
            $permissions = $CI->session->userdata('permissions');
            if (is_array($permissions)) {
                return in_array($permission, $permissions);
            }
        }
        
        return false;
    }
}

if (!function_exists('check_access')) {
    function check_access($permission)
    {
        if (!check_access_sidebar($permission)) {
            show_error('Access Denied - You do not have permission to access this page', 403);
        }
    }
}