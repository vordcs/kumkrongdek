<?php

class Kindness extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_template');
        $this->load->model('m_kindness');
    }

    public function index() {
        $data = array();
        $data['kindness'] = $this->m_kindness->get_kindness();

        //        $this->m_template->set_Debug($data['activity_types']);
        $this->m_template->set_Content('kindness.php', $data);
        $this->m_template->showTemplate();
    }

    public function view_more($id) {

        $kindness = $this->m_kindness->get_kindness($id);
        foreach ($kindness as $row) {

            $img = $row['image_small'];
            $title = $row['kindness_title'];
            $subtitle = $row['kindness_subtitle'];
            $content = $row['kindness_content'];
            $date = $this->m_datetime->DateThai($row['publish_date']);
            $status = $row['kindness_status'];
        }
        $controller = 'Kindness';
        $data = array(
            'controller' => 'Kindness',
            'id' => $id,
            'img' => $img,
            'title' => $title,
            'subtitle' => $subtitle,
            'date' => $date,
            'status' => $status,
            'content' => $content,
        );
//
        $data['images'] = NULL;
        $data['page_title'] = 'ผู้ใหญ่ใจดี';
        $data['controller'] = $controller;
//        $this->m_template->set_Debug($kindness);
        $this->m_template->set_Title('รายละเอียด : ' . $title);
        $this->m_template->set_Content('detail.php', $data);
        $this->m_template->showTemplate();
    }

}
