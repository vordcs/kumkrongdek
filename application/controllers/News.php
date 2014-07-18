<?php

class News extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_template');
    }

    public function index() {
        $data = array();
        $this->m_template->set_Title('ข่าว');
//        $this->m_template->set_Debug($data);
        $this->m_template->set_Content('admin/News.php', $data);
        $this->m_template->showTemplateAdmin();
    }

}
