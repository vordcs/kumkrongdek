<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class m_journals extends CI_Model {

    public function set_form_add() {
        $f_year = array(
            'name' => 'journal_year',
            'class' => 'form-control',
            'placeholder' => 'ปีที่',
            'value' => set_value('journal_year')
        );

        $f_issue = array(
            'name' => 'journal_issue',
            'class' => 'form-control',
            'placeholder' => 'ฉบับที่',
            'value' => set_value('journal_issue')
        );

        $f_publish_date = array(
            'name' => 'publish_date',
            'id' => 'publish_date',
            'class' => 'form-control',
            'placeholder' => 'ประจำเดือน',
            'value' => set_value('publish_date')
        );

        $f_adviser = array(
            'name' => 'adviser',
            'class' => 'form-control',
            'row'=>'2',
            'placeholder' => 'ที่ปรึกษา',
            'value' => set_value('adviser')
        );

        $f_editor = array(
            'name' => 'editor',
            'class' => 'form-control',
            'placeholder' => 'บรรณาธิการ',
            'value' => set_value('editor')
        );

        $f_prepared_by = array(
            'name' => 'prepared_by',
            'class' => 'form-control',
            'placeholder' => 'ผู้จัดทำ',
            'value' => set_value('prepared_by')
        );

        $f_file = array(
            'name' => 'journal__file',
            'class' => 'form-control'
        );

        $f_highlight = array(
            '0' => 'ทั่วไป',
            '1' => 'เด่น',
        );

        $f_status = array(
            '2' => 'ใช้งาน',
            '1' => 'ไม่ใช้งาน',
        );
        $form_add = array(
            'form' => form_open_multipart('Journals/add', array('class' => 'form-horizontal', 'id' => 'form_slide')),
            'journal_year' => form_input($f_year),
            'journal_issue' => form_input($f_issue),
            'publish_date' => form_input($f_publish_date),
            'adviser' => form_textarea($f_adviser),
            'editor' => form_input($f_editor),
            'prepared_by' => form_input($f_prepared_by),
            'journal_file' => form_upload($f_file),
            'journal_status' => form_dropdown('journal_status', $f_status, set_value('journal_status'), 'class="form-control"'),
            'journals_highlight' => form_dropdown('journals_highlight', $f_highlight, set_value('journals_highlight'), 'class="form-control"'),
            'file' => NULL,
        );
        return $form_add;
    }

    function validation_add() {
        $this->form_validation->set_rules('journal_year', 'ปีที่', 'required|trim|xss_clean');
        $this->form_validation->set_rules('journal_issue', 'ฉบับที่', 'required|trim|xss_clean');
        $this->form_validation->set_rules('publish_date', 'ประจำเดือน', 'required|trim|xss_clean');
        $this->form_validation->set_rules('adviser', 'ที่ปรึกษา', 'required|trim|xss_clean');
        $this->form_validation->set_rules('editor', 'บรรณาธิการ', 'required|trim|xss_clean');
        $this->form_validation->set_rules('prepared_by', 'ผู้จัดทำ', 'required|trim|xss_clean');

        if (empty($_FILES['journal_file']['name'])) {
            $this->form_validation->set_rules('journal_file', 'เอกสาร', 'required|xss_clean');
        }

        return TRUE;
    }

    function validation_edit() {
        $this->form_validation->set_rules('journal_year', 'ปีที่', 'required|trim|xss_clean');
        $this->form_validation->set_rules('journal_issue', 'ฉบับที่', 'required|trim|xss_clean');
        $this->form_validation->set_rules('publish_date', 'ประจำเดือน', 'required|trim|xss_clean');
        if (empty($_FILES['journal_file']['name'])) {
            $this->form_validation->set_rules('journal_file', 'เอกสาร', 'xss_clean');
        }

        return TRUE;
    }

    function get_post_form_add() {

        $get_page_data = array(
            'journal_year' => $this->input->post('journal_year'),
            'journal_issue' => $this->input->post('journal_issue'),
            'publish_date' => $this->input->post('publish_date'),
            'journal_file' => $this->upload_file('journal_file'),
            'slide_status' => $this->input->post('slide_status'),
            'create_date' => $this->getDatetimeNow(),
        );

        return $get_page_data;
    }

    public function set_form_edit() {
        $f_year = array(
            'name' => 'journal_year',
            'class' => 'form-control',
            'placeholder' => 'ปีที่',
            'value' => set_value('journal_year')
        );

        $f_issue = array(
            'name' => 'journal_issue',
            'class' => 'form-control',
            'placeholder' => 'ฉบับที่',
            'value' => set_value('journal_issue')
        );

        $f_publish_date = array(
            'name' => 'publish_date',
            'id' => 'publish_date',
            'class' => 'form-control',
            'placeholder' => 'ประจำเดือน',
            'value' => set_value('')
        );
        $f_file = array(
            'name' => 'journal__file',
            'class' => 'form-control'
        );

        $f_highlight = array(
            '0' => 'ทั่วไป',
            '1' => 'เด่น',
        );

        $f_status = array(
            '2' => 'ใช้งาน',
            '1' => 'ไม่ใช้งาน',
        );
        $form_add = array(
            'form' => form_open_multipart('Journals/add', array('class' => 'form-horizontal', 'id' => 'form_slide')),
            'journal_year' => form_input($f_year),
            'journal_issue' => form_input($f_issue),
            'publish_date' => form_input($f_publish_date),
            'journal_file' => form_upload($f_file),
            'journal_status' => form_dropdown('journal_status', $f_status, set_value('journal_status'), 'class="form-control"'),
            'journals_highlight' => form_dropdown('journals_highlight', $f_highlight, set_value('journals_highlight'), 'class="form-control"'),
            'file' => NULL,
        );
        return $form_add;
    }

}
