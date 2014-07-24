<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Class m_home extends CI_Model {

    function get_slides() {
        $this->db->select('*');
        $this->db->from('slides');
        $this->db->join('images', 'image_id = slide_img');
//        $this->db->where('slide_status', $status);
        $this->db->order_by("create_date", "asc");
        $rs = $this->db->get();
        $itemp = $rs->result_array();
        return $itemp;
    }

}
