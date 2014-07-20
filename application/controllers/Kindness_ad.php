<?php

class Kindness_ad extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_template');
        $this->load->model('m_kindness');
    }

    public function index() {
        $data = array();

        $data['kindness'] = $this->m_kindness->get_kindness();

//        $this->m_template->set_Debug($data);
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
//            redirect('Kindness_ad');
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
//            $this->m_template->set_Debug($form_data);
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
        $this->m_activitys->delete_activity($id);
        redirect('Kindness_ad');
    }

    public function unactive($kindness_id) {
        $data = array(
            'kindness_status' => '1',
        );

        $this->db->where('kindness_id', $kindness_id);
        $this->db->update('kindness', $data);

        redirect('Kindness_ad', 'refresh');
    }
    

    public function active($kindness_id) {
        $data = array(
            'kindness_status' => '2',
        );

        $this->db->where('kindness_id', $kindness_id);
        $this->db->update('kindness', $data);

        redirect('kindness_ad', 'refresh');
    }

    public function textarea_check($str) {
        if ($str == '<br>') {
            return FALSE;
        } else {
            return TRUE;
        }
    }
}
