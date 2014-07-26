<?php

class News extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_template');
        $this->load->model('m_news');
        $this->load->model('m_home');
    }

    public function index() {
        $data = array();

        $data = array();

        $data['news'] = $this->m_home->get_news();
        $data['news_type'] = $this->m_home->get_news_type();

        $data['file'] = $this->m_news->get_news_file();
        $data['form'] = $this->m_news->set_form_search();
        $data['strtitle'] = NULL;

        $type = (int) $this->input->post('type');
        $status = (int) $this->input->post('status');
        $date = $this->input->post('date_search');
        $s = array('ทั้งหมด', 'ไม่ใช้งาน', 'ใช้งาน');

        if (($type != 0 && $type != 1) || $status != 0 || $date != NULL) {
            $data['news'] = $this->m_news->search_news();

            $strtype = $this->m_news->get_news_type($type);

            $title = '';
            $title.=($status != 0 ? 'สถานะ  ' . $s[$status] : '');
            if ($type != 1) {
                $title .=($type != 0 ? ' ' . $strtype[0]['news_type_name'] : '' );
            }
            $title .= ($date != NULL ? ' : ' . $date : '');

            $data['strtitle'] = 'ผลการค้นหา : ' . $title;
        }


        $this->m_template->set_Title('ข่าว');
//        $this->m_template->set_Debug($data);
        $this->m_template->set_Content('news.php', $data);
        $this->m_template->showTemplate();
    }

    public function view_more($id) {

        $news = $this->m_home->get_news($id);
        foreach ($news as $row) {
            $img = $row['image_small'];
            $title = $row['news_title'];
            $subtitle = $row['news_subtitle'];
            $content = $row['news_content'];
            $type = $row['news_type'];
            $date = $this->m_datetime->DateThai($row['publish_date']);
            $status = $row['news_status'];
            $create = '  | สร้าง : ' . $this->m_datetime->DateTimeThai($row['create_date']) . ' โดย: ' . $row['create_by'];
            $update = 'แก้ไข : ' . $this->m_datetime->DateTimeThai($row['update_date']) . ' โดย: ' . $row['update_by'];
        }

        $data = array(
            'controller' => 'News',
            'page_title' => 'ข่าว',
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
        $data['file'] = $this->m_news->get_news_file($id);

        $strtype = $this->m_news->get_news_type($type);
        $data['type'] = $strtype[0]['news_type_name'];

        $new_all = $this->m_home->get_news();
        $relate = array();
        $i = 0;
        foreach ($new_all as $row) {
            if ($i < 4) {
                $temp = array(
                    'controller' => 'News',
                    'page_title' => 'ข่าว',
                    'img' => $row['image_small'],
                    'id' => $row['news_id'],
                    'title_article' => $row['news_title'],
                    'subtitle' => $row['news_subtitle'],
                    'content' => $row['news_content'],
                    'date' => $this->m_datetime->DateThai($row['publish_date']),
                );
                array_push($relate, $temp);
            }
            $i++;
        }

        $data['relate'] = $relate;

//        $this->m_template->set_Debug($data['relate']);
        $this->m_template->set_Title('ข่าว');
        $this->m_template->set_Content('detail.php', $data);
        $this->m_template->showTemplate();
    }

}
