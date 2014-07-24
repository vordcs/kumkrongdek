<?php

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_template');
        $this->load->model('m_slides');
         $this->load->model('m_activitys');
         $this->load->model('m_activity_types');
    }

    public function index() {
        $data = array();
        
        $data['slides']=  $this->m_slides->get_slides_by_status('active');
        
        $data['activitys']=$this->m_activitys->get_activitys();
        $data['activity_types']=$this->m_activity_types->get_activity_type(0);

//        $this->m_template->set_Debug($data['activity_types']);
        $this->m_template->set_Content('home.php', $data);
        $this->m_template->showTemplate();
    }

}
