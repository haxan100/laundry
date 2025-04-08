<?php 
class SettingModel extends CI_Model {
    public function getSettings() {
        return $this->db->get('settings')->row();
    }

    public function updateSettings($data) {
        return $this->db->update('settings', $data);
    }
}
