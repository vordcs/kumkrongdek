<?php

class Kindness_ad extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_template');
        $this->load->model('m_kindness');
        if ($this->session->userdata('loged_in') != TRUE) {
            redirect('admin');
        }
    }

    public function index() {
        $data = array();

        $data['kindness'] = $this->m_kindness->get_kindness();
        $data['form'] = $this->m_kindness->set_form_search();
        $data['strtitle'] = NULL;
//        $this->m_template->set_Debug($data['form']);
        $this->m_template->set_Title('ผู้ใหญ่ใจดี');
        $this->m_template->set_Content('admin/kindness.php', $data);
        $this->m_template->showTemplateAdmin();
    }

    public function add() {
        $data = array();
        if ($this->m_kindness->validation_add() == TRUE && $this->form_validation->run() == TRUE) {
            $form_data = $this->m_kindness->get_post_form_add();
            $this->m_template->set_Debug($form_data);
            //insert data
            $this->m_kindness->insert_kindness($form_data);
            redirect('Kindness_ad');
        }

//        Load form add        
        $data['form'] = $this->m_kindness->set_form_add();
//        $this->m_template->set_Debug($data);
        $this->m_template->set_Title('เพิ่มผู้ใหญ่ใจดี');
        $this->m_template->set_Content('admin/form_kindness.php', $data);
        $this->m_template->showTemplateAdmin();
    }

    public function edit($id) {

        if ($this->m_kindness->validation_edit() && $this->form_validation->run() == TRUE) {
            $form_data = $this->m_kindness->get_post_form_edit($id);
//            $d['num_select'] = $this->input->post('image_id');
//            $d['num_all'] = count($this->m_kindness->get_image_kindness($id));            
//            $this->m_template->set_Debug($d);
            //update data
            $this->m_kindness->update_kindness($id, $form_data);
            redirect('Kindness_ad');
        }
        //      get detail and sent to load form
        $detail = $this->m_kindness->get_kindness($id);
        $name = $detail[0]['kindness_title'];
        if ($detail[0] != NULL) {
            $data['form'] = $this->m_kindness->set_form_edit($detail[0]);
            $data['detail'] = $detail[0];
        } else {
            redirect('Kindness_ad');
        }

//        $this->m_template->set_Debug($data);
        $this->m_template->set_Title('แก้ไขผู้ใหญ่ใจดี : ' . $name);
        $this->m_template->set_Content('admin/form_kindness.php', $data);
        $this->m_template->showTemplateAdmin();
    }

    public function delete($id) {
        $this->m_kindness->delete_kindness($id);
        redirect('Kindness_ad');
    }

    public function search() {
        $data = array();
        $status = (int) $this->input->post('status');
        $date = $this->input->post('date_search');

        if ($status == 0 && $date == NULL) {
            redirect('Kindness_ad');
        }
        $s = array('ทั้งหมด', 'ไม่ใช้งาน', 'ใช้งาน');
        if ($date == NULL) {
            $title = 'สถานะ  ' . $s[$status];
        } else {
            $title = $date;
        };


        $data['kindness'] = $this->m_kindness->search_kindness($status, $date);
        $data['form'] = $this->m_kindness->set_form_search();
        $data['strtitle'] = 'ผลการค้นหา : ' . $title;
//        $this->m_template->set_Debug($data);
        $this->m_template->set_Title('ผู้ใหญ่ใจดี');
        $this->m_template->set_Content('admin/kindness.php', $data);
        $this->m_template->showTemplateAdmin();
    }

    public function unactive($id) {
        $data = array(
            'kindness_status' => 'unactive',
        );

        $this->db->where('kindness_id', $id);
        $this->db->update('kindness', $data);

//        $this->index();

        redirect('Kindness_ad');
    }

    public function active($id) {
        $data = array(
            'kindness_status' => 'active',
        );

        $this->db->where('kindness_id', $id);
        $this->db->update('kindness', $data);

//        $this->index();        
        redirect('Kindness_ad');
    }

    public function view_more($id) {

        $kindness = $this->m_kindness->get_kindness($id);
        foreach ($kindness as $row) {
            $img = $row['image_small'];
            $title = $row['kindness_title'];
            $subtitle = $row['kindness_subtitle'];
            $content = $row['kindness_content'];
            $date = $this->m_datetime->DateThai($row['publish_date']);
            $status = $row['kindness_status'];
            $create = '  | สร้าง : ' . $this->m_datetime->DateTimeThai($row['create_date']) . ' โดย: ' . $row['create_by'];
            $update = 'แก้ไข : ' . $this->m_datetime->DateTimeThai($row['update_date']) . ' โดย: ' . $row['update_by'];
        }
//
        $data = array(
            'controller' => 'Kindness_ad',
            'id' => $id,
            'img' => $img,
            'title_article' => $title,
            'subtitle' => $subtitle,
            'date' => $date,
            'status' => $status,
            'content' => $content,
            'create' => $create,
            'update' => $update,
        );
//
        $data['images'] = $this->m_kindness->get_image_kindness($id);
        $data['file'] = NULL;
        $data['type'] = NULL;
//        $this->m_template->set_Debug($kindness);
        $this->m_template->set_Title('ผู้ใหญ่ใจดี');
        $this->m_template->set_Content('admin/detail.php', $data);
        $this->m_template->showTemplateAdmin();
    }

    public function textarea_check($str) {
        if ($str == '<br>') {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function file_check() {
        if (count($_FILES['userfile']['name']) <= 10) {
            return TRUE;
        }

        $this->form_validation->set_message('file_check', 'จำนวนรูปภาพมากกว่า 10 รูป');
        return FALSE;
    }

}
