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

    public function get_kindness($id = NULL) {
        $this->db->select('*');
        $this->db->from('kindness');
        $this->db->join('images', 'image_id = kindness_img');
        if ($id != NULL) {
            $this->db->where('kindness_id', $id);
        }
        $rs = $this->db->get();
        $itemp = $rs->result_array();
        return $itemp;
    }

    public function insert_kindness($f_data) {
        $this->db->insert('kindness', $f_data);
    }

    public function update_kindness($id, $f_data) {
        $this->db->where('kindness_id', id);
        $this->db->update('kindness', $f_data);
    }

    public function delete_kindness($id) {
        //delete image
        $img_id = $this->get_image_id($id);
        $this->deleteImage($img_id);

        //delete slide
        $this->db->where('kindness_id', $id);
        $this->db->delete('kindness');

        //delete data in database
        $this->db->where('image_id', $img_id);
        $this->db->delete('images');
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
        );



        $f_publish_date = array(
            'name' => 'publish_date',
            'class' => 'form-control datepicker',
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
            'class' => 'form-control datepicker',
            'id' => 'publish_date',
            'placeholder' => '',
            'value' => (set_value('publish_date') == NULL) ? $data['publish_date'] : set_value('publish_date')
        );
        $f_highlight = array(
            '0' => 'ทั่วไป',
            '1' => 'เด่น',
        );
        $form_edit = array(
            'form' => form_open_multipart('Kindness_ad/edit/' . $data['kindness_id'], array('class' => 'form-horizontal', 'id' => 'form_kindness')),
            'kindness_title' => form_input($f_kindness_title),
            'kindness_content' => form_textarea($f_kindness_content),
            'kindness_img' => form_upload($f_img),
            //            ''=>  form_input($f_),   
            'kindness_highlight' => form_dropdown('kindness_highlight', $f_highlight, (set_value('kindness_highlight') == NULL) ? $data['kindness_highlight'] : set_value('kindness_highlight'), 'class="form-control"'),
            'publish_date' => form_input($f_publish_date),
            'image' => $data['image_small'],
        );

        return $form_edit;
    }

    public function validation_add() {
        $this->form_validation->set_rules('kindness_title', 'ชื่อเรื่อง', 'required|trim|xss_clean');
        $this->form_validation->set_rules('kindness_content', 'เนื้อหา', 'required|trim|xss_clean');
        $this->form_validation->set_rules('publish_date', 'วันเผยแพร่', 'required|trim|xss_clean');

        if (empty($_FILES['kindness_img']['name'])) {
            $this->form_validation->set_rules('kindness_img', 'รูปภาพ', 'required|xss_clean');
        }

        return TRUE;
    }

    public function validation_edit() {
        $this->form_validation->set_rules('kindness_title', 'ชื่อเรื่อง', 'required|trim|xss_clean');
        $this->form_validation->set_rules('kindness_content', 'เนื้อหา', 'required|trim|xss_clean');
        $this->form_validation->set_rules('publish_date', 'วันที่', 'required|trim|xss_clean');
        return TRUE;
    }

    public function get_post_form_add() {
        $d = new DateTime($this->input->post('publish_date'));
        $date = $d->format('Y-m-d');
        $this->load->model('m_upload');
        $img_id = $this->m_upload->upload_image('kindness', 'kindness_img');
        $page_data = array(
            'kindness_title' => $this->input->post('kindness_title'),
            'kindness_content' => $this->input->post('kindness_content'),
            'publish_date' => $date,
            'kindness_img' => $img_id,
            'kindness_highlight' => $this->input->post('kindness_highlight'),
            'create_date' => $this->getDatetimeNow(),
//            ''=>$this->input->post(''),
        );
        return $page_data;
    }

    public function get_post_form_edit($id) {

        $page_data = array(
            'kindness_title' => $this->input->post('kindness_title'),
            'kindness_content' => $this->input->post('kindness_content'),
            'kindness_status' => $this->input->post('kindness_status'),
            'kindness_highlight' => $this->input->post('kindness_highlight'),
            'update_date' => $this->getDatetimeNow(),
//            ''=>$this->input->post(''),
        );

        //img if not NULL
        if (!empty($_FILES['kindness_img']['name'])) {
            $this->load->model('m_upload');
            $this->m_upload->upload_image('kindness', 'kindness_img', $this->get_image_id($id));
        }

        return $page_data;
    }

    public function get_image_id($id) {
        $this->db->select('image_id');
        $this->db->from('kindness');
        $this->db->join('images', 'image_id = kindness_img');
        $this->db->where('kindness_id', $id);
        $query = $this->db->get();
        $row = $query->row_array();

        return $row['image_id'];
    }

    public function deleteImage($image_id) {
        $this->db->select('image_path,image_name');
        $this->db->from('images');
        $this->db->where('image_id', $image_id);
        $query = $this->db->get();
        $row = $query->row_array();

        unlink($row['image_path'] . $row['image_name']);
        unlink($row['image_path'] . 'thumbs/' . $row['image_name']);
    }

}
