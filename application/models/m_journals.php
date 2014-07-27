<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class m_journals extends CI_Model {

    function getDatetimeNow() {
        return date('Y-m-d H:i:s');
    }

    public function insert_journal($f_data) {
        $this->db->insert('journals', $f_data);
    }

    public function update_journal($journal_id, $f_data) {
        $this->db->where('journal_id', $journal_id);
        $this->db->update('journals', $f_data);
    }

    public function delete_journal($journal_id) {

        //delete file in folder
        $file_id = $this->get_file_id($journal_id);
        $this->deleteFile($file_id);

        //delete journal
        $this->db->where('journal_id', $journal_id);
        $this->db->delete('journals');

        //delete file in database
        $this->db->where('file_id', $file_id);
        $this->db->delete('files');
    }

    function search_journals($date = NULL) {

        (int) $year_no = $this->input->post('year_no');
        (int) $issue = $this->input->post('issue');
        (int) $month = $this->input->post('month');
        $year = $this->input->post('year');

        $this->db->select('*');
        $this->db->from('journals');
        $this->db->join('files', 'file_id = journal_file');
        ($year_no != 0 ? $this->db->where('journal_year_no', $year_no) : '' );
        ($issue != 0 ? $this->db->where('journal_issue', $issue) : '');
        ($month != 0 ? $this->db->where('journal_mounth', $month) : '' );
        ($year != 0 ? $this->db->where('journal_year', $year) : '');
        ($date != NULL ? $this->db->where('publish_date <', $date) : '');
        $this->db->order_by('journal_year desc,journal_mounth desc,journal_issue desc,journal_year_no desc');
        $rs = $this->db->get();
        $itemp = $rs->result_array();
        return $itemp;
    }

    public function get_journals($id = NULL) {

        $this->db->select('*');
        $this->db->from('journals');
        $this->db->join('files', 'file_id = journal_file');
        if ($id != NULL) {
            $this->db->where('journal_id', $id);
        }
        $this->db->order_by('journal_year desc,journal_mounth desc,journal_issue desc,journal_year_no desc');
        $rs = $this->db->get();
        $itemp = $rs->result_array();
        return $itemp;
    }

    public function set_form_add() {
        $f_year_no = array(
            'name' => 'journal_year_no',
            'class' => 'form-control',
            'placeholder' => 'ปีที่',
            'value' => set_value('journal_year_no')
        );

        $f_issue = array(
            'name' => 'journal_issue',
            'class' => 'form-control',
            'placeholder' => 'ฉบับที่',
            'value' => set_value('journal_issue')
        );
        $f_mounth = array(
            '01' => 'มกราคม',
            '02' => 'กุมภาพันธ์',
            '03' => 'มีนาคม',
            '04' => 'เมษายน',
            '05' => 'พฤษภาคม ',
            '06' => 'มิถุนายน',
            '07' => 'กรกฎาคม',
            '08' => 'สิงหาคม',
            '09' => 'กันยายน',
            '10' => 'ตุลาคม',
            '11' => 'พฤศจิกายน',
            '12' => 'ธันวาคม'
        );
        $f_year = array(
            'name' => 'journal_year',
            'class' => 'form-control year-picker',
            'value' => (set_value('journal_year') == NULL) ? date("Y") + 543 : set_value('journal_year')
        );
        $f_publish_date = array(
            'name' => 'publish_date',
            'id' => 'publish_date',
            'class' => 'form-control datepicker',
            'placeholder' => 'วันเผยแผร่',
            'value' => set_value('publish_date')
        );

        $f_adviser = array(
            'name' => 'adviser',
            'id' => 'adviser',
            'class' => 'form-control',
            'rows' => '5',
            'cols' => '30',
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
            'form' => form_open_multipart('Journals/add', array('class' => 'form-horizontal', 'id' => 'form_journal')),
            'journal_year_no' => form_input($f_year_no),
            'journal_issue' => form_input($f_issue),
            'journal_mounth' => form_dropdown('journal_mounth', $f_mounth, (set_value('journal_mounth') == NULL) ? date('m') : set_value('journal_mounth'), 'class="form-control"'),
            'journal_year' => form_input($f_year),
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

    public function set_form_search($controller) {
        $f_year_no = array(
            '0' => 'ปีที่',
        );

        $f_issue = array(
            '0' => 'ฉบับที่',
        );
        for ($i = 1; $i < 10; $i++) {
            array_push($f_issue, $i);
            array_push($f_year_no, $i);
        }

        $f_month = array(
            '00' => 'เดือน',
            '01' => 'มกราคม',
            '02' => 'กุมภาพันธ์',
            '03' => 'มีนาคม',
            '04' => 'เมษายน',
            '05' => 'พฤษภาคม ',
            '06' => 'มิถุนายน',
            '07' => 'กรกฎาคม',
            '08' => 'สิงหาคม',
            '09' => 'กันยายน',
            '10' => 'ตุลาคม',
            '11' => 'พฤศจิกายน',
            '12' => 'ธันวาคม'
        );

        $f_year = array(
            'name' => 'year',
            'class' => 'form-control year-picker',
            'value' => set_value('journal_year'),
            'placeholder' => 'ปี',
        );

        $f_status_search = array(
            '0' => 'ทั้งหมด',
            '1' => 'ไม่ใช้งาน',
            '2' => 'ใช้งาน',
        );

        $form_search = array(
            'form' => form_open($controller . '/', array('class' => 'form-horizontal', 'id' => 'form_search')),
            'year_no' => form_dropdown('year_no', $f_year_no, (set_value('year_no') == NULL) ? 0 : set_value('year_no'), 'class="form-control"'), form_input($f_year_no),
            'issue' => form_dropdown('issue', $f_issue, (set_value('issue') == NULL) ? 0 : set_value('issue'), 'class="form-control"'),
            'month' => form_dropdown('month', $f_month, (set_value('month') == NULL) ? 0 : set_value('month'), 'class="form-control"'),
            'year' => form_input($f_year),
            'status' => form_dropdown('status', $f_status_search, (set_value('status') == NULL) ? $this->input->post('status') : set_value('status'), 'class="form-control"'),
        );

        return $form_search;
    }

    public function set_form_edit($data) {

        $f_year_no = array(
            'name' => 'journal_year_no',
            'class' => 'form-control',
            'placeholder' => 'ปีที่',
            'value' => set_value('journal_year_no')
        );

        $f_issue = array(
            'name' => 'journal_issue',
            'class' => 'form-control',
            'placeholder' => 'ฉบับที่',
            'value' => set_value('journal_issue')
        );

        $f_year_no = array(
            'name' => 'journal_year_no',
            'class' => 'form-control',
            'placeholder' => 'ปีที่',
            'value' => (set_value('journal_year_no') == NULL) ? $data['journal_year_no'] : set_value('journal_year_no')
        );

        $f_issue = array(
            'name' => 'journal_issue',
            'class' => 'form-control',
            'placeholder' => 'ฉบับที่',
            'value' => (set_value('journal_issue') == NULL) ? $data['journal_issue'] : set_value('journal_issue')
        );
        $f_mounth = array(
            '01' => 'มกราคม',
            '02' => 'กุมภาพันธ์',
            '03' => 'มีนาคม',
            '04' => 'เมษายน',
            '05' => 'พฤษภาคม ',
            '06' => 'มิถุนายน',
            '07' => 'กรกฎาคม',
            '08' => 'สิงหาคม',
            '09' => 'กันยายน',
            '10' => 'ตุลาคม',
            '11' => 'พฤศจิกายน',
            '12' => 'ธันวาคม'
        );
        $f_year = array(
            'name' => 'journal_year',
            'class' => 'form-control year-picker',
            'value' => (set_value('journal_year') == NULL) ? $data['journal_year'] : set_value('journal_year')
        );
        $f_publish_date = array(
            'name' => 'publish_date',
            'id' => 'publish_date',
            'class' => 'form-control datepicker',
            'placeholder' => 'วันเผยแผร่',
            'value' => (set_value('publish_date') == NULL) ? $data['publish_date'] : set_value('publish_date')
        );

        $f_adviser = array(
            'name' => 'adviser',
            'id' => 'adviser',
            'class' => 'form-control',
            'rows' => '5',
            'cols' => '30',
            'placeholder' => 'ที่ปรึกษา',
            'value' => (set_value('adviser') == NULL) ? $data['adviser'] : set_value('adviser')
        );

        $f_editor = array(
            'name' => 'editor',
            'class' => 'form-control',
            'placeholder' => 'บรรณาธิการ',
            'value' => (set_value('editor') == NULL) ? $data['editor'] : set_value('editor')
        );

        $f_prepared_by = array(
            'name' => 'prepared_by',
            'class' => 'form-control',
            'placeholder' => 'ผู้จัดทำ',
            'value' => (set_value('prepared_by') == NULL) ? $data['prepared_by'] : set_value('prepared_by')
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
        $form_edit = array(
            'form' => form_open_multipart('Journals/edit/' . $data['journal_id'], array('class' => 'form-horizontal', 'id' => 'form_journal')),
            'journal_year_no' => form_input($f_year_no),
            'journal_issue' => form_input($f_issue),
            'journal_mounth' => form_dropdown('journal_mounth', $f_mounth, (set_value('journal_mounth') == NULL) ? $data['journal_mounth'] : set_value('journal_mounth'), 'class="form-control"'),
            'journal_year' => form_input($f_year),
            'publish_date' => form_input($f_publish_date),
            'adviser' => form_textarea($f_adviser),
            'editor' => form_input($f_editor),
            'prepared_by' => form_input($f_prepared_by),
            'journal_file' => form_upload($f_file),
            'journal_status' => form_dropdown('journal_status', $f_status, (set_value('journal_status') == NULL) ? $data['journal_status'] : set_value('journal_status'), 'class="form-control"'),
            'journals_highlight' => form_dropdown('journals_highlight', $f_highlight, (set_value('journals_highlight') == NULL) ? $data['journals_highlight'] : set_value('journals_highlight'), 'class="form-control"'),
            'file' => $data['file_name'],
        );
        return $form_edit;
    }

    function validation_add() {
        $this->form_validation->set_rules('journal_year_no', 'ปีที่', 'required|trim|xss_clean');
        $this->form_validation->set_rules('journal_issue', 'ฉบับที่', 'required|trim|xss_clean');
        $this->form_validation->set_rules('journal_mounth', 'เดือน', 'required|trim|xss_clean');
        $this->form_validation->set_rules('journal_year', 'ปี', 'required|trim|xss_clean');
        $this->form_validation->set_rules('publish_date', 'วันเผยเเพร่', 'required|trim|xss_clean');
        $this->form_validation->set_rules('adviser', 'ที่ปรึกษา', 'required|trim|xss_clean|callback_textarea_check');
        $this->form_validation->set_rules('editor', 'บรรณาธิการ', 'required|trim|xss_clean');
        $this->form_validation->set_rules('prepared_by', 'ผู้จัดทำ', 'required|trim|xss_clean');
        if (empty($_FILES['journal_file']['name'])) {
            $this->form_validation->set_rules('journal_file', 'เอกสาร', 'required|xss_clean');
        }

        $this->form_validation->set_message('textarea_check', 'ใส่ข้อมูล %s');
        return TRUE;
    }

    function validation_edit($id) {
        $this->form_validation->set_rules('journal_year_no', 'ปีที่', 'required|trim|xss_clean');
        $this->form_validation->set_rules('journal_issue', 'ฉบับที่', 'required|trim|xss_clean');
        $this->form_validation->set_rules('journal_mounth', 'เดือน', 'required|trim|xss_clean');
        $this->form_validation->set_rules('journal_year', 'ปี', 'required|trim|xss_clean');
        $this->form_validation->set_rules('publish_date', 'วันเผยเเพร่', 'required|trim|xss_clean');
        $this->form_validation->set_rules('adviser', 'ที่ปรึกษา', 'required|trim|xss_clean|callback_textarea_check');
        $this->form_validation->set_rules('editor', 'บรรณาธิการ', 'required|trim|xss_clean');
        $this->form_validation->set_rules('prepared_by', 'ผู้จัดทำ', 'required|trim|xss_clean');

        $this->form_validation->set_message('textarea_check', 'ใส่ข้อมูล %s');
        return TRUE;
    }

    function get_post_form_add() {
        $get_page_data = array(
            'journal_year_no' => $this->input->post('journal_year_no'),
            'journal_issue' => $this->input->post('journal_issue'),
            'journal_mounth' => $this->input->post('journal_mounth'),
            'journal_year' => $this->input->post('journal_year'),
            'adviser' => $this->input->post('adviser'),
            'editor' => $this->input->post('editor'),
            'prepared_by' => $this->input->post('prepared_by'),
            'journal_file' => $this->upload_file('journal_file'),
            'publish_date' => $this->m_datetime->setDateFomat($this->input->post('publish_date')),
            'journals_highlight' => $this->input->post('journals_highlight'),
            'journal_status' => $this->input->post('journal_status'),
            'create_by'=> $this->session->userdata('first_name'),
            'create_date' => $this->m_datetime->getDatetimeNow(),
        );

        return $get_page_data;
    }

    function get_post_form_edit($id) {
        $get_page_data = array(
            'journal_year_no' => $this->input->post('journal_year_no'),
            'journal_issue' => $this->input->post('journal_issue'),
            'journal_mounth' => $this->input->post('journal_mounth'),
            'journal_year' => $this->input->post('journal_year'),
            'adviser' => $this->input->post('adviser'),
            'editor' => $this->input->post('editor'),
            'prepared_by' => $this->input->post('prepared_by'),
            'publish_date' => $this->m_datetime->setDateFomat($this->input->post('publish_date')),
            'journals_highlight' => $this->input->post('journals_highlight'),
            'journal_status' => $this->input->post('journal_status'),
            'update_by'=> $this->session->userdata('first_name'),
            'update_date' => $this->m_datetime->getDatetimeNow(),
        );
        if (!empty($_FILES['journal_file']['name'])) {
            $get_page_data['journal_file'] = $this->upload_file('journal_file', $id);
        }

        return $get_page_data;
    }

    function upload_file($name, $id = NULL) {

        if (!empty($_FILES[$name]['name'])) {

            $config['upload_path'] = "assets/upload";
            // set allowed file types
            $config['allowed_types'] = "pdf";
            // set upload limit, set 0 for no limit
            $config['max_size'] = 0;
            $config['encrypt_name'] = TRUE;


            $this->load->library('upload', $config);


            if (!$this->upload->do_upload($name)) {
                return $this->upload->display_errors();
            } else {
                //insert to database
                $finfo = $this->upload->data();

                $data_file = array(
                    'file_name' => $finfo['file_name'],
                    'file_path' => $finfo['file_path'],
                    'file_full_path' => $finfo['full_path'],
                );
//                unlink($finfo['full_path']);
                if ($id == NULL) {
                    $this->db->trans_start();
                    $this->db->insert('files', $data_file);
                    $file_id = $this->db->insert_id();
                    $this->db->trans_complete();
                    return $file_id;
                } else {
                    $this->deleteFile($id);
                    $this->db->where('file_id', $id);
                    $this->db->update('files', $data_file);
                    return $id;
                }
            }
        }
    }

    function get_file_id($journal_id) {
        $this->db->select('file_id');
        $this->db->from('journals');
        $this->db->join('files', 'file_id = journal_file');
        $this->db->where('journal_id', $journal_id);
        $query = $this->db->get();
        $row = $query->row_array();

        return $row['file_id'];
    }

    public function deleteFile($file_id) {
        $this->db->select('file_full_path');
        $this->db->from('files');
        $this->db->where('file_id', $file_id);
        $query = $this->db->get();
        $row = $query->row_array();

        unlink($row['file_full_path']);
    }

}
