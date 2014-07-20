<?php

Class m_activity_types extends CI_Model {

    public function get_activity_type() {
        $query = $this->db->get('activity_types');
        return $query->result_array();
    }

}
