<?php

class Kindness_ad extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_template');
    }

    public function index() {
        $data = array();

//        $this->m_template->set_Debug($data);
        $this->m_template->set_Title('ผู้ใหญ่ใจดี');
        $this->m_template->set_Content('admin/kindness.php', $data);
        $this->m_template->showTemplateAdmin();
    }

    public function add() {
        $data = array();
        
        

//        $this->m_template->set_Debug($data);
        $this->m_template->set_Title('เพิ่มผู้ใหญ่ใจดี');
        $this->m_template->set_Content('admin/form_kindness.php', $data);
        $this->m_template->showTemplateAdmin();
    }

}
