<?php

class News_ad extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_template');
        $this->load->model('m_news');
        $this->load->model('m_upload');
    }

    public function index() {
        $data = array();

        $data['news'] = $this->m_news->get_news();
        $data['file'] = $this->m_news->get_news_file();
        $data['form'] = $this->m_news->set_form_search();
        $data['strtitle'] = NULL;
        if ($this->input->post('status') != 0 || $this->input->post('date_search') != NULL) {
            $status = (int) $this->input->post('status');
            $date = $this->input->post('date_search');
            $s = array('ทั้งหมด', 'ไม่ใช้งาน', 'ใช้งาน');
            if ($date == NULL) {
                $title = $s[$status];
            } else {
                $title = $date;
            };
            $data['strtitle'] = 'ผลการค้นหา : ' . $title;
        }

//        $this->m_template->set_Debug($data['file']);
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
            $date = $this->m_datetime->DateThai($row['publish_date']);
            $status = $row['news_status'];
            $create = '  | สร้าง : ' . $this->m_datetime->DateTimeThai($row['create_date']) . ' โดย: ' . $row['create_by'];
            $update = 'แก้ไข : ' . $this->m_datetime->DateTimeThai($row['update_date']) . ' โดย: ' . $row['update_by'];
        }

        $data = array(
            'controller' => 'News_ad',
            'img' => $img,
            'id' => $id,
            'title' => $title,
            'subtitle' => $subtitle,
            'date' => $date,
            'status' => $status,
            'content' => $content,
            'create' => $create,
            'update' => $update,
        );
        $data['images'] = NULL;
//        $data['images'] = $this->m_activitys->get_image_activity($id);
        $data['file'] = $this->m_news->get_news_file($id);
//        $this->m_template->set_Debug($data);
        $this->m_template->set_Title('รายละเอียด : ' . $title);
        $this->m_template->set_Content('admin/detail.php', $data);
        $this->m_template->showTemplateAdmin();
    }

    public function add() {
        $data = array();
        if ($this->m_news->validation_add() && $this->form_validation->run() == TRUE) {
            $form_data = $this->m_news->get_post_form_add();
//            $this->m_template->set_Debug($form_data);
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
//            $this->m_template->set_Debug($form_data);
            //update data
            $this->m_news->update_news($id, $form_data);
            redirect('News_ad');
//            $this->m_upload->upload_multi_file(2);
        }
        //      get detail and sent to load form
        $detail = $this->m_news->get_news($id);
        $name = $detail[0]['news_title'];
        if ($detail[0] != NULL) {
            $data['form'] = $this->m_news->set_form_edit($detail[0]);
        } else {
            redirect('News_ad');
        }

        $this->m_template->set_Title('แก้ไขข่าว : ' . $name);
        $this->m_template->set_Content('admin/form_news.php', $data);
        $this->m_template->showTemplateAdmin();
    }

    public function delete($id) {
        $this->m_news->delete_news($id);
        redirect('News_ad');
    }

    public function unactive($id) {
        $data = array(
            'news_status' => '1',
        );

        $this->db->where('news_id', $id);
        $this->db->update('News', $data);

        redirect('News_ad', 'refresh');
    }

    public function active($id) {
        $data = array(
            'news_status' => '2',
        );

        $this->db->where('news_id', $id);
        $this->db->update('News', $data);

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
        if ($this->input->post('news_type') === '0') {
            $this->form_validation->set_message('type_check', 'เลือกประเภทข่าว');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
