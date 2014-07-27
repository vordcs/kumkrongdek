<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Slides extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_template');
        $this->load->model('m_slides');
        if ($this->session->userdata('loged_in') != TRUE) {
            redirect('admin');
        }
    }

    public function index() {

        $f_status = array(
            '0' => 'ทั้งหมด',
            '1' => 'ไม่ใช้งาน',
            '2' => 'ใช้งาน',
        );
        $data ['status'] = form_dropdown('status', $f_status, (set_value('status') == NULL) ? $this->input->post('status') : set_value('status'), 'class="form-control" onchange="myform.submit();"');

        if ($this->input->post('status') == null || $this->input->post('status') == 0) {
            $data['slides'] = $this->m_slides->get_slides();
        } else {
            $data['slides'] = $this->m_slides->get_slides_by_status((int) $this->input->post('status'));
        }
        $status = array('ทั้งหมด', 'ไม่ใช้งาน', 'ใช้งาน');
//        $this->m_template->set_Debug($data['slides']);
        $this->m_template->set_Title('สไลด์ : ' . $status[(int) $this->input->post('status')]);
        $this->m_template->set_Content('admin/slides.php', $data);
        $this->m_template->showTemplateAdmin();
    }

    public function add() {
        if ($this->input->post('save') != NULL) {
            if ($this->m_slides->validation_add() && $this->form_validation->run() == TRUE) {
                $form_data = $this->m_slides->get_post_form_add();
                //Insert data
                $this->m_slides->insert_slide($form_data);
                redirect('Slides', 'refresh');
            }
        }
        //Load form add
        $data['form'] = $this->m_slides->set_form_add();
        $this->m_template->set_Title('สร้างสไลด์');
//        $this->m_template->set_Debug($data);
        $this->m_template->set_Content('admin/form_slide.php', $data);
        $this->m_template->showTemplateAdmin();
    }

    public function edit($id) {
        if ($this->m_slides->validation_edit() && $this->form_validation->run() == TRUE) {
            $form_data = $this->m_slides->get_post_form_edit($id);
            //Update data
            $this->m_slides->update_slide($id, $form_data);
            redirect('Slides');
        }
//      get detail and sent to load form
        $detail = $this->m_slides->get_slides($id);
        if ($detail[0] != NULL) {
            $data['form'] = $this->m_slides->set_form_edit($detail[0]);
            $data['detail'] = $detail[0];
        } else {
            redirect('Slides');
        }
        $this->m_template->set_Title('แก้ไขสไลด์');
//        $this->m_template->set_Debug($data);
        $this->m_template->set_Content('admin/form_slide.php', $data);
        $this->m_template->showTemplateAdmin();
    }

    public function delete($id) {

        $this->m_slides->delete_slide($id);
        redirect('Slides');
    }

    public function unactive($slide_id) {
        $data = array(
            'slide_status' => '1',
        );

        $this->db->where('slide_id', $slide_id);
        $this->db->update('slides', $data);

        redirect('Slides', 'refresh');
    }

    public function active($slide_id) {
        $data = array(
            'slide_status' => '2',
        );

        $this->db->where('slide_id', $slide_id);
        $this->db->update('slides', $data);

        redirect('Slides', 'refresh');
    }

}

?>