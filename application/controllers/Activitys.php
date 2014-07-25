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

    public function view_more($id) {


        $activitys = $this->m_activitys->get_activitys($id);
        $images_activity = $this->m_activitys->get_image_activity();

        $data['images'] = NULL;
        $controller = "Activitys";
        $activitys = $this->m_activitys->get_activitys($id);
        foreach ($activitys as $row) {
            $img = $row['image_small'];
            $title = $row['activity_title'];
            $subtitle = $row['activity_subtitle'];
            $content = $row['activity_content'];
            $date = $this->m_datetime->DateThai($row['publish_date']);
            $status = $row['activity_status'];
            $create = '  | สร้าง : ' . $this->m_datetime->DateTimeThai($row['create_date']) . ' โดย: ' . $row['create_by'];
            $update = 'แก้ไข : ' . $this->m_datetime->DateTimeThai($row['update_date']) . ' โดย: ' . $row['update_by'];
        }

        $data = array(
            'controller' => $controller,
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
//
//        $this->m_template->set_Debug($kindness);
        $this->m_template->set_Title('รายละเอียด : ' . $title);
        $this->m_template->set_Content('detail.php', $data);
        $this->m_template->showTemplate();
    }

}
