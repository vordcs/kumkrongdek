<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class m_Users extends CI_Model {

    public function insert_user($data) {
        $this->db->insert('users', $data);
        return true;
    }

    public function update_user($id, $data) {
        try {
            $this->db->where('user_id', $id);
            $this->db->update('users', $data);
            return TRUE;
        } catch (Exception $exc) {
            return FALSE;
        }
    }

    public function delete_user($id) {
        try {
            $this->db->where('user_id', $id);
            $this->db->delete('users');
            return TRUE;
        } catch (Exception $exc) {
            return FALSE;
        }
    }

    function set_form_add() {
        $f_first_name = array(
            'name' => 'first_name',
            'class' => 'form-control',
            'placeholder' => 'ชื่อ',
            'value' => set_value('first_name'));

        $f_last_name = array(
            'name' => 'last_name',
            'class' => 'form-control',
            'placeholder' => 'นามสกุล',
            'value' => set_value('last_name'));
        $f_username = array(
            'name' => 'username',
            'class' => 'form-control',
            'placeholder' => 'ชื่อเข้าใช้ระบบ',
            'value' => set_value('username'));
        $f_password = array(
            'name' => 'password',
            'type' => 'password',
            'class' => 'form-control',
            'placeholder' => 'รหัสผ่าน',
            'value' => set_value('password'));
        $f_conpass = array(
            'name' => 'conpass',
            'type' => 'password',
            'class' => 'form-control',
            'placeholder' => 'ยืนยันรหัสผ่าน',
            'value' => set_value('conpass'));
        $form_add = array(
            'form' => form_open_multipart('Users/add', array('class' => 'form-horizontal', 'id' => 'form_slide')),
            'first_name' => form_input($f_first_name),
            'last_name' => form_input($f_last_name),
            'username' => form_input($f_username),
            'old_username' => NULL,
            'password' => form_input($f_password),
            'conpass' => form_input($f_conpass),
            'oldpass' => NULL
        );
        return $form_add;
    }

    function set_form_edit($data) {
        $f_first_name = array(
            'name' => 'first_name',
            'class' => 'form-control',
            'placeholder' => 'ชื่อ',
            'value' => (set_value('first_name') == NULL) ? $data ['first_name'] : set_value('first_name'));
        $f_last_name = array(
            'name' => 'last_name',
            'class' => 'form-control',
            'placeholder' => 'นามสกุล',
            'value' => (set_value('last_name') == NULL) ? $data ['last_name'] : set_value('last_name'));
        $f_username = array(
            'name' => 'username',
            'class' => 'form-control',
            'placeholder' => 'ชื่อเข้าใช้ระบบ',
            'value' => (set_value('username') == NULL) ? $data ['username'] : set_value('username'));
        $f_old_username = array(
            'name' => 'username',
            'class' => 'form-control hidden',
            'placeholder' => 'ชื่อเข้าใช้ระบบ',
            'value' => (set_value('username') == NULL) ? $data ['username'] : set_value('username'));
        $f_oldpass = array(
            'name' => 'oldpass',
             'type'=>'password',
            'class' => 'form-control ',
            'placeholder' => 'รหัสผ่านเดิม',
            'value' => set_value('oldpass'),
        );
        $f_password = array(
            'name' => 'password',
            'type' => 'password',
            'class' => 'form-control',
            'placeholder' => 'รหัสผ่านใหม่',
            'value' => set_value('password')
        );
        $f_conpass = array(
            'name' => 'conpass',
            'type' => 'password',
            'class' => 'form-control',
            'placeholder' => 'ยืนยันรหัสผ่านใหม่',
//            'value' => set_value('conpass')
        );
        $form_add = array(
            'form' => form_open_multipart('Users/edit/' . $data['user_id'], array('class' => 'form-horizontal', 'id' => 'form_slide')),
            'first_name' => form_input($f_first_name),
            'last_name' => form_input($f_last_name),
            'username' => form_input($f_username),
            'old_username' => form_input($f_old_username),
            'password' => form_input($f_password),
            'conpass' => form_input($f_conpass),
            'oldpass' => form_input($f_oldpass)
        );
        return $form_add;
    }

    function validation_add() {
        $this->form_validation->set_rules('first_name', 'ชื่อ', 'required|trim|xss_clean');
        $this->form_validation->set_rules('last_name', 'นามสกุล', 'required|trim|xss_clean');
        $this->form_validation->set_rules('username', 'ชื่อเข้าใช้ระบบ', 'required|trim|xss_clean|callback_username_check');
        $this->form_validation->set_rules('password', 'รหัสผ่าน', 'required|trim|xss_clean|min_length[4]|max_length[32]');
        $this->form_validation->set_rules('conpass', 'ยืนยันรหัสผ่าน', 'required|trim|xss_clean|matches[password]');

        $this->form_validation->set_message('username_check', 'ชื่อผู้ใช้งานถูกใช้งานเเล้ว');
        return TRUE;
    }

    function validation_edit() {
        $this->form_validation->set_rules('first_name', 'ชื่อ', 'required|trim|xss_clean');
        $this->form_validation->set_rules('last_name', 'นามสกุล', 'required|trim|xss_clean');
        $this->form_validation->set_rules('username', 'ชื่อเข้าใช้ระบบ', 'required|trim|xss_clean|callback_new_username_check');
        $this->form_validation->set_rules('oldpass', 'ชื่อเข้าใช้ระบบ', 'trim|xss_clean|callback_oldpass_check');
        $this->form_validation->set_rules('password', 'รหัสผ่าน', 'trim|xss_clean|min_length[4]|max_length[32]|callback_new_password_check');
        $this->form_validation->set_rules('conpass', 'ยืนยันรหัสผ่าน', 'trim|xss_clean|matches[password]|callback_new_conpass_check');


        $this->form_validation->set_message('new_username_check', '%s ถูกใช้งานเเล้ว');
        $this->form_validation->set_message('oldpass_check', 'รหัสผ่านเดิมไม่ถูกต้อง');
        $this->form_validation->set_message('new_password_check', 'กรุณาใส่รหัสผ่านใหม่');
        $this->form_validation->set_message('new_conpass_check', 'ยืนยันรหัสผ่านใหม่');

        return TRUE;
    }

    function get_post_form_add() {
        $get_page_data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'username' => $this->input->post('username'),
            'password' => md5($this->input->post('password')),
        );

        return $get_page_data;
    }

    function get_post_form_edit() {
        $get_page_data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'username' => $this->input->post('username'),
        );
        if ($this->input->post('password') != NULL) {
            $get_page_data['password'] = md5($this->input->post('conpass'));
        }

        return $get_page_data;
    }

    function get_users($id = NULL) {
        if ($id != NULL) {
            $this->db->where('user_id', $id);
        }
        $query = $this->db->get('users');
        $rs = $query->result_array();
        return $rs;
    }

    public function username_check($str) {
        $this->db->where('username', $str);
        $query = $this->db->get('users');
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function new_username_check($new) {
        $old = $this->input->post('old_username');
        if ($old == $new) {
            return FALSE;
        } else {
            $this->db->where('username', $new);
//            $this->db->where('username !=', $old);
            $query = $this->db->get('users');
            if ($query->num_rows() > 0) {
                $rs = $query->row_array();
                if ($old == $rs['username']) {
                    return FALSE;
                } else {
                    return TRUE;
                }
            } else {
                return FALSE;
            }
        }
    }

    function oldpass_check($pass) {
        $this->db->where('password', md5($pass));
        $query = $this->db->get('users');

        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
