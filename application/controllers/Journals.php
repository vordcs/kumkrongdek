<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Journals extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_template');
        $this->load->model('m_journals');
    }

    public function index() {

        $data = array();

//        $this->m_template->set_Debug($data);
        $this->m_template->set_Title('จดหมายข่าว');
        $this->m_template->set_Content('admin/journals.php', $data);
        $this->m_template->showTemplateAdmin();
    }

    public function add() {

        
        if ($this->m_journals->validation_add() && $this->form_validation->run() == TRUE) {
            $form_data = $this->m_journals->get_post_form_add();
            //Update data
            $this->m_journals->insert_journals($id,$form_data);
            redirect('Journals');
        }
        //Load form add
        $data['form'] = $this->m_journals->set_form_add();
//        $this->m_template->set_Debug($data);
        $this->m_template->set_Title('เพิ่มจดหมายข่าว');
        $this->m_template->set_Content('admin/form_journals.php', $data);
        $this->m_template->showTemplateAdmin();
    }

    public function edit() {

        $data = array();
  if ($this->m_journals->validation_edit() && $this->form_validation->run() == TRUE) {
            $form_data = $this->m_journals->get_post_form_edit($id);
            //Update data
            $this->m_slides->update_journals($id,$form_data);
            redirect('Slides');
        }
//        $this->m_template->set_Debug($data);
        $this->m_template->set_Title('แก้ไขจดหมายข่าว');
        $this->m_template->set_Content('admin/form_journals.php', $data);
        $this->m_template->showTemplateAdmin();
    }

    public function delete() {

        $data = array();

//        $this->m_template->set_Debug($data);
        $this->m_template->set_Title('จดหมายข่าว');
        $this->m_template->set_Content('admin/form_journals.php', $data);
        $this->m_template->showTemplateAdmin();
    }

}
