<?php

class admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('m_login');
        $this->load->model('m_template');
    }

    public function index() {
        if ($this->m_login->set_validation() == TRUE && $this->form_validation->run()) {
            $data['input'] = $this->m_login->get_post();
            $input = $this->m_login->get_post();
            $user = $this->m_login->select_user($input['username'], $input['password']);
            redirect('News_ad');
//            $user['loged_in'] = TRUE;
//            $this->session->set_userdata($user);
        };
        $this->load->view('login');
    }

    public function login() {

        $data['form'] = $this->m_login->set_form();
        $data['input'] = array();

        if ($this->m_login->set_validation() == TRUE && $this->form_validation->run()) {
            $data['input'] = $this->m_login->get_post();
            $input = $this->m_login->get_post();
            $user = $this->m_login->select_user($input['username'], $input['password']);
            redirect('News_ad');
//            $user['loged_in'] = TRUE;
//            $this->session->set_userdata($user);
        };

        $this->m_template->set_Debug($data['input']);
        $this->m_template->set_Content('login.php', $data);
        $this->m_template->showTemplate();
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('Home/');
    }

    public function username_check($str) {
        $check = $this->m_login->username_check($str);
        if ($check) {
            return TRUE;
        } else {
            $this->form_validation->set_message('username_check', '%s ไม่ถูกต้อง');
            return FALSE;
        }
    }

    public function password_check($str) {
        $check = $this->m_login->username_check($str);
        if ($check) {
            return TRUE;
        } else {
            $this->form_validation->set_message('password_check', '%s ไม่ถูกต้อง"');
            return FALSE;
        }
    }

}
