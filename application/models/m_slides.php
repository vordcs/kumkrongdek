<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class m_slides extends CI_Model {

    public $slide_id = '';

    function getDatetimeNow() {
        return date('Y-m-d H:i:s');
    }

    function set_id($id) {
        $this->slide_id = $id;
    }

    public function insert_slide($f_data) {
        $this->db->insert('slides', $f_data);
    }

    public function update_slide($f_data) {
        $this->db->where('id', $this->slide_id);
        $this->db->update('slides', $f_data);
    }

    public function delete_slide($slide_id) {

        //delete image
        $img_id = $this->get_image_id($slide_id);
        $this->deleteImage($img_id);

        //delete slide
        $this->db->where('id', $slide_id);
        $this->db->delete('slides');

        //delete data in images
        $this->db->where('id', $img_id);
        $this->db->delete('images');
    }

    function get_slides($id = NULL) {
        $this->db->select('*');
        $this->db->from('slides');
        $this->db->join('images', 'image_id = slide_img');
        if ($id != NULL) {
            $this->db->where('slide_id', $id);
            $rs = $this->db->get();
            $itemp = $rs->row_array();
        } else {
            $rs = $this->db->get();
            $itemp = $rs->result_array();
        }

        return $itemp;
    }

    function set_form_add() {
        $f_title = array(
            'name' => 'slide_title',
            'class' => 'form-control',
            'placeholder' => 'ชื่อเรื่อง',
            'value' => set_value('slide_title'));

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
            'class' => 'form-control');

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

    function validation_add() {
        $this->form_validation->set_rules('slide_title', 'ชื่อเรื่อง', 'trim|xss_clean');
        $this->form_validation->set_rules('slide_subtitle', 'ชื่อเรื่องรอง', 'trim|xss_clean');
        $this->form_validation->set_rules('slide_link', 'ลิ้งค์', 'trim|xss_clean');
        if (empty($_FILES['slide_img']['name'])) {
            $this->form_validation->set_rules('img_slide', 'รูปภาพ', 'required|xss_clean');
        }

        return TRUE;
    }

//
//    function validation_edit() {
//        $this->form_validation->set_rules('title[thai]', 'ชื่อเรื่อง', 'trim|xss_clean');
//        $this->form_validation->set_rules('subtitle[thai]', 'ชื่อเรื่องรอง', 'trim|xss_clean');
//        $this->form_validation->set_rules('title[english]', 'Title', 'trim|xss_clean');
//        $this->form_validation->set_rules('subtitle[english]', 'subtitle', 'trim|xss_clean');
//        $this->form_validation->set_rules('link_url', 'ลิ้งค์', 'trim|xss_clean');
//        return TRUE;
//    }
//    function set_form_edit($data) {
//        $f_title_th = array(
//            'name' => 'title[thai]',
//            'class' => 'form-control',
//            'placeholder' => 'ชื่อเรื่อง',
//            'value' => (set_value('title[thai]') == NULL) ? unserialize($data ['title'])['thai'] : set_value('[thai]'));
//        $f_title_en = array(
//            'name' => 'title[english]',
//            'class' => 'form-control',
//            'placeholder' => 'Title',
//            'value' => (set_value('title[english]') == NULL) ? unserialize($data ['title'])['english'] : set_value('title[english]'));
//
//        $f_sub_title_th = array(
//            'name' => 'subtitle[thai]',
//            'class' => 'form-control',
//            'placeholder' => 'ชื่อเรื่องรอง',
//            'value' => ( set_value('subtitle[thai]') == NULL) ? unserialize($data ['subtitle'])['thai'] : set_value('subtitle[thai]'));
//
//        $f_sub_title_en = array(
//            'name' => 'subtitle[english]',
//            'class' => 'form-control',
//            'placeholder' => 'Sub Title',
//            'value' => (set_value('subtitle[english]') == NULL) ? unserialize($data ['subtitle'])['english'] : set_value('subtitle[english]'));
//
//        $f_link = array(
//            'name' => 'link_url',
//            'class' => 'form-control',
//            'placeholder' => 'ลิ้งค์',
//            'value' => (set_value('link_url') == NULL) ? $data ['link_url'] : set_value('link_url'));
////        'value' => (set_value('weight') == NULL) ? $data ['weight'] : set_value('weight'));
//        $f_img = array(
//            'name' => 'img_slide',
//            'class' => 'form-control');
//        $f_status = array(
//            '1' => 'ใช้งาน',
//            '0' => 'ไม่ใช้งาน',
//        );
//
//        $id = $data['id'];
//        $form_edit = array(
//            'form' => form_open_multipart('Slides/edit/' . $data['id'], array('class' => 'form-horizontal', 'id' => 'form_slide')),
//            'title[thai]' => form_input($f_title_th),
//            'title[english]' => form_input($f_title_en),
//            'subtitle[thai]' => form_input($f_sub_title_th),
//            'subtitle[english]' => form_input($f_sub_title_en),
//            'link_url' => form_input($f_link),
//            'img_slide' => form_upload($f_img),
//            'status_slide' => form_dropdown('status_slide', $f_status, (set_value('status_slide') == NULL) ? $data ['status_slide'] : set_value('status_slide'), 'class="form-control"'),
//            'image' => img($this->get_image($id), array('class' => 'img-responsive thumbnail', 'width' => '200', 'height' => '200')),
//        );
//        //Unset img if NULL        
//        if ($form_edit['img_slide'] == NULL)
//            unset($form_edit['img_slide']);
//
//        return $form_edit;
//    }
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

//
//    function get_post_set_form_edit() {
//        $get_page_data = array(
//            'title' => serialize($this->input->post('title')),
//            'subtitle' => serialize($this->input->post('subtitle')),
//            'link_url' => $this->input->post('link_url'),
//            'status_slide' => $this->input->post('status_slide'),
//        );
//        //img_slide if not NULL
//        if (!empty($_FILES['img_slide']['name'])) {
//            $this->upload_image('img_slide', $this->get_image_id($this->slide_id));
//        }
//        return $get_page_data;
//    }
//
//    function get_all_slide() {
//        $this->db->select('*');
//        $this->db->from('slides');
//        $this->db->join('images', 'images.image_id = slides.image_id');
//        $rs = $this->db->get();      
//        return $rs->result_array();
//    }
//    
//
//    function get_silde($id) {
//        $this->db->select('slides.id,slides.title,slides.subtitle,slides.link_url,slides.status_slide,slides.create_date,images.img_name,images.img_small,images.img_full,images.img_path');
//        $this->db->from('slides');
//        $this->db->join('images', 'images.id = slides.image_id');
//        $this->db->where('slides.id', $id);
//        $query = $this->db->get();
//        $rs = $query->result_array();
//        return $rs;
//    }
//
//    function get_image($id) {
//        $this->db->select('images.img_full');
//        $this->db->from('slides');
//        $this->db->join('images', 'images.id = slides.image_id');
//        $this->db->where('slides.id', $id);
//        $query = $this->db->get();
//        $row = $query->row_array();
//
//        return $row['img_full'];
//    }
//
//    function get_image_id($slide_id) {
//        $this->db->select('images.id');
//        $this->db->from('slides');
//        $this->db->join('images', 'images.id = slides.image_id');
//        $this->db->where('slides.id', $slide_id);
//        $query = $this->db->get();
//        $row = $query->row_array();
//
//        return $row['id'];
//    }
//
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
                $config2['height'] = 500;
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
                    $this->db->where('id', $id);
                    $this->db->update('images', $data_img);
                    return;
                }
            }
        }
    }

    public function deleteImage($image_id) {
        $this->db->select('image_path,imgage_name');
        $this->db->from('images');
        $this->db->where('id', $image_id);
        $query = $this->db->get();
        $row = $query->row_array();

        unlink($row['imgage_path'] . $row['img_name']);
        unlink($row['imgage_path'] . 'thumbs/' . $row['img_name']);
    }

    /* echo '<pre>';

      print_r($finfo);

      echo '</pre>'; */
//            [file_name] => vord1.jpg
//                    [file_type] => image/jpeg
//                    [file_path] => /Applications/MAMP/htdocs/Bagaroung_shop/assets/img/slides/
//                    [full_path] => /Applications/MAMP/htdocs/Bagaroung_shop/assets/img/slides/vord1.jpg
//                    [raw_name] => vord1
//                    [orig_name] => vord.jpg
//                    [client_name] => vord.jpg
//                    [file_ext] => .jpg
//                    [file_size] => 51.88
//                    [is_image] => 1
//                    [image_width] => 585
//                    [image_height] => 844
//                    [image_type] => jpeg
//                    [image_size_str] => width="585" height="844"
}
