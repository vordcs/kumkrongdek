<?php

class Activitys_ad extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_template');
        $this->load->model('m_activitys');
        $this->load->model('m_upload');
    }

    private $month_th = Array("", "มกราคม.", "กุมภาพันธ์.", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฏาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");

    public function index() {
        $this->m_activitys->clear_upload_temp();
        $data = array();
        $data['activitys'] = $this->m_activitys->get_activitys();
        $data['images_activity'] = $this->m_activitys->get_image_activity();
        $data['form'] = $this->m_activitys->set_form_search();
//        $this->m_template->set_Debug($data['form']);
        $this->m_template->set_Title('กิจกรรม');
        $this->m_template->set_Content('admin/activitys.php', $data);
        $this->m_template->showTemplateAdmin();
    }

    public function search_by_date() {
        $data = array();
        $data['form'] = $this->m_activitys->set_form_search();
        
        $data['activitys'] = $this->m_activitys->get_activitys();
        $data['images_activity'] = $this->m_activitys->get_image_activity();

        $this->m_template->set_Debug($this->input->post('date_search'));
        $this->m_template->set_Title('ผลลัพธ์');
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
            $date = $this->DateThai($row['publish_date']);
            $status = $row['activity_status'];
            $create = '  | สร้าง : ' . $this->DateTimeThai($row['create_date']) . ' โดย: ' . $row['create_by'];
            $update = 'แก้ไข : ' . $this->DateTimeThai($row['update_date']) . ' โดย: ' . $row['update_by'];
        }

        $data = array(
            'controller' => 'Activitys_ad',
            'img' => $img,
            'id' => $id,
            'title' => $title,
            'subtitle' => $subtitle,
            'date' => $date,
            'status' => $status,
            'content' => $content,
            'create' => $create,
            'update' => $update,
        );

        $data['images'] = $this->m_activitys->get_image_activity($id);

//        $this->m_template->set_Debug($data);
        $this->m_template->set_Title('รายละเอียด : ' . $title);
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

    function DateThai($strDate) {
        if ($strDate == NULL) {
            return '-';
        } else {
            $date = new DateTime($strDate);
            $strYear = date("Y", strtotime($strDate)) + 543;
            $strMonth = date("n", strtotime($strDate));
            $strDay = date("j", strtotime($strDate));
            $strHour = date("H", strtotime($strDate));
            $strMinute = date("i", strtotime($strDate));
            $strSeconds = date("s", strtotime($strDate));
            $strMonthCut = Array("", "มกราคม.", "กุมภาพัธ์.", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฏาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
            $strMonthThai = $strMonthCut[$strMonth];
            return "$strDay $strMonthThai $strYear";
        }
    }

    function DateTimeThai($strDate) {
        if ($strDate == NULL) {
            return '-';
        } else {
            $date = new DateTime($strDate);
            $strYear = date("Y", strtotime($strDate)) + 543;
            $strMonth = date("n", strtotime($strDate));
            $strDay = date("j", strtotime($strDate));
            $strHour = date("H", strtotime($strDate));
            $strMinute = date("i", strtotime($strDate));
            $strSeconds = date("s", strtotime($strDate));
            $strMonthCut = Array("", "มกราคม.", "กุมภาพัธ์.", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฏาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
            $strMonthThai = $strMonthCut[$strMonth];
            return "$strDay $strMonthThai $strYear " . " เวลา $strHour:$strMinute ";
        }
    }

}
