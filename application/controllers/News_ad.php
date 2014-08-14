<?php

class News_ad extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_template');
        $this->load->model('m_news');
        $this->load->model('m_upload');

        if ($this->session->userdata('loged_in') != TRUE) {
            redirect('admin');
        }
    }

    public function index() {
        $data = array();

        $data['news'] = $this->m_news->get_news();
        $data['file'] = $this->m_news->get_news_file();
        $data['form'] = $this->m_news->set_form_search();
        $data['news_type'] = $this->m_news->get_news_type();
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

//        $this->m_template->set_Debug($type);
        $this->m_template->set_Title('ข่าว');
        $this->m_template->set_Content('admin/news.php', $data);
        $this->m_template->showTemplateAdmin();
    }

    public function highlight() {
        $data = array();

        $data['form'] = $this->m_news->set_form_search();
        $data['strtitle'] = NULL;

        $data['news'] = $this->m_news->get_news_highlight();
        $data['file'] = $this->m_news->get_news_file();
        $data['news_type'] = $this->m_news->get_news_type();

//        $this->m_template->set_Debug($data);
        $this->m_template->set_Title('ข่าวเด่น');
        $this->m_template->set_Content('admin/news.php', $data);
        $this->m_template->showTemplateAdmin();
    }

    public function view_more($id) {

        $news = $this->m_news->get_news($id);

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
            'controller' => 'News_ad',
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
        $data['images'] = $this->m_news->get_news_images($id);
        $data['file'] = $this->m_news->get_news_file($id);
        $strtype = $this->m_news->get_news_type($type);
        $data['type'] = $strtype[0]['news_type_name'];

//        $this->m_template->set_Debug($data);
        $this->m_template->set_Title('ข่าว');
        $this->m_template->set_Content('admin/detail.php', $data);
        $this->m_template->showTemplateAdmin();
    }

    public function add() {
        $data = array();
        if ($this->m_news->validation_add() && $this->form_validation->run() == TRUE) {
            $form_data = $this->m_news->get_post_form_add();
            $this->m_template->set_Debug($form_data);
            //insert data
            $this->m_news->insert_news($form_data);
            redirect('News_ad');
        }
        //Load form add  
        $data['form'] = $this->m_news->set_form_add();

        $this->m_template->set_Title('เพิ่มข่าว');
        $this->m_template->set_Content('admin/form_news.php', $data);
        $this->m_template->showTemplateAdmin();
    }

    public function edit($id) {
        $data = array();
        if ($this->m_news->validation_edit() && $this->form_validation->run() == TRUE) {
            $form_data = $this->m_news->get_post_form_edit($id);
            $this->m_template->set_Debug($form_data);
            //update data
            $this->m_news->update_news($id, $form_data);
            redirect('News_ad');
        }
        //      get detail and sent to load form
        $detail = $this->m_news->get_news($id);
        $name = $detail[0]['news_title'];
        if ($detail[0] != NULL) {
            $data['form'] = $this->m_news->set_form_edit($detail[0]);
        } else {
            redirect('News_ad');
        }
//        $this->m_template->set_Debug($data);
        $this->m_template->set_Title('แก้ไขข่าว : ' . $name);
        $this->m_template->set_Content('admin/form_news.php', $data);
        $this->m_template->showTemplateAdmin();
    }

    public function delete($id, $controller = NULL) {
        $this->m_news->delete_news($id);
        if ($controller != NULL) {
            
        } else {
            redirect('News_ad');
        }
    }

    public function unactive($id) {
        $data = array(
            'news_status' => 'unactive',
        );

        $this->db->where('news_id', $id);
        $this->db->update('news', $data);

        redirect('News_ad', 'refresh');
    }

    public function active($id) {
        $data = array(
            'news_status' => 'active',
        );
        if ($id != NULL) {
            $this->db->where('news_id', $id);
            $this->db->update('news', $data);
        }
        redirect('News_ad', 'refresh');
    }

    public function textarea_check($str) {
        if ($str == '<br>') {
            $this->form_validation->set_message('textarea_check', 'ใส่ข้อมูล %s');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function type_check() {
        if ($this->input->post('news_type') === '1') {
            $this->form_validation->set_message('type_check', 'เลือกประเภทข่าว');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
