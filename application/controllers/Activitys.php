<?php

class Activitys extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_template');
        $this->load->model('m_activitys');
        $this->load->model('m_home');
        
    }

    public function index() {

        $data = array();
        $data['activitys'] = $this->m_home->get_activitys();
        $data['activity_types'] = $this->m_home->get_activity_type();
        $data['images_activity'] = $this->m_activitys->get_image_activity();
        $data['form'] = $this->m_activitys->set_form_search('Activitys');
        $data['strtitle'] = NULL;
        
        $data['highlight']=  $this->m_home->get_highlight();

//        $this->m_template->set_Debug($data['activitys']);
        $this->m_template->set_Title('กิจกรรม');
        $this->m_template->set_Content('activitys.php', $data);
        $this->m_template->showTemplate();
    }

    public function view_more($id) {

        $activitys = $this->m_activitys->get_activitys($id);
        foreach ($activitys as $row) {
            
            $img = $row['image_small'];
            $title = $row['activity_title'];
            $subtitle = $row['activity_subtitle'];
            $content = $row['activity_content'];
            $date = $this->m_datetime->DateThai($row['publish_date']);
            $type = $row['activity_type'];
            $status = $row['activity_status'];
            $create = '  | สร้าง : ' . $this->m_datetime->DateTimeThai($row['create_date']) . ' โดย: ' . $row['create_by'];
            $update = 'แก้ไข : ' . $this->m_datetime->DateTimeThai($row['update_date']) . ' โดย: ' . $row['update_by'];
        }
        $controller = "Activitys";
        
        $data = array(
            'controller' => 'Activitys',
            'page_title' => 'กิจกรรม',
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
        
        $data['images'] = NULL;
        $data['file'] = NULL;
        
        $strtype = $this->m_home->get_activity_type($type);
        $data['type'] = $strtype[0]['activity_type_name'];

        $data['images'] = $this->m_activitys->get_image_activity($id);
        $data['page_title'] = 'กิจกรรม';
        $data['controller'] = $controller;
        
        $new_all = $this->m_home->get_activitys();
        $relate = array();
        $i = 0;
        foreach ($new_all as $row) {
            if ($i < 4) {
                $temp = array(
                    'controller' => 'Activitys',
                    'page_title' => 'กิจกรรม',
                    'img' => $row['image_small'],
                    'id' => $row['activity_id'],
                    'title_article' => $row['activity_title'],
                    'subtitle' => $row['activity_subtitle'],
                    'content' => $row['activity_content'],
                    'date' => $this->m_datetime->DateThai($row['publish_date']),
                );
                array_push($relate, $temp);
            }
            $i++;
        }

        $data['relate'] = $relate;
//
//        $this->m_template->set_Debug($kindness);
        $this->m_template->set_Title('กิจกรรม : ' . $title);
        $this->m_template->set_Content('detail.php', $data);
        $this->m_template->showTemplate();
    }

}
