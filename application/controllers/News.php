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

        $data['news']=  $this->m_home->get_news();
        $data['news_type']=$this->m_home->get_news_type();
        
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

}
