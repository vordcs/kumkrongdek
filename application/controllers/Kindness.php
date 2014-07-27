<?php

class Kindness extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_template');
        $this->load->model('m_kindness');
        $this->load->model('m_home');
    }

    public function index() {
        $data = array();
        $data['kindness'] = $this->m_home->get_kindness();
        
        $data['highlight']=  $this->m_home->get_highlight();

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
            $create = '  | สร้าง : ' . $this->m_datetime->DateTimeThai($row['create_date']) . ' โดย: ' . $row['create_by'];
            $update = 'แก้ไข : ' . $this->m_datetime->DateTimeThai($row['update_date']) . ' โดย: ' . $row['update_by'];
        }
        $controller = 'Kindness';
        
        $data = array(
            'controller' => 'Kindness',
            'page_title' => 'ผู้ใหญ่ใจดี',
            'id' => $id,
            'img' => $img,
            'title_article' => $title,
            'subtitle' => $subtitle,
            'date' => $date,
            'status' => $status,
            'content' => $content,
        );
//
        $data['images'] = NULL;
        $data['file'] = NULL;
        $data['type'] = NULL;
        
        $data['page_title'] = 'ผู้ใหญ่ใจดี';
        $data['controller'] = $controller;
        
        $new_all = $this->m_kindness->get_kindness();
        $relate = array();
        $i = 0;
        foreach ($new_all as $row) {
            if ($i < 4) {
                $temp = array(
                    'controller' => 'Kindness',
                    'page_title' => 'ผู้ใหญ่ใจดี',
                    'img' => $row['image_small'],
                    'id' => $row['kindness_id'],
                    'title_article' => $row['kindness_title'],
                    'subtitle' => $row['kindness_subtitle'],
                    'content' => $row['kindness_content'],
                    'date' => $this->m_datetime->DateThai($row['publish_date']),
                );
                array_push($relate, $temp);
            }
            $i++;
        }
        
        $data['relate'] = $relate;
        
//        $this->m_template->set_Debug($kindness);
        $this->m_template->set_Title('รายละเอียด : ' . $title);
        $this->m_template->set_Content('detail.php', $data);
        $this->m_template->showTemplate();
    }

}
