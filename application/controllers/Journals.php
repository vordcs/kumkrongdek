<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Journals extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_template');
        $this->load->model('m_journals');
    }

    private $month_th = Array("", "มกราคม.", "กุมภาพันธ์.", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฏาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");

    public function index() {

        $data = array();
        $data['journals'] = $this->m_journals->get_journals();
        $data['form'] = $this->m_journals->set_form_search('Journals');
        $data['strtitle'] = NULL;

        $year_no = $this->input->post('year_no');
        $issue = $this->input->post('issue');
        $month = $this->input->post('month');
        $year = $this->input->post('year');

        if ($year_no != 0 | $issue != 0 | $month != 0 | $year != NULL) {

            $data['journals'] = $this->m_journals->search_journals();

            $name = 'ผลการค้นหาวารสาร : ';
            $name .= ($year_no != 0 ? ' ปีที่ ' . $year_no : '' );
            $name .= ($issue != 0 ? '  ฉบับที่ ' . $issue : '');
            $name .= ($month != 0 ? ' ประจำเดือน ' . $this->month_th[(int) $month] : '');
            $name .= ' ' . $year;

            $data['strtitle'] = $name;
        }

//        $this->m_template->set_Debug($data);
        $this->m_template->set_Title('จดหมายข่าว');
        $this->m_template->set_Content('admin/journals.php', $data);
        $this->m_template->showTemplateAdmin();
    }

    public function add() {
        if ($this->m_journals->validation_add() && $this->form_validation->run() == TRUE) {
            $form_data = $this->m_journals->get_post_form_add();
            $this->m_template->set_Debug($form_data);
            //insert data
            $this->m_journals->insert_journal($form_data);
//            redirect('Journals');
        }
        //Load form add
        $data['form'] = $this->m_journals->set_form_add();
//        $this->m_template->set_Debug($data);
        $this->m_template->set_Title('เพิ่มจดหมายข่าว');
        $this->m_template->set_Content('admin/form_journals.php', $data);
        $this->m_template->showTemplateAdmin();
    }

    public function edit($id) {
        if ($this->m_journals->validation_edit($id) && $this->form_validation->run() == TRUE) {
            $form_data = $this->m_journals->get_post_form_edit($id);
            //Update data
            $this->m_journals->update_journal($id, $form_data);
            redirect('Journals');
        }
        //      get detail and sent to load form
        $detail = $this->m_journals->get_journals($id);
        $month_th = Array("", "มกราคม.", "กุมภาพันธ์.", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฏาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
        $name = ' ปีที่ ' . $detail[0]['journal_year_no'];
        $name .= '  ฉบับที่ ' . $detail[0]['journal_issue'];
        $name .= ' ประจำเดือน ' . $month_th[$detail[0]['journal_mounth']];
        $name .= ' ' . $detail[0]['journal_year'];

        if ($detail[0] != NULL) {
            $data['form'] = $this->m_journals->set_form_edit($detail[0]);
            $data['detail'] = $detail[0];
        } else {
            redirect('Journals');
        }
//        $this->m_template->set_Debug($data);
        $this->m_template->set_Title('แก้ไขจดหมายข่าว : ' . $name);
        $this->m_template->set_Content('admin/form_journals.php', $data);
        $this->m_template->showTemplateAdmin();
    }

    public function delete($id) {
        $this->m_journals->delete_journal($id);
        redirect('Journals');
    }

    public function textarea_check($str) {
        if ($str == '<br>') {
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
