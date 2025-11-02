<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('xss_clean')) {
    function xss_clean($data) {
        $CI =& get_instance();
        
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $data[$key] = xss_clean($value);
            }
        } else {
            // Remove script tags
            $data = preg_replace('/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/mi', '', $data);
            
            // Remove javascript: protocol
            $data = preg_replace('/javascript:/i', '', $data);
            
            // Remove on* event handlers
            $data = preg_replace('/\s*on\w+\s*=\s*["\'][^"\']*["\']/i', '', $data);
            
            // HTML encode special characters
            $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
        }
        
        return $data;
    }
}

if (!function_exists('validate_input')) {
    function validate_input($input, $type = 'string') {
        $input = trim($input);
        
        switch ($type) {
            case 'email':
                return filter_var($input, FILTER_VALIDATE_EMAIL) ? xss_clean($input) : false;
            case 'phone':
                return preg_match('/^[0-9+\-\s()]+$/', $input) ? xss_clean($input) : false;
            case 'numeric':
                return is_numeric($input) ? (float)$input : false;
            case 'alphanumeric':
                return preg_match('/^[a-zA-Z0-9\s]+$/', $input) ? xss_clean($input) : false;
            default:
                return xss_clean($input);
        }
    }
}

if (!function_exists('csrf_token')) {
    function csrf_token() {
        $CI =& get_instance();
        return $CI->security->get_csrf_hash();
    }
}