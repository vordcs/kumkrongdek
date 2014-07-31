<?php

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->output->cache(20);
        $this->load->model('m_template');
        $this->load->model('m_slides');
        $this->load->model('m_activitys');
        $this->load->model('m_activity_types');
        $this->load->model('m_kindness');
        $this->load->model('m_home');
        
    }

//    public function index() {
//        $this->load->view('to_home');
//    }

    public function index() {
        $data = array();

        $data['slides'] = $this->m_home->get_slides();

        $data['highlight'] = $this->m_home->get_highlight();

        $data['kindness'] = $this->m_home->get_kindness();

        $data['news'] = $this->m_home->get_news();
        $data['news_type'] = $this->m_home->get_news_type();

        $data['activitys'] = $this->m_home->get_activitys();
        $data['activity_types'] = $this->m_home->get_activity_type();

//        $this->m_template->set_Debug($data['highlight']);
        $this->m_template->set_Title('สถานคุ้มครองสวัสดิภาพเด็ก|จังหวัดขอนแก่น');
        $this->m_template->set_Content('home.php', $data);
        $this->m_template->showTemplate();
    }

}
