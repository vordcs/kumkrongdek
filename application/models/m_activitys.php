<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class m_activitys extends CI_Model {

    public function get_activitys($id = NULL) {
        $this->db->select('*');
        $this->db->from('activitys');
        $this->db->join('images', 'image_id = activity_img','left');
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
        if ($activity_id != NULL) {
            $this->db->where('activity_id', $activity_id);
        }
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }

    public function search_activitys() {
//        $date = explode(' ', $str_th_date);
//        $month = $this->getMonthFromTH($date[0]);

        $type = (int) $this->input->post('type');
        $status = (int) $this->input->post('status');
        $date = $this->input->post('date_search');

        $this->db->select('*');
        $this->db->from('activitys');
        $this->db->join('images', 'image_id = activity_img');

        if ($type != 0) {
            $this->db->join('activity_types', 'activity_type_id = activity_type');
            $this->db->where('activity_type', $type);
        }
        if ($date != null) {
            $str_date = explode(' ', $date);
            $month = $this->m_datetime->monthTHtoDB($str_date[0]);
            $this->db->where('MONTH(publish_date)', $month);
        }
        if ($status != 0) {
            $this->db->where('activity_status', $status);
        }
        $rs = $this->db->get();
        $itemp = $rs->result_array();
        return $itemp;
    }

    public function insert_activity($f_data) {
        $this->db->insert('activitys', $f_data);
        $this->insert_img_to_database($this->db->insert_id());
        return TRUE;
    }

    public function update_activity($activity_id, $f_data) {
        $this->db->where('activity_id', $activity_id);
        $this->db->update('activitys', $f_data);

        //Delete old images
        $this->delect_img_in_database($activity_id);
        //Insert new images in temp
        $this->insert_img_to_database($activity_id);

//        $this->clear_upload_temp();
    }

    public function delete_activity($id) {

        //delete file
        $img_activity = $this->get_image_activity($id);
        foreach ($img_activity as $row) {
            
            unlink($row['image_path']);
            unlink(img_path() . 'activitys/thumbs/' . $row['image_name']);

            $this->db->where('image_id', $row['image_id']);
            $this->db->delete('activitys_has_images');

            $this->db->where('image_id', $row['image_id']);
            $this->db->delete('images');
        }


        //delete image
        $img_id = $this->get_image_id($id);
        $this->deleteImage($img_id);

        //delete data in database
        $this->db->where('image_id', $img_id);
        $this->db->delete('images');

        //delete activity
        $this->db->where('activity_id', $id);
        $this->db->delete('activitys');
    }

    public function set_form_add() {
        //Clear folder temp
        if ($this->form_validation->error_string() == NULL && $this->form_validation->run() != TRUE) {
            $this->clear_upload_temp();
        }

        $f_activity_title = array(
            'name' => 'activity_title',
            'class' => 'form-control',
            'placeholder' => 'ชื่อเรื่อง',
            'value' => set_value('activity_title')
        );
        $f_activity_subtitle = array(
            'name' => 'activity_subtitle',
            'class' => 'form-control',
            'placeholder' => 'ชื่อเรื่องรอง',
            'value' => set_value('activity_subtitle')
        );
        $f_activity_content = array(
            'name' => 'activity_content',
            'class' => 'form-control',
            'id' => 'content',
            'rows' => '5',
            'cols' => '30',
            'value' => set_value('activity_content')
        );

        $f_activity_type = array();
        $temp = $this->get_activity_type();
        foreach ($temp as $row) {
            $f_activity_type[$row['activity_type_id']] = $row['activity_type_name'];
        }

        $f_activity_img = array(
            'name' => 'activity_img',
            'accept' => 'image/gif,image/png,image/jpeg,image/jpg',
//            'class' => 'form-control'
        );
        $f_highlight = array(
            '0' => 'ทั่วไป',
            '1' => 'เด่น',
        );
        $f_publish_date = array(
            'name' => 'publish_date',
            'class' => 'form-control datepicker',
            'value' => set_value('publish_date')
        );

        $form_add = array(
            'form' => form_open_multipart('Activitys_ad/add', array('class' => 'form-horizontal', 'id' => 'form_activity')),
            'activity_title' => form_input($f_activity_title),
            'activity_subtitle' => form_input($f_activity_subtitle),
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
        //Prepare folder temp
        if ($this->form_validation->error_string() == NULL && $this->form_validation->run() != TRUE) {
            $this->load_img_to_temp($data['activity_id']);
        }
        $f_activity_title = array(
            'name' => 'activity_title',
            'class' => 'form-control',
            'placeholder' => 'ชื่อเรื่อง',
            'value' => (set_value('activity_title') == NULL) ? $data['activity_title'] : set_value('activity_title')
        );
        $f_activity_subtitle = array(
            'name' => 'activity_subtitle',
            'class' => 'form-control',
            'placeholder' => 'ชื่อเรื่องรอง',
            'value' => (set_value('activity_subtitle') == NULL) ? $data['activity_subtitle'] : set_value('activity_subtitle')
        );
        $f_activity_content = array(
            'name' => 'activity_content',
            'class' => 'form-control',
            'id' => 'content',
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
            'accept' => 'image/gif,image/png,image/jpeg,image/jpg',
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
            'activity_subtitle' => form_input($f_activity_subtitle),
            'activity_content' => form_textarea($f_activity_content),
            'activity_type' => form_dropdown('activity_type', $f_activity_type, (set_value('activity_type') == NULL) ? $data['activity_type'] : set_value('activity_type'), 'class="form-control"'),
            'activity_img' => form_upload($f_activity_img),
            'activity_highlight' => form_dropdown('activity_highlight', $f_highlight, (set_value('activity_highlight') == NULL) ? $data['activity_highlight'] : set_value('activity_highlight'), 'class="form-control"'),
            'publish_date' => form_input($f_publish_date),
            'image' => $data ['image_small'],
        );
        return $form_edit;
    }

    public function set_form_search($controller = NULL) {

        $f_date_search = array(
            'name' => 'date_search',
            'class' => 'form-control date-search',
            'placeholder' => 'เดือน ปี',
//            'value' => (set_value('publish_date') == NULL) ? $this->input->post('date_search') : set_value('publish_date')
        );
        $f_status_search = array(
            '0' => 'ทั้งหมด',
            '1' => 'ไม่ใช้งาน',
            '2' => 'ใช้งาน',
        );

        $f_activity_type = array();
        $temp = $this->get_activity_type();
        foreach ($temp as $row) {
            $f_activity_type[$row['activity_type_id']] = $row['activity_type_name'];
        }
        if ($controller == NULL) {
            $controller = 'Activitys_ad';
        }

        $form_search = array(
            'form' => form_open($controller . '/', array('class' => 'form-horizontal', 'id' => 'form_search')),
            'status' => form_dropdown('status', $f_status_search, set_value('status'), 'class="form-control"'),
            'date' => form_input($f_date_search),
            'type' => form_dropdown('type', $f_activity_type, set_value('activity_type'), 'class="form-control"'),
        );

        return $form_search;
    }

    public function validation_add() {
        $this->form_validation->set_rules('activity_title', 'ชื่อเรื่อง', 'required|trim|xss_clean');
        $this->form_validation->set_rules('activity_subtitle', 'ชื่อเรื่อง', 'required|trim|xss_clean');
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
        $this->form_validation->set_rules('activity_subtitle', 'ชื่อเรื่อง', 'required|trim|xss_clean');
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
            'activity_subtitle' => $this->input->post('activity_subtitle'),
            'activity_content' => $this->input->post('activity_content'),
            'activity_type' => $this->input->post('activity_type'),
            'activity_img' => $img_id,
            'activity_highlight' => $this->input->post('activity_highlight'),
            'publish_date' => $this->m_datetime->setDateFomat($this->input->post('publish_date')),
            'create_by' => $this->session->userdata('first_name'),
            'create_date' => $this->m_datetime->getDatetimeNow(),
        );
        return $page_data;
    }

    public function get_post_form_edit($id) {
        $page_data = array(
            'activity_title' => $this->input->post('activity_title'),
            'activity_subtitle' => $this->input->post('activity_subtitle'),
            'activity_content' => $this->input->post('activity_content'),
            'activity_type' => $this->input->post('activity_type'),
            'activity_highlight' => $this->input->post('activity_highlight'),
            'publish_date' => $this->m_datetime->setDateFomat($this->input->post('publish_date')),
            'update_by' => $this->session->userdata('first_name'),
            'update_date' => $this->m_datetime->getDatetimeNow(),
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

///

    function insert_img_to_database($activity_id) {
        $data_images = array();
        //Prepare image and insert to images
        $img = $this->get_img_from_temp();
        foreach ($img as $row) {
            $this->db->insert('images', $row);
            $temp = array(
                'activity_id' => $activity_id,
                'image_id' => $this->db->insert_id()
            );
            array_push($data_images, $temp);
            //Move img to activitys
            rename(img_path() . 'temp/' . $row['image_name'], $row['image_path']);
            rename(img_path() . 'temp/thumbs/' . $row['image_name'], img_path() . 'activitys/thumbs/' . $row['image_name']);
        }
        //Insert to products_has_images
        if ($data_images != NULL)
            $this->db->insert_batch('activitys_has_images', $data_images);
        return TRUE;
    }

    function clear_upload_temp() {
        delete_files(img_path() . 'temp/');
    }

    function load_img_to_temp($activity_id) {
        $this->clear_upload_temp();
        //Read images of activitys
        $this->db->select();
        $this->db->from('activitys_has_images');
        $this->db->join('images', 'activitys_has_images.image_id = images.image_id', 'left');
        $this->db->where('activity_id', $activity_id);
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
        $this->db->join('images', 'activitys_has_images.image_id = images.image_id', 'left');
        $this->db->where('activity_id', $activity_id);
        $query = $this->db->get();
        $data = $query->result_array();

        foreach ($data as $row) {
            unlink(img_path() . 'activitys/' . $row['image_name']);
            unlink(img_path() . 'activitys/thumbs/' . $row['image_name']);
            //Delect image in images
            $this->db->delete('images', array('image_id' => $row['image_id']));
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
