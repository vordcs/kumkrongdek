<?php

class Activitys_ad extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_template');
        $this->load->model('m_activitys');
        $this->load->model('m_upload');
           if ($this->session->userdata('loged_in') != TRUE) {
            redirect('admin');
        }
    }

    public function index() {

        $data = array();

        $data['activitys'] = $this->m_activitys->get_activitys();
        $data['activity_types'] = $this->m_activitys->get_activity_type();
        $data['images_activity'] = $this->m_activitys->get_image_activity();
        $data['form'] = $this->m_activitys->set_form_search();
        $data['strtitle'] = NULL;

        $type = (int) $this->input->post('type');
        $status = (int) $this->input->post('status');
        $date = $this->input->post('date_search');
        $s = array('ทั้งหมด', 'ไม่ใช้งาน', 'ใช้งาน');


        if (($type != 0 && $type != 1) || $status != 0 || $date != NULL) {
            $data['activitys'] = $this->m_activitys->search_activitys();
            $t = $this->m_activitys->get_activity_type();
            $title = '';
//            $name .= ($year_no != 0 ? ' ปีที่ ' . $year_no : '' );
            $title.=($status != 0 ? 'สถานะ  ' . $s[$status] . '->' : '');
            $title .=($type != 0 ? ' ' . $t[0]['activity_type_name'] : '');
            $title .= ($date != NULL ? ' : ' . $date : '');

            $data['strtitle'] = 'ผลการค้นหา : ' . $title;
        }
//        $this->m_template->set_Debug($type);
        $this->m_template->set_Title('กิจกรรม');
        $this->m_template->set_Content('admin/activitys.php', $data);
        $this->m_template->showTemplateAdmin();
    }

    public function search() {

        $data = array();
        $type = (int) $this->input->post('type');
        $status = (int) $this->input->post('status');
        $date = $this->input->post('date_search');


        if ($status == 0 && $date == NULL) {
            redirect('Activitys_ad');
        }
        $s = array('ทั้งหมด', 'ไม่ใช้งาน', 'ใช้งาน');


        if ($date == NULL) {
            $title = $s[$status];
        } else {
            $title = $date;
        };

//        $data['activitys'] = $this->m_activitys->get_activitys();
        $data['activitys'] = $this->m_activitys->search_activitys();
        $data['images_activity'] = $this->m_activitys->get_image_activity();
        $data['form'] = $this->m_activitys->set_form_search();
        $data['strtitle'] = 'ผลการค้นหา : ' . $title;
//        $d['send']=$date_[0];
//        $d['return']=$month;
//        $this->m_template->set_Debug($d);
        $this->m_template->set_Title('กิจกรรม');
        $this->m_template->set_Content('admin/activitys.php', $data);
        $this->m_template->showTemplateAdmin();
    }

    public function view_more($id) {

        $activitys = $this->m_activitys->get_activitys($id);
        foreach ($activitys as $row) {
            $img = $row['image_small'];
            $title = $row['activity_title'];
            $subtitle = $row['activity_subtitle'];
            $content = $row['activity_content'];
            $type = $row['activity_type'];
            $date = $this->m_datetime->DateThai($row['publish_date']);
            $status = $row['activity_status'];
            $create = '  | สร้าง : ' . $this->m_datetime->DateTimeThai($row['create_date']) . ' โดย: ' . $row['create_by'];
            $update = 'แก้ไข : ' . $this->m_datetime->DateTimeThai($row['update_date']) . ' โดย: ' . $row['update_by'];
        }

        $data = array(
            'controller' => 'Activitys_ad',
            'img' => $img,
            'id' => $id,
            'title_article' => $title,
            'subtitle' => $subtitle,
            'date' => $date,
            'status' => $status,
            'content' => $content,
            'create' => $create,
            'update' => $update,
        );

        $data['images'] = $this->m_activitys->get_image_activity($id);
        $data['file'] = NULL;
        $strtype = $this->m_activitys->get_activity_type($type);
        $data['type'] = $strtype[0]['activity_type_name'];
//        $this->m_template->set_Debug($data);
        $this->m_template->set_Title('กิจกรรม');
        $this->m_template->set_Content('admin/detail.php', $data);
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

    public function set_highlight($id, $controller) {
        $data = array(
            'activity_highlight' => '1',
        );
        $this->db->where('activity_id', $id);
        $this->db->update('activitys', $data);
        redirect($controller);
    }

    public function un_highlight($id, $controller) {
        $data = array(
            'activity_highlight' => '0',
        );
        $this->db->where('activity_id', $id);
        $this->db->update('activitys', $data);
        redirect($controller);
    }

    public function textarea_check($str) {
        if ($str == '<br>') {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function type_check() {
        if ($this->input->post('activity_type') === '1') {
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
