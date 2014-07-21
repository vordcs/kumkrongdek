<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class m_activitys extends CI_Model {

    function getDatetimeNow() {
        return date('Y-m-d H:i:s');
    }

    function getDateToday() {
        return date('Y-m-d');
    }

    public function get_activitys($id = NULL) {
        $this->db->select('*');
        $this->db->from('activitys');
        $this->db->join('images', 'image_id = activity_img');
        if ($id != NULL) {
            $this->db->where('activity_id', $id);
        }
        $rs = $this->db->get();
        $itemp = $rs->result_array();
        return $itemp;
    }

    public function insert_activity($f_data) {
        $this->db->insert('activitys', $f_data);
    }

    public function update_activity($activity_id, $f_data) {
        $this->db->where('activity_id', $activity_id);
        $this->db->update('activitys', $f_data);
    }

    public function delete_activity($id) {
        //delete image
        $img_id = $this->get_image_id($id);
        $this->deleteImage($img_id);

        //delete slide
        $this->db->where('activity_id', $id);
        $this->db->delete('activitys');

        //delete data in database
        $this->db->where('image_id', $img_id);
        $this->db->delete('images');
    }

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
        $temp = $this->get_activity_type();
        foreach ($temp as $row) {
            $f_activity_type[$row['activity_type_id']] = $row['activity_type_name'];
        }
        $f_activity_img = array(
            'name' => 'activity_img',
//            'class' => 'form-control'
        );
        $f_highlight = array(
            '0' => 'ทั่วไป',
            '1' => 'เด่น',
        );

        $f_status = array(
            '2' => 'ใช้งาน',
            '1' => 'ไม่ใช้งาน',
        );
        $f_publish_date = array(
            'name' => 'publish_date',
            'class' => 'form-control datepicker',
            'value' => (set_value('publish_date') == NULL) ? $this->getDateToday() : set_value('publish_date')
        );

        $form_add = array(
            'form' => form_open_multipart('Activitys_ad/add', array('class' => 'form-horizontal', 'id' => 'form_activity')),
            'activity_title' => form_input($f_activity_title),
            'activity_content' => form_textarea($f_activity_content),
            'activity_type' => form_dropdown('activity_type', $f_activity_type, set_value('activity_type'), 'class="form-control"'),
            'activity_img' => form_upload($f_activity_img),
            'activity_highlight' => form_dropdown('activity_highlight', $f_highlight, set_value('activity_highlight'), 'class="form-control"'),
            'publish_date' => form_input($f_publish_date),
            'image' => NULL,
        );
        return $form_add;
    }

    public function set_form_edit($data) {

        $f_activity_title = array(
            'name' => 'activity_title',
            'class' => 'form-control',
            'placeholder' => 'ชื่อเรื่อง',
            'value' => (set_value('activity_title') == NULL) ? $data['activity_title'] : set_value('activity_title')
        );

        $f_activity_content = array(
            'name' => 'activity_content',
            'class' => 'form-control',
            'value' => (set_value('activity_content') == NULL) ? $data['activity_content'] : set_value('activity_content')
        );

        $f_activity_type = array();
        $temp = $this->get_activity_type();
        foreach ($temp as $row) {
            $f_activity_type[$row['activity_type_id']] = $row['activity_type_name'];
        }
        $f_activity_img = array(
            'name' => 'activity_img',
//            'class' => 'form-control'
        );
        $f_highlight = array(
            '0' => 'ทั่วไป',
            '1' => 'เด่น',
        );
        $f_publish_date = array(
            'name' => 'publish_date',
            'class' => 'form-control datepicker',
            'value' => (set_value('publish_date') == NULL) ? $data['publish_date'] : set_value('publish_date')
        );

        $form_edit = array(
            'form' => form_open_multipart('Activitys_ad/edit/' . $data['activity_id'], array('class' => 'form-horizontal', 'id' => 'form_activity')),
            'activity_title' => form_input($f_activity_title),
            'activity_content' => form_textarea($f_activity_content),
            'activity_type' => form_dropdown('activity_type', $f_activity_type, (set_value('activity_type') == NULL) ? $data['activity_type'] : set_value('activity_type'), 'class="form-control"'),
            'activity_img' => form_upload($f_activity_img),
            'activity_highlight' => form_dropdown('activity_highlight', $f_highlight, (set_value('activity_highlight') == NULL) ? $data['activity_highlight'] : set_value('activity_highlight'), 'class="form-control"'),
            'publish_date' => form_input($f_publish_date),
            'image' => $data ['image_small'],
        );
        return $form_edit;
    }

    public function validation_add() {
        $this->form_validation->set_rules('activity_title', 'ชื่อเรื่อง', 'required|trim|xss_clean');
        $this->form_validation->set_rules('activity_content', 'รายละเอียด', 'required|trim|xss_clean|callback_textarea_check');
        $this->form_validation->set_rules('activity_type', 'ประเภทกิจกรรม', 'required|trim|xss_clean|callback_type_check');
        $this->form_validation->set_rules('publish_date', 'วันเผยแพร่', 'required|trim|xss_clean');
        if (empty($_FILES['activity_img']['name'])) {
            $this->form_validation->set_rules('activity_img', 'รูปภาพ', 'required|xss_clean');
        }

        $this->form_validation->set_message('textarea_check', 'ใส่ข้อมูล %s');
        $this->form_validation->set_message('type_check', 'เลือกประเภทกิจกรรม');

        return TRUE;
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

    public function validation_edit() {
        $this->form_validation->set_rules('activity_title', 'ชื่อเรื่อง', 'required|trim|xss_clean');
        $this->form_validation->set_rules('activity_content', 'รายละเอียด', 'required|trim|xss_clean|callback_textarea_check');
        $this->form_validation->set_rules('activity_type', 'ประเภทกิจกรรม', 'required|trim|xss_clean|callback_type_check');
        $this->form_validation->set_rules('publish_date', 'วันเผยแพร่', 'required|trim|xss_clean');

        $this->form_validation->set_message('textarea_check', 'ใส่ข้อมูล %s');
        $this->form_validation->set_message('type_check', 'เลือกประเภทกิจกรรม');

        return TRUE;
    }

    public function get_post_form_add() {
        $this->load->model('m_upload');
        $img_id = $this->m_upload->upload_image('activitys', 'activity_img');
        $page_data = array(
            'activity_title' => $this->input->post('activity_title'),
            'activity_content' => $this->input->post('activity_content'),
            'activity_type' => $this->input->post('activity_type'),
            'activity_img' => $img_id,
            'activity_highlight' => $this->input->post('activity_highlight'),
            'publish_date' => $this->getDateToday(),
            'create_date' => $this->getDatetimeNow(),
        );
        return $page_data;
    }

    public function get_post_form_edit($id) {
        $page_data = array(
            'activity_title' => $this->input->post('activity_title'),
            'activity_content' => $this->input->post('activity_content'),
            'activity_type' => $this->input->post('activity_type'),
            'activity_highlight' => $this->input->post('activity_highlight'),
            'publish_date' => $this->input->post('publish_date'),
            'update_date' => $this->getDatetimeNow(),
        );
        //img if not NULL
        if (!empty($_FILES['activity_img']['name'])) {
            $this->load->model('m_upload');
            $this->m_upload->upload_image('activitys', 'activity_img', $this->get_image_id($id));
        }
        return $page_data;
    }

    public function get_image_id($id) {
        $this->db->select('image_id');
        $this->db->from('activitys');
        $this->db->join('images', 'image_id = activity_img');
        $this->db->where('activity_id', $id);
        $query = $this->db->get();
        $row = $query->row_array();

        return $row['image_id'];
    }

    public function get_activity_type() {
        $this->db->order_by('activity_type_id');
        $query = $this->db->get('activity_types');
        return $query->result_array();
    }
    ///

    function insert_img_to_database($product_id) {
        $data_images = array();
        //Prepare image and insert to images
        $img = $this->get_img_from_temp();
        foreach ($img as $row) {
            $this->db->insert('images', $row);
            $temp = array(
                'product_id' => $product_id,
                'image_id' => $this->db->insert_id()
            );
            array_push($data_images, $temp);
            //Move img to products
            rename(img_path() . 'temp/' . $row['img_name'], $row['img_path']);
            rename(img_path() . 'temp/thumbs/' . $row['img_name'], img_path() . 'products/thumbs/' . $row['img_name']);
        }
        //Insert to products_has_images
        if ($data_images != NULL)
            $this->db->insert_batch('products_has_images', $data_images);
        return TRUE;
    }

    function clear_upload_temp() {
        delete_files(img_path() . 'temp/');
    }

    function load_img_to_temp($activity_id) {
        //Read images of activitys
        $this->db->select();
        $this->db->from('activitys_has_images');
        $this->db->join('images', 'activitys_has_images.image_id=images.image_id', 'left');
        $this->db->where('activitys_has_images.$activity_id', $activity_id);
        $query = $this->db->get();
        $data = $query->result_array();

        //Copy images to temp
        foreach ($data as $row) {
            copy(img_path() . 'activitys/' . $row['image_name'], img_path() . 'temp/' . $row['image_name']);
            copy(img_path() . 'activitys/thumbs/' . $row['image_name'], img_path() . 'temp/thumbs/' . $row['image_name']);
        }
    }

    function delect_img_in_database($activity_id) {
        //Delect image in folder product
        $this->db->select();
        $this->db->from('activitys_has_images');
        $this->db->join('images', 'activitys_has_images.image_id=images.image_id', 'left');
        $this->db->where('activitys_has_images.activity_id', $activity_id);
        $query = $this->db->get();
        $data = $query->result_array();
        foreach ($data as $row) {
            unlink(img_path() . 'activitys/' . $row['image_name']);
            unlink(img_path() . 'activitys/thumbs/' . $row['imag_name']);
            //Delect image in images
            $this->db->delete('images', array('id' => $row['image_id']));
        }
        //Delect image in activitys_has_images
        $this->db->delete('activitys_has_images', array('activity_id' => $activity_id));
        return TRUE;
    }

    function get_img_from_temp() {
        $data = array();
        $name = get_filenames(img_path() . 'temp/thumbs/');
        for ($i = 0; $i < count($name); $i++) {
            $temp = array(
                'image_name' => $name[$i],
                'image_full' => 'activitys/' . $name[$i],
                'image_small' => 'activitys/thumbs/' . $name[$i],
                'image_path' => img_path() . 'activitys/' . $name[$i]
            );
            array_push($data, $temp);
        }
        return $data;
    }

}
