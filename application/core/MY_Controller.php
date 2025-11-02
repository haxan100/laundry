<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('security');
        $this->_sanitize_input();
    }
    
    private function _sanitize_input() {
        // Sanitize GET data
        if (!empty($_GET)) {
            foreach ($_GET as $key => $value) {
                $_GET[$key] = xss_clean($value);
            }
        }
        
        // Sanitize POST data
        if (!empty($_POST)) {
            foreach ($_POST as $key => $value) {
                $_POST[$key] = xss_clean($value);
            }
        }
    }
    
    protected function validate_csrf() {
        // CSRF validation disabled globally
        return true;
    }
}