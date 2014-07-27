<?php

class Newsletters extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_template');
        $this->load->model('m_journals');
        $this->load->model('m_home');
    }

    public function index() {

        $data = array();
        $data['newsletters'] = $this->m_home->get_newsletters();
        $data['form'] = $this->m_journals->set_form_search('Newsletters');
        $data['strtitle'] = NULL;

        $year_no = $this->input->post('year_no');
        $issue = $this->input->post('issue');
        $month = $this->input->post('month');
        $year = $this->input->post('year');

        if ($year_no != 0 | $issue != 0 | $month != 0 | $year != NULL) {

            $data['newsletters'] = $this->m_journals->search_journals($this->m_datetime->getDateTodayTH());

            $name = 'ผลการค้นหาวารสาร : ';
            $name .= ($year_no != 0 ? ' ปีที่ ' . $year_no : '' );
            $name .= ($issue != 0 ? '  ฉบับที่ ' . $issue : '');
            $name .= ($month != 0 ? ' ประจำเดือน ' . $this->m_datetime->getMonthThai((int) $month) : '');
            $name .= ' ' . $year;

            $data['strtitle'] = $name;
        }

//        $this->m_template->set_Debug($data);
        $this->m_template->set_Title('จดหมายข่าว');
        $this->m_template->set_Content('newsletters.php', $data);
        $this->m_template->showTemplate();
    }

}
