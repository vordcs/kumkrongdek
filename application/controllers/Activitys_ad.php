<?php

class Activitys_ad extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_template');
        $this->load->model('m_activitys');
        $this->load->model('m_upload');
    }

    public function index() {
        $data = array();

        $data['activitys'] = $this->m_activitys->get_activitys();

//        $this->m_template->set_Debug($data);
        $this->m_template->set_Title('กิจกรรม');
        $this->m_template->set_Content('admin/activitys.php', $data);
        $this->m_template->showTemplateAdmin();
    }

    public function add() {

        if ($this->m_activitys->validation_add() && $this->form_validation->run() == TRUE) {
            $form_data = $this->m_activitys->get_post_form_add();
//            $this->m_template->set_Debug($form_data);
            //insert data
            $this->m_activitys->insert_activity($form_data);
            redirect('Activitys_ad');
        }
        //Load form add      
        $data['form'] = $this->m_activitys->set_form_add();
//        $this->m_template->set_Debug($data);
        $this->m_template->set_Title('เพิ่มกิจกรรม');
        $this->m_template->set_Content('admin/form_activity.php', $data);
        $this->m_template->showTemplateAdmin();
    }

    public function edit($id) {

        if ($this->m_activitys->validation_edit() && $this->form_validation->run() == TRUE) {
            $form_data = $this->m_activitys->get_post_form_edit($id);
//            $this->m_template->set_Debug($form_data);
            //update data
            $this->m_activitys->update_activity($id, $form_data);
            redirect('Activitys_ad');
        }
        //      get detail and sent to load form
        $detail = $this->m_activitys->get_activitys($id);
        $name = $detail[0]['activity_title'];
        if ($detail[0] != NULL) {
            $data['form'] = $this->m_activitys->set_form_edit($detail[0]);
            $data['detail'] = $detail[0];
        } else {
            redirect('Activitys_ad');
        }

//        $this->m_template->set_Debug($data);
        $this->m_template->set_Title('แก้ไขกิจกรรม : ' . $name);
        $this->m_template->set_Content('admin/form_activity.php', $data);
        $this->m_template->showTemplateAdmin();
    }

    public function delete($id) {
        $this->m_activitys->delete_activity($id);
        redirect('Activitys_ad');
    }

    public function unactive($activity_id) {
        $data = array(
            'activity_status' => '1',
        );

        $this->db->where('activity_id', $activity_id);
        $this->db->update('activitys', $data);

        redirect('Activitys_ad', 'refresh');
    }

    public function active($activity_id) {
        $data = array(
            'activity_status' => '2',
        );

        $this->db->where('activity_id', $activity_id);
        $this->db->update('activitys', $data);

        redirect('Activitys_ad', 'refresh');
    }

    public function textarea_check($str) {
        if ($str == '<br>') {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function type_check() {
        if ($this->input->post('activity_type') === '0') {
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
