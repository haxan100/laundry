<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
class SliderModel extends CI_Model {

    public function getAllSliders() {
        return $this->db->get('sliders')->result();
    }

    public function addSlider($data) {
        return $this->db->insert('sliders', $data);
    }

    public function deleteSlider($id) {
        $this->db->where('id', $id);
        return $this->db->delete('sliders');
    }
	public function getSliderById($id) {
        return $this->db->get_where('sliders', ['id' => $id])->row();
    }
    public function updateSlider($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('sliders', $data);
    }
}

?>
