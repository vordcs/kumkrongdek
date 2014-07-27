<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class m_login extends CI_Model {

    function stamp_time_login($id) {
        $dt_now = date('Y-m-d H:i:s');
        $data = array(
            'last_login' => $dt_now
        );

        $this->db->where('user_id', $id);
        $this->db->update('users', $data);
        return TRUE;
    }

    function select_user($user, $pass) {
        try {
            $this->db->select('*');
            $this->db->from('users');
            $this->db->where('username', $user);
            $this->db->where('password', md5($pass));
            $query = $this->db->get();
            $result = $query->row_array();
            $this->stamp_time_login($result['user_id']);
            $result['loged_in'] = TRUE;
            $this->session->set_userdata($result);
            return $result;
        } catch (Exception $e) {
            return FALSE;
        }
    }

    public function set_form() {
        $i_username = array(
            'type' => 'text',
            'name' => 'username',
            'maxlength' => '20',
            'value' => set_value('username'),
            'class' => 'form-control',
            'placeholder' => 'Username',
            'autofocus' => ''
        );
        $i_password = array(
            'type' => 'password',
            'name' => 'password',
            'maxlength' => '32',
            'value' => set_value('password'),
            'class' => 'form-control',
            'placeholder' => 'Password'
        );
       
        $all_form = array(
            'username' => form_input($i_username),
            'password' => form_input($i_password),
        );
        return $all_form;
    }

    public function set_validation() {
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|callback_username_check');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_password_check');
     
        return TRUE;
    }

    function get_post() {
        $get_page_data = array(
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
        );
        return $get_page_data;
    }

    public function username_check($usr) {
        $this->db->where('username', $usr);
        $query = $this->db->get('users');
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function password_check($pass) {
        $this->db->where('password', md5($pass));
        $query = $this->db->get('users');

        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
