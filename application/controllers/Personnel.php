<?php

class Personnel extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_template');                 
    }

    public function index() {
        $data = array();

        $this->m_template->set_Content('personnel.php', $data);
        $this->m_template->showTemplate();
    }

}