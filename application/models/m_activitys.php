<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class m_activitys extends CI_Model {

    public function set_form_add() {

        $f_activity_title = array(
            'name' => 'activity_title',
            'class' => 'form-control',
            'placeholder' => 'ชื่อเรื่อง',
            'value' => set_value('activity_title')
        );

        $f_activity_content = array(
            'name' => 'activity_content',
            'class' => 'form-control',
            'value' => set_value('activity_content')
        );
        $f_activity_type = array();
        $temp = $this->check_activity_type();
        $f_activity_type[0] = "เลือกประเภทกิจกรรม";
        foreach ($temp as $row) {
            $f_activity_type[$row['activity_type_id']] = $row['activity_type_name'];
        }
        $f_activity_img = array(
            'name' => 'activity_img',
            'class' => 'form-control'
        );
        $f_highlight = array(
            '0' => 'ทั่วไป',
            '1' => 'เด่น',
        );

        $f_status = array(
            '2' => 'ใช้งาน',
            '1' => 'ไม่ใช้งาน',
        );

        $form_add = array(
            'form' => form_open_multipart('Activity_ad/add', array('class' => 'form-horizontal', 'id' => 'form_slide')),
            'activity_title' => form_input($f_activity_title),
            'activity_content' => form_textarea($f_activity_content),
            'activity_type' => form_dropdown('activity_type', $f_activity_type, set_value('activity_type'), 'class="form-control"'),
            'activity_img' => form_upload($f_activity_img),
            'actity_status' => form_dropdown('actity_status', $f_status, set_value('actity_status'), 'class="form-control"'),
            'actity_highlight' => form_dropdown('actity_highlight', $f_highlight, set_value('actity_highlight'), 'class="form-control"'),
        );
        return $form_add;
    }

    function validation_add() {
        $this->form_validation->set_rules('journal_year_no', 'ปีที่', 'required|trim|xss_clean');
    }

    function validation_edit($id) {
        $this->form_validation->set_rules('journal_year_no', 'ปีที่', 'required|trim|xss_clean');
    }

    public function check_activity_type() {
        $query = $this->db->get('activity_types');
        return $query->result_array();
    }

}
