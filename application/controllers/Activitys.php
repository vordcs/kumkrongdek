<?php

class Activitys extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_template');
        $this->load->model('m_activitys');
    }

    public function index() {

        $data = array();
        $data['activitys'] = $this->m_activitys->get_activitys();
        $data['activity_types'] = $this->m_activitys->get_activity_type();
        $data['images_activity'] = $this->m_activitys->get_image_activity();
        $data['form'] = $this->m_activitys->set_form_search();
        $data['strtitle'] = NULL;

//        $this->m_template->set_Debug($data['activitys']);
        $this->m_template->set_Title('กิจกรรม');
        $this->m_template->set_Content('activitys.php', $data);
        $this->m_template->showTemplate();
    }

}
