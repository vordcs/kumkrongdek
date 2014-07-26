<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Class m_home extends CI_Model {

    public function get_slides($id = NULL) {
        $this->db->select('*');
        $this->db->from('slides');
        $this->db->join('images', 'image_id = slide_img');
        if ($id != NULL) {
            $this->db->where('slide_id', $id);
        }
        $this->db->where('slide_status', 'active');
        $rs = $this->db->get();
        $itemp = $rs->result_array();
        return $itemp;
    }

    public function get_highlight() {
        
    }
    
    public function get_news($id = NULL) {

        $this->db->select('*');
        $this->db->from('news');
        $this->db->order_by("publish_date", 'desc');

        $this->db->join('images', 'image_id = news_img');
        $this->db->where('news_status', 'active');
        if ($id != NULL) {
            $this->db->where('news_id', $id);
        }
        $rs = $this->db->get();
        $itemp = $rs->result_array();

        return $itemp;
    }    
    public function get_news_type($type_id = NULL) {
        $this->db->select('*');
        $this->db->from('news_types');
        $this->db->where('news_type_id !=', '1');
        $this->db->order_by('news_type_id');
        if ($type_id != NULL) {
            $this->db->where('news_type_id', $type_id);
        }
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_activitys($id = NULL) {
        $this->db->select('*');
        $this->db->from('activitys');
        $this->db->join('images', 'image_id = activity_img');
        $this->db->where('activity_status', 'active');
        if ($id != NULL) {
            $this->db->where('activity_id', $id);
        }
        $this->db->order_by('publish_date desc');
        $rs = $this->db->get();
        $itemp = $rs->result_array();
        return $itemp;
    }

    public function get_image_activity($activity_id = NULL) {
        $this->db->select();
        $this->db->from('activitys_has_images');
        $this->db->join('images', 'activitys_has_images.image_id = images.image_id', 'left');
        $this->db->where('activity_status', 'active');
        if ($activity_id != NULL) {
            $this->db->where('activity_id', $activity_id);
        }
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }

    public function get_activity_type($type_id = NULL) {

        $this->db->select('*');
        $this->db->from('activity_types');
        $this->db->order_by('activity_type_id');
        if ($type_id != NULL) {
            $this->db->where('activity_type_id', $type_id);
        }
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_kindness($id = NULL) {
        $this->db->select('*');
        $this->db->from('kindness');
        $this->db->join('images', 'image_id = kindness_img');
        $this->db->where('kindness_status', 'active');
        if ($id != NULL) {
            $this->db->where('kindness_id', $id);
        }
        $this->db->order_by("publish_date desc,create_date desc");
        $rs = $this->db->get();
        $itemp = $rs->result_array();
        return $itemp;
    }

}
