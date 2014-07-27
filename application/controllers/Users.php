<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_template');
        $this->load->model('m_users');
          if ($this->session->userdata('loged_in') != TRUE) {
            redirect('admin');
        }
    }

    public function index() {

        $data['users'] = $this->m_users->get_users();

        $this->m_template->set_Title('รายชื่อผู้ใช้งาน');
//        $this->m_template->set_Debug($data);
        $this->m_template->set_Content('admin/users.php', $data);
        $this->m_template->showTemplateAdmin();
    }

    public function add() {

        if ($this->m_users->validation_add() && $this->form_validation->run() == TRUE) {
            $form_data = $this->m_users->get_post_form_add();
            //Insert data
            $this->m_users->insert_user($form_data);
            redirect('Users', 'refresh');
        }

        //Load form add
        $data['form'] = $this->m_users->set_form_add();


        $this->m_template->set_Title('เพิ่มผู้ใช้งาน');
        // $this->m_template->set_Debug($data);
        $this->m_template->set_Content('admin/form_user.php', $data);
        $this->m_template->showTemplateAdmin();
    }

    public function edit($id) {

        if ($this->m_users->validation_edit() && $this->form_validation->run() == TRUE) {
            $f_data = $this->m_users->get_post_form_edit();
            if ($this->m_users->update_user($id, $f_data)) {
                redirect('Users', 'refresh');
                exit();
            }
        }
        //      get detail and sent to load form
        $detail = $this->m_users->get_users($id);
        if ($detail[0] != NULL) {
            $data['form'] = $this->m_users->set_form_edit($detail[0]);
            $data['detail'] = $detail[0];
        } else {
            redirect('Users');
        }

        $this->m_template->set_Title('แก้ไขผู้ใช้งาน');
//        $this->m_template->set_Debug($data);
        $this->m_template->set_Content('admin/form_user.php', $data);
        $this->m_template->showTemplateAdmin();
    }

    public function delete($id) {
        if ($this->m_users->delete_user($id)) {
            redirect('Users', 'refresh');
            exit();
        }
    }

    function username_check($str) {
        if ($this->m_users->username_check($str)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function new_password_check($str) {
        if ($this->input->post('oldpass') != NULL && $this->input->post('password') == NULL) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function new_conpass_check($str) {
        if ($this->input->post('password') != NULL && $this->input->post('conpass') == NULL) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function new_username_check($str) {
        if ($this->m_users->new_username_check($str)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function oldpass_check($str) {
        if ($str == NULL) {
            return TRUE;
        } else {
            return $this->m_users->oldpass_check($str);
        }
    }

}
