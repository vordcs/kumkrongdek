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

    public function insert_news($f_data) {
        $this->db->insert('news', $f_data);
    }

    public function update_news($id, $f_data) {
        $this->db->where('news_id', $id);
        $this->db->update('news', $f_data);
    }

    public function get_news($id = NULL) {

        $this->db->select('*');
        $this->db->from('news');
        $this->db->join('images', 'image_id = news_img');
        if ($id != NULL) {
            $this->db->where('news_id', $id);
        }
        $rs = $this->db->get();
        $itemp = $rs->result_array();

        return $itemp;
    }

    function set_form_add() {
        $f_news_title = array(
            'name' => 'news_title',
            'class' => 'form-control',
            'placeholder' => '',
            'value' => set_value('news_title')
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
            'value' => set_value('news_img')
        );

        $f_publish_date = array(
            'name' => 'publish_date',
            'class' => 'form-control datepicker',
            'placeholder' => '',
            'value' => (set_value('publish_date') == NULL) ? $this->getDateToday() : set_value('publish_date')
        );

        $f_highlight = array(
            '0' => 'ทั่วไป',
            '1' => 'เด่น',
        );


        $form_add = array(
            'form' => form_open_multipart('News_ad/add', array('class' => 'form-horizontal', 'id' => 'form_news')),
            'news_title' => form_input($f_news_title),
            'news_content' => form_textarea($f_news_content),
            'news_type' => form_dropdown('news_type', $f_news_type, set_value('news_type'), 'class="form-control"'),
            'news_img' => form_upload($f_news_img),
            'news_highlight' => form_dropdown('news_highlight', $f_highlight, set_value('news_highlight'), 'class="form-control"'),
            'publish_date' => form_input($f_publish_date),
            'images' => NULL,
        );

        return $form_add;
    }

    function set_form_edit($data) {
        $f_news_title = array(
            'name' => 'news_title',
            'class' => 'form-control',
            'placeholder' => '',
            'value' => (set_value('news_title') == NULL) ? $data['news_title'] : set_value('news_title')
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

        $f_publish_date= array(
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
            'news_content' => form_textarea($f_news_content),
            'news_type' => form_dropdown('news_type', $f_news_type, (set_value('news_type') == NULL) ? $data['news_type'] : set_value('news_type'), 'class="form-control"'),
            'news_img' => form_upload($f_news_img),
            'news_status' => form_dropdown('news_status', $f_status, (set_value('news_status') == NULL) ? $data['news_status'] : set_value('news_status'), 'class="form-control"'),
            'news_highlight' => form_dropdown('news_highlight', $f_highlight, (set_value('news_highlight') == NULL) ? $data['news_highlight'] : set_value('news_highlight'), 'class="form-control"'),
            'publish_date' => form_input($f_publish_date),
            'images' => NULL,
        );

        return $form_edit;
    }

    public function validation_add() {
        $this->form_validation->set_rules('news_title', 'ชื่อเรื่อง', 'required|trim|xss_clean');
        $this->form_validation->set_rules('news_content', 'เนื้อหา', 'required|trim|xss_clean');
        $this->form_validation->set_rules('news_type', 'ประเภทกิจกรรม', 'required|trim|xss_clean|callback_type_check');
        $this->form_validation->set_rules('publish_date', 'วันที่', 'required|trim|xss_clean');
        if (empty($_FILES['news_img']['name']))
            $this->form_validation->set_rules('news_img', 'รูปภาพ', 'required|trim|xss_clean');
                
        return TRUE;
    }

    public function validation_edit() {
        $this->form_validation->set_rules('news_title', 'ชื่อเรื่อง', 'required|trim|xss_clean');
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
            'news_content' => $this->input->post('news_content'),
            'news_type' => $this->input->post('news_type'),
            'news_img' => $img_id,
            'news_highlight' => $this->input->post('news_highlight'),
            'publish_date' => $this->setDateFomat($this->input->post('publish_date')),
            'create_date' => $this->getDatetimeNow(),
        );

        return $page_data;
    }

    public function get_post_form_edit($id) {
        $page_data = array(
            'news_title' => $this->input->post('news_title'),
            'news_content' => $this->input->post('news_content'),
            'news_status' => $this->input->post('news_status'),
            'news_highlight' => $this->input->post('news_highlight'),
            'publish_date' => $this->setDateFomat($this->input->post('publish_date')),
            'update_date' => $this->getDatetimeNow(),
        );

        if (!empty($_FILES['news_img']['name'])) {
            $this->load->model('m_upload');
            $img_id = $this->m_upload->upload_image('news', 'news_img', $id);
            $page_data['news_img'] = $img_id;
        }

        return $page_data;
    }

    public function get_news_type() {
        $this->db->select('*');
        $this->db->from('news_types');
        $this->db->order_by('news_type_id');
        $query = $this->db->get();
        return $query->result_array();
    }

}
