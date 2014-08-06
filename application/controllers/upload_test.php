<?php

class upload_test extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_template');
        $this->load->model('Files_Model');
    }

    public function index() {
        $data = array();


        $this->m_template->set_Title('ทดสอบ Upload ');
//        $this->m_template->set_Debug();
        $this->m_template->set_Content('admin/upload.php', $data);
        $this->m_template->showTemplateAdmin();
    }

    public function upload_multi_image() {
        $folder = 'kindness';
        $table = 'kindness_has_images';
        $id = 1;



        $data = array();

        $_FILES = $this->multifile($_FILES['userfile']);

        $data['file'] = $_FILES;

        $data['file_temp'] = array();

        foreach ($_FILES as $file => $file_data) {
            $this->load->library('upload');
            // No problems with the file
            if ($file_data['error'] == 0) {
                $this->upload->initialize($this->set_upload_image($folder));
                // So lets upload
                if ($this->upload->do_upload($file)) {

                    $finfo = $this->upload->data();

                    //insert to database
                    $data_img = array(
                        'image_name' => $finfo['file_name'],
                        'image_full' => $folder . '/' . $finfo['file_name'],
                        'image_small' => $folder . '/thumbs/' . $finfo['file_name'],
                        'image_path' => $finfo['file_path'],
                        're' => $this->resize_image($finfo['full_path'], $finfo['file_path']),
                    );
                    array_push($data['file_temp'], $data_img);

//                    $this->db->trans_start();
//                    $this->db->insert('images', $data_img);
//                    $image_id = $this->db->insert_id();
//                    $this->db->trans_complete();
//                    if ($table == 'news_has_images') {
//                        $f_news = array(
//                            'news_id' => $id,
//                            'image_id' => $image_id,
//                        );
//                        $this->db->insert('news_has_images', $f_news);
//                    } else {
//                        $f_kindness = array(
//                            'kindness_id' => $id,
//                            'image_id' => $image_id,
//                        );
//                        $this->db->insert('kindness_has_images', $f_kindness);
//                    }
                } else {
                    $errors = $this->upload->display_errors();
                }
            }
        }

        $this->m_template->set_Title('ทดสอบ File Upload ');
        $this->m_template->set_Debug($data['file_temp']);
        $this->m_template->set_Content('admin/upload.php', $data);
        $this->m_template->showTemplateAdmin();
    }

    private function set_upload_image($folder) {
//  upload an image options       
        $config = array();
        $config['upload_path'] = "assets/img/" . $folder;
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = "5000";
        $config['max_width'] = "2920";
        $config['max_height'] = "2080";
//        $config['overwrite'] = FALSE;
        $config['encrypt_name'] = TRUE;


        return $config;
    }

    private function resize_image($src_path, $file_path) {
        $this->load->library('image_lib');
        // to re-size for thumbnail images un-comment and set path here and in json array
        $config = array();
        $config['image_library'] = 'gd2';
        $config['source_image'] = $src_path;
        $config['create_thumb'] = TRUE;
        $config['new_image'] = $file_path . 'thumbs/';
        $config['thumb_marker'] = '';
        $config['width'] = 1;
        $config['height'] = 200;
        $config['maintain_ratio'] = TRUE;
        $config['master_dim'] = 'height';
        $this->image_lib->clear();
        $this->image_lib->initialize($config);
        $rs = $this->image_lib->resize();

        return $rs;
    }

    // Codeigniter Upload Multiple File
    public function multifile($filedata) { // $_FILES['files'];
        if (count($filedata) == 0)
            return FALSE;

        $files = array();
        $all_files = $filedata['name'];
        $i = 0;

        foreach ($all_files as $filename) {
            $files[++$i]['name'] = $filename;
            $files[$i]['type'] = current($filedata['type']);
            next($filedata['type']);
            $files[$i]['tmp_name'] = current($filedata['tmp_name']);
            next($filedata['tmp_name']);
            $files[$i]['error'] = current($filedata['error']);
            next($filedata['error']);
            $files[$i]['size'] = current($filedata['size']);
            next($filedata['size']);
        }

        return $files;
    }

}
