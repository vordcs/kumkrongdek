<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class m_slides extends CI_Model {

    function getDatetimeNow() {
        return date('Y-m-d H:i:s');
    }

//view mode
    function get_slides($id = NULL) {
        $this->db->select('*');
        $this->db->from('slides');
        $this->db->join('images', 'image_id = slide_img');
        if ($id != NULL) {
            $this->db->where('slide_id', $id);
        }
        $rs = $this->db->get();
        $itemp = $rs->result_array();
        return $itemp;
    }

    function get_slides_by_status($status) {        
        $this->db->select('*');
        $this->db->from('slides');
        $this->db->join('images', 'image_id = slide_img');
        $this->db->where('slide_status', $status);
        $this->db->order_by("create_date", "asc");
        $rs = $this->db->get();
        $itemp = $rs->result_array();
        return $itemp;
    }

//    end view mode

    public function insert_slide($f_data) {
        $this->db->insert('slides', $f_data);
    }

    public function update_slide($slide_id, $f_data) {
        $this->db->where('slide_id', $slide_id);
        $this->db->update('slides', $f_data);
    }

    public function delete_slide($slide_id) {

        //delete image
        $img_id = $this->get_image_id($slide_id);
        $this->deleteImage($img_id);

        //delete slide
        $this->db->where('slide_id', $slide_id);
        $this->db->delete('slides');

        //delete data in images
        $this->db->where('image_id', $img_id);
        $this->db->delete('images');
    }

    function set_form_add() {
        $f_title = array(
            'name' => 'slide_title',
            'class' => 'form-control',
            'placeholder' => 'ชื่อเรื่อง',
            'value' => set_value('slide_title')
        );

        $f_sub_title = array(
            'name' => 'slide_subtitle',
            'class' => 'form-control',
            'placeholder' => 'ชื่อเรื่องรอง',
            'value' => set_value('slide_subtitle'));

        $f_link = array(
            'name' => 'slide_link',
            'class' => 'form-control',
            'placeholder' => 'ลิ้งค์',
            'value' => set_value('link_url'));

        $f_img = array(
            'name' => 'slide_img',
//            'class' => 'form-control'
        );

        $f_status = array(
            '2' => 'ใช้งาน',
            '1' => 'ไม่ใช้งาน',
        );

        $form_add = array(
            'form' => form_open_multipart('Slides/add', array('class' => 'form-horizontal', 'id' => 'form_slide')),
            'slide_title' => form_input($f_title),
            'slide_subtitle' => form_input($f_sub_title),
            'slide_link' => form_input($f_link),
            'slide_img' => form_upload($f_img),
            'slide_status' => form_dropdown('slide_status', $f_status, set_value('slide_status'), 'class="form-control"'),
            'image' => NULL,
        );
        return $form_add;
    }

    function set_form_edit($data) {

        $f_title = array(
            'name' => 'slide_title',
            'class' => 'form-control',
            'placeholder' => 'ชื่อเรื่อง',
            'value' => (set_value('slide_title') == NULL) ? $data ['slide_title'] : set_value('slide_title'));

        $f_sub_title = array(
            'name' => 'slide_subtitle',
            'class' => 'form-control',
            'placeholder' => 'ชื่อเรื่องรอง',
            'value' => (set_value('slide_subtitle') == NULL) ? $data ['slide_subtitle'] : set_value('slide_subtitle'));


        $f_link = array(
            'name' => 'slide_link',
            'class' => 'form-control',
            'placeholder' => 'ลิ้งค์',
            'value' => (set_value('link_url') == NULL) ? $data ['slide_link'] : set_value('slide_link'));

        $f_img = array(
            'name' => 'slide_img',
//            'class' => 'form-control'
            );
        $f_status = array(
            '2' => 'ใช้งาน',
            '1' => 'ไม่ใช้งาน',
        );
        $form_edit = array(
            'form' => form_open_multipart('Slides/edit/' . $data['slide_id'], array('class' => 'form-horizontal', 'id' => 'form_slide')),
            'slide_title' => form_input($f_title),
            'slide_subtitle' => form_input($f_sub_title),
            'slide_link' => form_input($f_link),
            'slide_img' => form_upload($f_img),
            'slide_status' => form_dropdown('slide_status', $f_status, (set_value('slide_status') == NULL) ? $data ['slide_status'] : set_value('slide_status'), 'class="form-control"'),
            'image' => img($data ['image_small'], array('class' => 'img-responsive thumbnail', 'width' => '200px', 'height' => '200px')),
        );
        //Unset img if NULL        
        if ($form_edit['slide_img'] == NULL)
            unset($form_edit['slide_img']);

        return $form_edit;
    }

    function validation_add() {
        $this->form_validation->set_rules('slide_title', 'ชื่อเรื่อง', 'trim|xss_clean');
        $this->form_validation->set_rules('slide_subtitle', 'ชื่อเรื่องรอง', 'trim|xss_clean');
        $this->form_validation->set_rules('slide_link', 'ลิ้งค์', 'trim|xss_clean');
        if (empty($_FILES['slide_img']['name'])) {
            $this->form_validation->set_rules('img_slide', 'รูปภาพ', 'required|xss_clean');
        }

        return TRUE;
    }

    function validation_edit() {
        $this->form_validation->set_rules('slide_title', 'ชื่อเรื่อง', 'trim|xss_clean');
        $this->form_validation->set_rules('slide_subtitle', 'ชื่อเรื่องรอง', 'trim|xss_clean');
        $this->form_validation->set_rules('slide_link', 'ลิ้งค์', 'trim|xss_clean');
        return TRUE;
    }

    function get_post_form_add() {

        $get_page_data = array(
            'slide_title' => $this->input->post('slide_title'),
            'slide_subtitle' => $this->input->post('slide_subtitle'),
            'slide_link' => $this->input->post('slide_link'),
            'slide_img' => $this->upload_image('slide_img'),
            'slide_status' => $this->input->post('slide_status'),
            'create_date' => $this->getDatetimeNow(),
        );

        return $get_page_data;
    }

    function get_post_form_edit($slide_id) {
        $get_page_data = array(
            'slide_title' => $this->input->post('slide_title'),
            'slide_subtitle' => $this->input->post('slide_subtitle'),
            'slide_link' => $this->input->post('slide_link'),
            'slide_status' => $this->input->post('slide_status'),
            'update_date' => $this->getDatetimeNow(),
        );
        //img_slide if not NULL
        if (!empty($_FILES['slide_img']['name'])) {
            $this->upload_image('slide_img', $this->get_image_id($slide_id));
        }
        return $get_page_data;
    }

    function get_image($id) {
        $this->db->select('images.image_full');
        $this->db->from('slides');
        $this->db->join('images', 'image_id = slide_img');
        $this->db->where('slide_id', $id);
        $query = $this->db->get();
        $row = $query->row_array();

        return $row['img_full'];
    }

    function get_image_id($slide_id) {
        $this->db->select('image_id');
        $this->db->from('slides');
        $this->db->join('images', 'image_id = slide_img');
        $this->db->where('slide_id', $slide_id);
        $query = $this->db->get();
        $row = $query->row_array();

        return $row['image_id'];
    }

    function upload_image($name, $id = NULL) {

        if (!empty($_FILES[$name]['name'])) {

            $config['upload_path'] = "assets/img/slides";
            $config['allowed_types'] = "gif|jpg|jpeg|png";
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = "5000";
            $config['max_width'] = "2920";
            $config['max_height'] = "2080";

            $this->load->library('upload', $config);


            if (!$this->upload->do_upload($name)) {
                return $this->upload->display_errors();
            } else {
                //insert to database
                $finfo = $this->upload->data();

                // to re-size for thumbnail images un-comment and set path here and in json array
                $config2 = array();
                $config2['image_library'] = 'gd2';
                $config2['source_image'] = $finfo['full_path'];
                $config2['create_thumb'] = TRUE;
                $config2['new_image'] = 'assets/img/slides/thumbs/' . $finfo['file_name'];
                $config2['maintain_ratio'] = TRUE;
                $config2['thumb_marker'] = '';
                $config2['width'] = 1;
                $config2['height'] = 450;
                $config2['maintain_ratio'] = TRUE;
                $config2['master_dim'] = 'height';
                $this->load->library('image_lib', $config2);
                $this->image_lib->resize();

                $data_img = array(
                    'image_name' => $finfo['file_name'],
                    'image_full' => 'slides/' . $finfo['file_name'],
                    'image_small' => 'slides/thumbs/' . $finfo['file_name'],
                    'image_path' => $finfo['file_path'],
                );
//                unlink($finfo['full_path']);
                if ($id == NULL) {
                    $this->db->trans_start();
                    $this->db->insert('images', $data_img);
                    $image_id = $this->db->insert_id();
                    $this->db->trans_complete();
                    return $image_id;
                } else {
                    $this->deleteImage($id);
                    $this->db->where('image_id', $id);
                    $this->db->update('images', $data_img);
                    return $id;
                }
            }
        }
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
