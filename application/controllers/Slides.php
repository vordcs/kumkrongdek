<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Slides extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_template');
        $this->load->model('m_slides');
    }

    public function index() {        

        $data['slides'] = $this->m_slides->get_slides();

//        $this->m_template->set_Debug($data);
        $this->m_template->set_Title('สไลด์');
        $this->m_template->set_Content('admin/slides.php', $data);
        $this->m_template->showTemplateAdmin();
    }

    public function add() {
        if ($this->input->post('save') != NULL) {
//            $data['form_data'] = $this->m_slides->get_post();
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
        $this->m_slides->set_id($id);
//        $data['path'] = $this->m_slides->get_image_path($id);

        if ($this->m_slides->validation_edit() && $this->form_validation->run() == TRUE) {
            $form_data = $this->m_slides->get_post_set_form_edit();
            //Update data
            $this->m_slides->update_slide($form_data);
            redirect('Slides');
        }


//      get detail and sent to load form

        $detail = $this->m_slides->get_silde($id);
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

    public function cancle($slide_id) {
        $data = array(
            'status_slide' => '0',
        );

        $this->db->where('id', $slide_id);
        $this->db->update('slides', $data);

        redirect('Slides', 'refresh');
    }

    public function active($slide_id) {
        $data = array(
            'status_slide' => '1',
        );

        $this->db->where('id', $slide_id);
        $this->db->update('slides', $data);

        redirect('Slides', 'refresh');
    }

}

?>