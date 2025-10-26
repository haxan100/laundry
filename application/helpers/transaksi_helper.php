<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('get_customer_display')) {
    function get_customer_display($nama_customer, $customer_nama, $no_hp) {
        if ($customer_nama) {
            return $customer_nama . ($no_hp ? '<br><small class="text-muted">' . $no_hp . '</small>' : '');
        } elseif ($nama_customer) {
            return $nama_customer . ($no_hp ? '<br><small class="text-muted">' . $no_hp . '</small>' : '');
        }
        return 'Tamu';
    }
}

if (!function_exists('get_status_badge')) {
    function get_status_badge($status) {
        $badgeClass = 'secondary';
        if ($status === 'completed') $badgeClass = 'success';
        else if ($status === 'pending') $badgeClass = 'warning';
        else if ($status === 'cancelled') $badgeClass = 'danger';
        
        return '<span class="badge bg-' . $badgeClass . '">' . strtoupper($status) . '</span>';
    }
}

if (!function_exists('format_rupiah')) {
    function format_rupiah($amount) {
        return 'Rp ' . number_format($amount, 0, ',', '.');
    }
}

if (!function_exists('format_date')) {
    function format_date($date) {
        $formatted_date = date('d/m/Y', strtotime($date));
        $formatted_time = date('H:i', strtotime($date));
        return $formatted_date . '<br><small class="text-muted">' . $formatted_time . '</small>';
    }
}