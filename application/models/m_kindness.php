<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class m_kindness extends CI_Model {

    function getDatetimeNow() {
        return date('Y-m-d H:i:s');
    }

    function getDateToday() {
        return date('Y-m-d');
    }

    function set_form_add() {
        $f_kindness_title = array(
            'name' => 'kindness_title',
            'class' => 'form-control',
            'placeholder' => '',
            'value' => set_value('kindness_title')
        );
        $f_kindness_content = array(
            'name' => 'kindness_content',
            'id' => 'content',
            'class' => 'form-control',
            'value' => set_value('kindness_content')
        );
        $f_img = array(
            'name' => 'kindness_img',
//            'class' => 'form-control',
            'value' => set_value('kindness_img')
        );


        $f_publish_date = array(
            'name' => '',
            'class' => 'form-control',
            'id' => 'publish_date',
            'placeholder' => '',
            'value' => set_value('publish_date')
        );
//         $f_ = array(
//            'name' => '',
//            'class' => 'form-control',
//            'placeholder' => '',
//            'value' => set_value('')
//        );

        $f_highlight = array(
            '0' => 'ทั่วไป',
            '1' => 'เด่น',
        );

        $f_status = array(
            '2' => 'ใช้งาน',
            '1' => 'ไม่ใช้งาน',
        );

        $form_add = array(
            'form' => form_open_multipart('Kindness_ad/add', array('class' => 'form-horizontal', 'id' => 'form_kindness')),
            'kindness_title' => form_input($f_kindness_title),
            'kindness_content' => form_textarea($f_kindness_content),
            'kindness_img' => form_upload($f_img),
            //            ''=>  form_input($f_),          
            'kindness_status' => form_dropdown('kindness_status', $f_status, set_value('kindness_status'), 'class="form-control"'),
            'kindness_highlight' => form_dropdown('kindness_highlight', $f_highlight, set_value('kindness_highlight'), 'class="form-control"'),
            'publish_date' => form_input($f_publish_date),
            'image' => NULL,
        );

        return $form_add;
    }

    function set_form_edit($data) {
        $f_kindness_title = array(
            'name' => 'kindness_title',
            'class' => 'form-control',
            'placeholder' => '',
            'value' => (set_value('kindness_title') == NULL) ? $data['kindness_title'] : set_value('kindness_title')
        );
        $f_kindness_content = array(
            'name' => 'kindness_content',
            'id' => 'content',
            'class' => 'form-control',
            'value' => (set_value('kindness_content') == NULL) ? $data['kindness_content'] : set_value('kindness_content')
        );
        $f_img = array(
            'name' => 'kindness_img',
//            'class' => 'form-control',
            'value' => (set_value('kindness_img') == NULL) ? $data['kindness_img'] : set_value('kindness_img')
        );


        $f_publish_date = array(
            'name' => 'publish_date',
            'class' => 'form-control',
            'id' => 'publish_date',
            'placeholder' => '',
            'value' => (set_value('publish_date') == NULL) ? $data['publish_date'] : set_value('publish_date')
        );
        $f_highlight = array(
            '0' => 'ทั่วไป',
            '1' => 'เด่น',
        );

        $f_status = array(
            '2' => 'ใช้งาน',
            '1' => 'ไม่ใช้งาน',
        );

        $form_edit = array(
            'form' => form_open_multipart('Kindness_ad/edit' .$data['kindness_id'], array('class' => 'form-horizontal', 'id' => 'form_kindness')),
            'kindness_title' => form_input($f_kindness_title),
            'kindness_content' => form_textarea($f_kindness_content),
            'kindness_img' => form_upload($f_img),
            //            ''=>  form_input($f_),          
            'kindness_status' => form_dropdown('kindness_status', $f_status, (set_value('kindness_status') == NULL) ? $data['kindness_status'] : set_value('kindness_status'), 'class="form-control"'),
            'kindness_highlight' => form_dropdown('kindness_highlight', $f_highlight, (set_value('kindness_highlight')== NULL) ? $data['kindness_highlight'] : set_value('kindness_highlight'), 'class="form-control"'),
            'publish_date' => form_input($f_publish_date),
            'image' => NULL,
        );

        return $form_add;
    }

    public function validation_add() {
        $this->form_validation->set_rules('kindness_title', 'ชื่อเรื่อง', 'required|trim|xss_clean');
        $this->form_validation->set_rules('kindness_content', 'เนื้อหา', 'required|trim|xss_clean');
        if (empty($_FILES['kindness_imge']['name'])) {
            $this->form_validation->set_rules('kindness_img', 'รูปภาพ', 'required|xss_clean');
        }
        $this->form_validation->set_rules('publish_date', 'วันที่', 'required|trim|xss_clean');
        return TRUE;
    }

    public function validation_edit() {
        $this->form_validation->set_rules('kindness_title', 'ชื่อเรื่อง', 'required|trim|xss_clean');
        $this->form_validation->set_rules('kindness_content', 'เนื้อหา', 'required|trim|xss_clean');
        $this->form_validation->set_rules('publish_date', 'วันที่', 'required|trim|xss_clean');
        return TRUE;
    }

    public function get_post_form_add() {
        $page_data = array(
            'kindness_title'=>$this->input->post('kindness_title'),
            'kindness_content'=>$this->input->post('kindness_content'),
            'kindness_status'=>$this->input->post('kindness_status'),
            'kindness_highlight'=>$this->input->post('kindness_highlight'),
//            ''=>$this->input->post(''),
        );
        return $page_data;
    }
        public function get_post_form_edit($id) {
        $page_data = array(
            'kindness_title'=>$this->input->post('kindness_title'),
            'kindness_content'=>$this->input->post('kindness_content'),
            'kindness_status'=>$this->input->post('kindness_status'),
            'kindness_highlight'=>$this->input->post('kindness_highlight'),
            
//            ''=>$this->input->post(''),
        );
        return $page_data;
    }

}
