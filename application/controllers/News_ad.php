<?php

class News_ad extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_template');                 
    }

    public function index() {
        $data = array();
        $this->m_template->set_Title('ข่าว');
        $this->m_template->set_Content('admin/news.php', $data);
        $this->m_template->showTemplateAdmin();
    }
    
    public function add(){
        $data = array();
        $this->m_template->set_Title('เพิ่มข่าว');
        $this->m_template->set_Content('admin/form_news.php', $data);
        $this->m_template->showTemplateAdmin();
        
    }

}