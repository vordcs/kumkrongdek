<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class m_news extends CI_Model {

    function getDatetimeNow() {
        return date('Y-m-d H:i:s');
    }

    function getDateToday() {
        return date('Y-m-d');
    }

    function setDateFomat($input_date) {
        $d = new DateTime($input_date);
        $date = $d->format('Y-m-d');
        return $date;
    }

//    view mode
    public function get_news($id = NULL) {

        $this->db->select('*');
        $this->db->from('news');
        $this->db->order_by("create_date desc,publish_date desc");

        $this->db->join('images', 'image_id = news_img');
        if ($id != NULL) {
            $this->db->where('news_id', $id);
        }
        $rs = $this->db->get();
        $itemp = $rs->result_array();

        return $itemp;
    }

    public function get_news_highlight() {

        $this->db->select('*');
        $this->db->from('news');
        $this->db->join('images', 'image_id = news_img');
        $this->db->where('news_highlight', 1);

        $rs = $this->db->get();
        $itemp = $rs->result_array();

        return $itemp;
    }

    public function get_news_file($news_id = NULL) {

        $this->db->select();
        $this->db->from('news_has_files');
        $this->db->join('files', 'news_has_files.file_id = files.file_id', 'left');
        if ($news_id != NULL) {
            $this->db->where('news_id', $news_id);
        }
        $query = $this->db->get();

        $result = $query->result_array();
        return $result;
    }

    public function get_news_image($id = NULL) {
        $this->db->select();
        $this->db->from('activitys_has_images');
        $this->db->join('images', 'activitys_has_images.image_id = images.image_id', 'left');
        if ($activity_id != NULL) {
            $this->db->where('activity_id', $activity_id);
        }
        $query = $this->db->get();
        $this->db->select('*');
        $this->db->from('files');
        $this->db->join('news_has_files', 'news_has_files.file_id = files.file_id');
//        $this->db->join('products', 'products_has_images.product_id = products.id', 'left');
//        $this->db->join('product_types', 'products.product_type_id=product_types.id', 'left');
        if ($id != NULL) {
            $this->db->where('news_has_files.file_id', $id);
        }
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function search_news() {
//        $date = explode(' ', $str_th_date);
//        $month = $this->getMonthFromTH($date[0]);

        $type = (int) $this->input->post('type');
        $status = (int) $this->input->post('status');
        $date = $this->input->post('date_search');

        $this->db->select('*');
        $this->db->from('news');
        $this->db->join('images', 'image_id = news_img');
        if ($type != 0 && $type != 1) {
            $this->db->where('news_type', $type);
        }
        if ($status != 0) {
            $this->db->where('news_status', $status);
        }
        if ($date != null) {
            $d = explode(' ', $date);
            $month = $this->m_datetime->monthTHtoDB($d[0]);
            $this->db->where('MONTH(publish_date)', $month);
        }

        $rs = $this->db->get();
        $itemp = $rs->result_array();
        return $itemp;
    }

    public function get_images_by_news($id) {
//        $this->db->select('*');
//        $this->db->from('images');
//        $this->db->join('news_has_images', 'news.image_id = images_id');
////        $this->db->join('products', 'products_has_images.product_id = products.id', 'left');
////        $this->db->join('product_types', 'products.product_type_id=product_types.id', 'left');
//        $this->db->where('product_id', $id);
//        $query = $this->db->get();
//        $result = $query->result_array();
//        return $result;
    }

//    end view mode 

    public function insert_news($f_data) {
        $this->db->trans_start();
        $this->db->insert('news', $f_data);
        $new_id = $this->db->insert_id();
        $this->db->trans_complete();

        $this->load->model('m_upload');
        $this->m_upload->upload_multi_file('file', $new_id);
//        $this->m_upload->upload_multi_image('news','news_has_images','images', $new_id);
    }

    public function update_news($id, $f_data) {
        $this->load->model('m_upload');
        $this->m_upload->upload_multi_file('file', $id);
        $this->db->where('news_id', $id);
        $this->db->update('news', $f_data);
    }

    public function delete_news($id) {

        //delete file
        $new_file = $this->get_news_file($id);
        foreach ($new_file as $file) {
            $this->deleteFile($file['file_id']);
            $this->db->where('file_id', $file['file_id']);
            $this->db->delete('news_has_files');
        }

        //delete image 
        $img_id = $this->get_image_id($id);
        $this->deleteImage($img_id);

        //delete file in folder
        $file_id = $this->get_file_id($id);
        $this->deleteFile($file_id);

        //delete
        $this->db->where('news_id', $id);
        $this->db->delete('news');
    }

    public function set_form_add() {
        $f_news_title = array(
            'name' => 'news_title',
            'class' => 'form-control',
            'placeholder' => 'ชื่อเรื่องหลัก',
            'value' => set_value('news_title')
        );
        $f_news_subtitle = array(
            'name' => 'news_subtitle',
            'class' => 'form-control',
            'placeholder' => 'ชื่อเรื่องรอง',
            'value' => set_value('news_subtitle')
        );
        $f_news_content = array(
            'name' => 'news_content',
            'class' => 'form-control',
            'id' => 'content',
            'placeholder' => '',
            'value' => set_value('news_content')
        );

        $f_news_type = array();
        $temp = $this->get_news_type();
        foreach ($temp as $row) {
            $f_news_type[$row['news_type_id']] = $row['news_type_name'];
        }

        $f_news_img = array(
            'name' => 'news_img',
//            'class'=>'form-control',
            'placeholder' => '',
            'accept' => 'image/gif,image/png,image/jpeg,image/jpg',
            'value' => set_value('news_img')
        );

        $f_publish_date = array(
            'name' => 'publish_date',
            'class' => 'form-control datepicker',
            'placeholder' => '',
            'value' => set_value('publish_date')
        );

        $f_highlight = array(
            '0' => 'ทั่วไป',
            '1' => 'เด่น',
        );


        $form_add = array(
            'form' => form_open_multipart('News_ad/add', array('class' => 'form-horizontal', 'id' => 'form_news')),
            'news_title' => form_input($f_news_title),
            'news_subtitle' => form_input($f_news_subtitle),
            'news_content' => form_textarea($f_news_content),
            'news_type' => form_dropdown('news_type', $f_news_type, set_value('news_type'), 'class="form-control"'),
            'news_img' => form_upload($f_news_img),
            'news_highlight' => form_dropdown('news_highlight', $f_highlight, set_value('news_highlight'), 'class="form-control"'),
            'publish_date' => form_input($f_publish_date),
            'image' => NULL,
            'file_news' => NULL,
        );

        return $form_add;
    }

    public function set_form_edit($data) {
        $f_news_title = array(
            'name' => 'news_title',
            'class' => 'form-control',
            'placeholder' => 'ชื่อเรื่องหลัก',
            'value' => (set_value('news_title') == NULL) ? $data['news_title'] : set_value('news_title')
        );

        $f_news_subtitle = array(
            'name' => 'news_subtitle',
            'class' => 'form-control',
            'placeholder' => 'ชื่อเรื่องรอง',
            'value' => (set_value('news_subtitle') == NULL) ? $data['news_subtitle'] : set_value('news_subtitle')
        );

        $f_news_content = array(
            'name' => 'news_content',
            'class' => 'form-control',
            'id' => 'content',
            'placeholder' => '',
            'value' => (set_value('news_content') == NULL) ? $data['news_content'] : set_value('news_content')
        );

        $f_news_type = array();
        $temp = $this->get_news_type();
        foreach ($temp as $row) {
            $f_news_type[$row['news_type_id']] = $row['news_type_name'];
        }

        $f_news_img = array(
            'name' => 'news_img',
//            'class'=>'form-control',
            'placeholder' => '',
            'value' => (set_value('news_img') == NULL) ? $data['news_img'] : set_value('news_img')
        );

        $f_publish_date = array(
            'name' => 'publish_date',
            'class' => 'form-control datepicker',
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
            'form' => form_open_multipart('News_ad/edit/' . $data['news_id'], array('class' => 'form-horizontal', 'id' => 'form_news')),
            'news_title' => form_input($f_news_title),
            'news_subtitle' => form_input($f_news_subtitle),
            'news_content' => form_textarea($f_news_content),
            'news_type' => form_dropdown('news_type', $f_news_type, (set_value('news_type') == NULL) ? $data['news_type'] : set_value('news_type'), 'class="form-control"'),
            'news_img' => form_upload($f_news_img),
            'news_status' => form_dropdown('news_status', $f_status, (set_value('news_status') == NULL) ? $data['news_status'] : set_value('news_status'), 'class="form-control"'),
            'news_highlight' => form_dropdown('news_highlight', $f_highlight, (set_value('news_highlight') == NULL) ? $data['news_highlight'] : set_value('news_highlight'), 'class="form-control"'),
            'publish_date' => form_input($f_publish_date),
            'image' => $data['image_small'],
            'file_news' => $this->get_news_file($data['news_id']),
        );

        return $form_edit;
    }

    public function set_form_search() {
        $f_news_type = array();
        $temp = $this->get_news_type();
        foreach ($temp as $row) {
            $f_news_type[$row['news_type_id']] = $row['news_type_name'];
        }
        $f_date_search = array(
            'name' => 'date_search',
            'class' => 'form-control date-search',
            'placeholder' => 'เดือน ปี',
            'value' => (set_value('publish_date') == NULL) ? $this->input->post('date_search') : set_value('publish_date')
        );
        $f_status_search = array(
            '0' => 'ทั้งหมด',
            '1' => 'ไม่ใช้งาน',
            '2' => 'ใช้งาน',
        );
        $form_search = array(
            'form' => form_open('News_ad/', array('class' => 'form-horizontal', 'id' => 'form_search', 'name' => 'form_search')),
            'status' => form_dropdown('status', $f_status_search, (set_value('status') == NULL) ? $this->input->post('status') : set_value('status'), 'class="form-control"'),
            'type' => form_dropdown('type', $f_news_type, (set_value('type') == NULL) ? $this->input->post('type') : set_value('type'), 'class="form-control"'),
            'date' => form_input($f_date_search),
        );

        return $form_search;
    }

    public function validation_add() {
        $this->form_validation->set_rules('news_title', 'ชื่อเรื่อง', 'required|trim|xss_clean');
        $this->form_validation->set_rules('news_subtitle', 'ชื่อเรื่อง', 'required|trim|xss_clean');
        $this->form_validation->set_rules('news_content', 'เนื้อหา', 'required|trim|xss_clean');
        $this->form_validation->set_rules('news_type', 'ประเภทกิจกรรม', 'required|trim|xss_clean|callback_type_check');
        $this->form_validation->set_rules('publish_date', 'วันที่', 'required|trim|xss_clean');
        if (empty($_FILES['news_img']['name']))
            $this->form_validation->set_rules('news_img', 'รูปภาพ', 'required|trim|xss_clean');

        return TRUE;
    }

    public function validation_edit() {
        $this->form_validation->set_rules('news_title', 'ชื่อเรื่อง', 'required|trim|xss_clean');
        $this->form_validation->set_rules('news_subtitle', 'ชื่อเรื่อง', 'required|trim|xss_clean');
        $this->form_validation->set_rules('news_content', 'เนื้อหา', 'required|trim|xss_clean');
        $this->form_validation->set_rules('news_type', 'ประเภท', 'required|trim|xss_clean|callback_type_check');
        $this->form_validation->set_rules('publish_date', 'วันที่', 'required|trim|xss_clean');

        return TRUE;
    }

    public function get_post_form_add() {
        $this->load->model('m_upload');
        $img_id = $this->m_upload->upload_image('news', 'news_img');

        $page_data = array(
            'news_title' => $this->input->post('news_title'),
            'news_subtitle' => $this->input->post('news_subtitle'),
            'news_content' => $this->input->post('news_content'),
            'news_type' => $this->input->post('news_type'),
            'news_img' => $img_id,
            'news_highlight' => $this->input->post('news_highlight'),
            'publish_date' => $this->m_datetime->setDateFomat($this->input->post('publish_date')),
            'create_date' => $this->m_datetime->getDatetimeNow(),
        );

        return $page_data;
    }

    public function get_post_form_edit($id) {
        $page_data = array(
            'news_title' => $this->input->post('news_title'),
            'news_subtitle' => $this->input->post('news_subtitle'),
            'news_content' => $this->input->post('news_content'),
            'news_highlight' => $this->input->post('news_highlight'),
            'publish_date' => $this->m_datetime->setDateFomat($this->input->post('publish_date')),
            'update_date' => $this->m_datetime->getDatetimeNow(),
        );

        if (!empty($_FILES['news_img']['name'])) {
            $this->load->model('m_upload');
            $img_id = $this->m_upload->upload_image('news', 'news_img', $id);
            $page_data['news_img'] = $img_id;
        }
        $file = $this->input->post('files_id');
        $news_file = $this->get_news_file($id);
        $num_file = count($file);
        if (count($file) != count($news_file)) {
            $i = $num_file;
            for ($i = 0; $i < count($news_file); $i++) {
                $checked = FALSE;
                for ($j = 0; $j < $num_file; $j++) {
                    if ($news_file[$i]['file_id'] == $file[$j]) {
                        $checked = TRUE;
                    }
                }
                if ($checked == FALSE) {
//                    $page_data['image_id'] = array();
//                    array_push($page_data['image_id'], $news_file[$i]['file_id'] . ' name : ' . $news_file[$i]['file_name']);
                    $this->deleteFile($news_file[$i]['file_id']);
                    $this->db->where('file_id', $news_file[$i]['file_id']);
                    $this->db->delete('news_has_files');
                }
            }
        }


        return $page_data;
    }

    public function get_news_type($type_id = NULL) {
        $this->db->select('*');
        $this->db->from('news_types');
        $this->db->order_by('news_type_id');
        if ($type_id != NULL) {
            $this->db->where('news_type_id', $type_id);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_image_id($id) {
        $this->db->select('*');
        $this->db->from('news');
        $this->db->join('images', 'image_id = news_img');

        $this->db->where('news_id', $id);
        $query = $this->db->get();
        $row = $query->row_array();
        return $row['image_id'];
    }

    public function get_file_id($news_id) {
        $this->db->select('file_id');
        $this->db->from('news_has_files');
        $this->db->where('news_id', $news_id);
        $query = $this->db->get();
        $row = $query->row_array();

        return $row['file_id'];
    }

    public function check_news_file($news_id) {
        $this->db->select('file_id');
        $this->db->from('news');
        $this->db->join('news_has_files', 'files.news_id = news_has_files.news_id');
        $this->db->where('news_id', $news_id);
        $query = $this->db->get();
        $rs = $query->result_array();
        return $rs;
    }

    public function check_news_image($news_id) {
        $this->db->select('*');
        $this->db->from('news');
        $this->db->join('images', 'image_id = news_img');
        $this->db->where('news_id', $news_id);
        $query = $this->db->get();
        $rs = $query->result_array();
        return $rs;
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

    public function deleteFile($file_id) {
        $this->db->select('file_full_path');
        $this->db->from('files');
        $this->db->where('file_id', $file_id);
        $query = $this->db->get();
        $row = $query->row_array();

        unlink($row['file_full_path']);
    }

}
