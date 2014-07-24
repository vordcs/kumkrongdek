<?php

class Kindness_ad extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_template');
        $this->load->model('m_kindness');
    }

    public function index() {
        $data = array();

        $data['kindness'] = $this->m_kindness->get_kindness();
        $data['form'] = $this->m_kindness->set_form_search();
//        $this->m_template->set_Debug($data['form']);
        $this->m_template->set_Title('ผู้ใหญ่ใจดี');
        $this->m_template->set_Content('admin/kindness.php', $data);
        $this->m_template->showTemplateAdmin();
    }

    public function add() {
        $data = array();
        if ($this->m_kindness->validation_add() == TRUE && $this->form_validation->run() == TRUE) {
            $form_data = $this->m_kindness->get_post_form_add();
            $this->m_template->set_Debug($form_data);
            //insert data
            $this->m_kindness->insert_kindness($form_data);
//            redirect('Kindness_ad');
        }

//        Load form add        
        $data['form'] = $this->m_kindness->set_form_add();
//        $this->m_template->set_Debug($data);
        $this->m_template->set_Title('เพิ่มผู้ใหญ่ใจดี');
        $this->m_template->set_Content('admin/form_kindness.php', $data);
        $this->m_template->showTemplateAdmin();
    }

    public function edit($id) {

        if ($this->m_kindness->validation_edit() && $this->form_validation->run() == TRUE) {
            $form_data = $this->m_kindness->get_post_form_edit($id);
//            $this->m_template->set_Debug($form_data);
            //update data
            $this->m_kindness->update_kindness($id, $form_data);
            redirect('Kindness_ad');
        }
        //      get detail and sent to load form
        $detail = $this->m_kindness->get_kindness($id);
        $name = $detail[0]['kindness_title'];
        if ($detail[0] != NULL) {
            $data['form'] = $this->m_kindness->set_form_edit($detail[0]);
            $data['detail'] = $detail[0];
        } else {
            redirect('Kindness_ad');
        }

//        $this->m_template->set_Debug($data);
        $this->m_template->set_Title('แก้ไขผู้ใหญ่ใจดี : ' . $name);
        $this->m_template->set_Content('admin/form_kindness.php', $data);
        $this->m_template->showTemplateAdmin();
    }

    public function delete($id) {
        $this->m_activitys->delete_activity($id);
        redirect('Kindness_ad');
    }

    public function search() {

        $data = array();

        $status = (int) $this->input->post('status');
        $date = $this->input->post('date_search');

        if ($status == 0 && $date == NULL) {
            redirect('Kindness_ad');
        }
        $s = array('ทั้งหมด', 'ไม่ใช้งาน', 'ใช้งาน');
        if ($date == NULL) {
            $title = $s[$status];
        } else {
            $title = $date;
        };

        $data['kindness'] = $this->m_kindness->search_kindness($status, $date);
        $data['form'] = $this->m_kindness->set_form_search();

        $this->m_template->set_Title('ผลการค้นหา : ' . $title);
        $this->m_template->set_Content('admin/kindness.php', $data);
        $this->m_template->showTemplateAdmin();
    }

    public function unactive($kindness_id) {
        $data = array(
            'kindness_status' => '1',
        );

        $this->db->where('kindness_id', $kindness_id);
        $this->db->update('kindness', $data);

        redirect('Kindness_ad', 'refresh');
    }

    public function active($kindness_id) {
        $data = array(
            'kindness_status' => '2',
        );

        $this->db->where('kindness_id', $kindness_id);
        $this->db->update('kindness', $data);

        redirect('kindness_ad', 'refresh');
    }

    public function view_more($id) {

        $kindness = $this->m_kindness->get_kindness($id);
        foreach ($kindness as $row) {

            $img = $row['image_small'];
            $title = $row['kindness_title'];
            $subtitle = $row['kindness_subtitle'];
            $content = $row['kindness_content'];
            $date = $this->DateThai($row['publish_date']);
            $status = $row['kindness_status'];
            $create = '  | สร้าง : ' . $this->DateTimeThai($row['create_date']) . ' โดย: ' . $row['create_by'];
            $update = 'แก้ไข : ' . $this->DateTimeThai($row['update_date']) . ' โดย: ' . $row['update_by'];
        }
//
        $data = array(
            'controller' => 'Kindness_ad',
            'id' => $id,
            'img' => $img,
            'title' => $title,
            'subtitle' => $subtitle,
            'date' => $date,
            'status' => $status,
            'content' => $content,
            'create' => $create,
            'update' => $update,
        );
//
        $data['images'] = NULL;

//        $this->m_template->set_Debug($kindness);
        $this->m_template->set_Title('รายละเอียด : ' . $title);
        $this->m_template->set_Content('admin/detail.php', $data);
        $this->m_template->showTemplateAdmin();
    }

    function DateThai($strDate) {
        if ($strDate == NULL) {
            return '-';
        } else {
            $date = new DateTime($strDate);
            $strYear = date("Y", strtotime($strDate));
            $strMonth = date("n", strtotime($strDate));
            $strDay = date("j", strtotime($strDate));
            $strHour = date("H", strtotime($strDate));
            $strMinute = date("i", strtotime($strDate));
            $strSeconds = date("s", strtotime($strDate));
            $strMonthCut = Array("", "มกราคม", "กุมภาพัธ์.", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฏาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
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

    public function textarea_check($str) {
        if ($str == '<br>') {
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
