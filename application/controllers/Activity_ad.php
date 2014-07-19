<?php

class Activity_ad extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_template');
        $this->load->model('m_activitys');
    }

    public function index() {
        $data = array();
//        $this->m_template->set_Debug($data);
        $this->m_template->set_Title('กิจกรรม');
        $this->m_template->set_Content('admin/activitys.php', $data);
        $this->m_template->showTemplateAdmin();
    }

    public function add() {

        if ($this->m_activitys->validation_add() && $this->form_validation->run() == TRUE) {
            $form_data = $this->m_activitys->get_post_form_add();
            //insert data
            $this->m_activitys->insert_journal($form_data);
            redirect('Activitys_ad');
        }
        //Load form add      
        $data['form'] = $this->m_activitys->set_form_add();
//        $this->m_template->set_Debug($data);
        $this->m_template->set_Title('เพิ่มกิจกรรม');
        $this->m_template->set_Content('admin/form_activity.php', $data);
        $this->m_template->showTemplateAdmin();
    }

    public function edit($id) {

        if ($this->m_activitys->validation_edit($id) && $this->form_validation->run() == TRUE) {
            $form_data = $this->m_activitys->get_post_form_edit($id);
            //insert data
            $this->m_activitys->update_journal($form_data);
            redirect('Activitys_ad');
        }
        //      get detail and sent to load form
        $detail = $this->m_activitys->get_journals($id);
        if ($detail[0] != NULL) {
            $data['form'] = $this->m_activitys->set_form_edit($detail[0]);
            $data['detail'] = $detail[0];
        } else {
            redirect('Activitys_ad');
        }

//        $this->m_template->set_Debug($data);
        $this->m_template->set_Title('แก้ไขกิจกรรม');
        $this->m_template->set_Content('admin/form_activity.php', $data);
        $this->m_template->showTemplateAdmin();
    }

    public function delete($id) {
        
    }

}
