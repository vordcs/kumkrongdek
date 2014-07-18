<?php

class Activitys extends CI_Controller {
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

        $data = array();

        $data['form']=  $this->m_activitys->set_form_add();
//        $this->m_template->set_Debug($data);
        $this->m_template->set_Title('เพิ่มกิจกรรม');
        $this->m_template->set_Content('admin/form_activity.php', $data);
        $this->m_template->showTemplateAdmin();
    }
        public function edit() {

        $data = array();

//        $this->m_template->set_Debug($data);
        $this->m_template->set_Title('แก้ไขกิจกรรม');
        $this->m_template->set_Content('admin/form_activity.php', $data);
        $this->m_template->showTemplateAdmin();
    }
}
