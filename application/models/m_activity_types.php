<?php

Class m_activity_types extends CI_Model {

    public function get_activity_type($id = NULL) {
        $this->db->select();
        $this->db->from('activity_types');
        if ($id != NULL) {
            $this->db->where('activity_type_id != 0');
        }
        $query = $this->db->get();
        return $query->result_array();
    }

}
