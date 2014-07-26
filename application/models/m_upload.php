<?php

Class m_upload extends CI_Model {

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

    public function upload_image($folder, $input_file, $img_id = NULL) {

        if (!empty($_FILES[$input_file]['name'])) {

            $config['upload_path'] = "assets/img/" . $folder;
            $config['allowed_types'] = "gif|jpg|jpeg|png";
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = "5000";
            $config['max_width'] = "2920";
            $config['max_height'] = "2080";

            $this->load->library('upload', $config);


            if (!$this->upload->do_upload($input_file)) {
                return $this->upload->display_errors();
            } else {
                //insert to database
                $finfo = $this->upload->data();

                // to re-size for thumbnail images un-comment and set path here and in json array
                $config2 = array();
                $config2['image_library'] = 'gd2';
                $config2['source_image'] = $finfo['full_path'];
                $config2['create_thumb'] = TRUE;
                $config2['new_image'] = 'assets/img/' . $folder . '/thumbs/' . $finfo['file_name'];
                $config2['maintain_ratio'] = TRUE;
                $config2['thumb_marker'] = '';
                $config2['width'] = 1;
                $config2['height'] = 200;
                $config2['maintain_ratio'] = TRUE;
                $config2['master_dim'] = 'height';
                $this->load->library('image_lib', $config2);
                $this->image_lib->resize();

                $data_img = array(
                    'image_name' => $finfo['file_name'],
                    'image_full' => $folder . '/' . $finfo['file_name'],
                    'image_small' => $folder . '/thumbs/' . $finfo['file_name'],
                    'image_path' => $finfo['file_path'],
                );
//                unlink($finfo['full_path']);
                if ($img_id == NULL) {
                    $this->db->trans_start();
                    $this->db->insert('images', $data_img);
                    $image_id = $this->db->insert_id();
                    $this->db->trans_complete();
                    return $image_id;
                } else {
                    $this->deleteImage($img_id);
                    $this->db->where('image_id', $img_id);
                    $this->db->update('images', $data_img);
                    return $img_id;
                }
            }
        }
    }

    public function upload_multi_image($folder, $table, $input_file, $id) {
        $this->load->library('upload');
        $_FILES = $this->multifile($_FILES['file']);
        foreach ($_FILES as $file => $file_data) {
            // No problems with the file
            if ($file_data['error'] == 0) {
                $this->upload->initialize($this->set_upload_image($folder));
                // So lets upload
                if (($finfo = $this->upload->do_upload($file))) {
                    //insert to database
                    $data_img = array(
                        'image_name' => $finfo['file_name'],
                        'image_full' => $folder . '/' . $finfo['file_name'],
                        'image_small' => $folder . '/thumbs/' . $finfo['file_name'],
                        'image_path' => $finfo['file_path'],
                    );
                    $this->db->trans_start();
                    $this->db->insert('images', $data_img);
                    $image_id = $this->db->insert_id();
                    $this->db->trans_complete();
                    if ($table == 'news_has_images') {
                        $f_news = array(
                            'news_id' => $id,
                            'image_id' => $img_id,
                        );
                        $this->db->insert('news_has_images', $f_news);
                    } else {
                        $f_kindness = array(
                            'kindness_id' => $id,
                            'image_id' => $img_id,
                        );
                        $this->db->insert('kindness_has_images', $f_kindness);
                    }
                } else {
                    $errors = $this->upload->display_errors();
                }
            }
        }
    }

    public function deleteImage($image_id) {
        $this->db->select('image_path,image_name');
        $this->db->from('images');
        $this->db->where('image_id', $image_id);
        $query = $this->db->get();
        $row = $query->row_array();

        unlink($row['image_path'] . $row['image_name']);
        unlink($row['image_path'] . 'thumbs/' . $row['image_name']);
    }

    public function upload_file($name, $id = NULL) {

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

    public function upload_multi_file($input_name, $id) {
        $this->load->library('upload');
        $i = 0;
        $_FILES = $this->multifile($_FILES[$input_name]);
        foreach ($_FILES as $file => $file_data) {
            // No problems with the file
            if ($file_data['error'] == 0) {
                // So lets upload  
                $this->upload->initialize($this->set_upload_file());
//                $this->upload->do_upload($file);
                if ($this->upload->do_upload($file)) {
                    $finfo = $this->upload->data();
                    //insert to database
                    $data_file = array(
                        'file_name' => $finfo['file_name'],
                        'file_path' => $finfo['file_path'],
                        'file_full_path' => $finfo['full_path'],
                    );
                    $this->db->trans_start();
                    $this->db->insert('files', $data_file);
                    $f_id = $this->db->insert_id();
                    $this->db->trans_complete();
                    $t = $this->input->post('txtTitle');
                    if ($t[$i] == NULL || $t[$i] == '') {
                        $title = $finfo['orig_name'];
                    } else {
                        $title = $t[$i];
                    }
                    $f = array(
                        'news_id' => $id,
                        'file_id' => $f_id,
                        'title' => $title,
                    );
                    $this->db->insert('news_has_files', $f);
                }
            }
            $i++;
        }
    }

    private function set_upload_file() {
//  upload an image options
        $config = array();
        $config['upload_path'] = "assets/upload";
        $config['allowed_types'] = 'pdf|gif|jpg|png|doc|docx|zip';
        $config['max_size'] = 0;
//        $config['overwrite'] = FALSE;
        $config['encrypt_name'] = TRUE;


        return $config;
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

    public function deleteFile($file_id) {
        $this->db->select('file_full_path');
        $this->db->from('files');
        $this->db->where('file_id', $file_id);
        $query = $this->db->get();
        $row = $query->row_array();

        unlink($row['file_full_path']);
    }

}

//  $_FILES = $this->multifile($_FILES[$input_name]);
//        $i = 0;
//        foreach ($_FILES as $file => $file_data) {
//            $this->upload->initialize($this->set_upload_file());
//            $this->upload->do_upload($file);
//
//            $finfo = $this->upload->data();
//            //insert to database
//            $data_file = array(
//                'file_name' => $finfo['file_name'],
//                'file_path' => $finfo['file_path'],
//                'file_full_path' => $finfo['full_path'],
//            );
//            if ($file_id == NULL) {
//                $this->db->trans_start();
//                $this->db->insert('files', $data_file);
//                $file_id = $this->db->insert_id();
//                $this->db->trans_complete();
//                $t = $this->input->post('txtTitle');
//                if ($t[$i] == NULL || $t[$i] == '') {
//                    $title = $finfo['orig_name'];
//                } else {
//                    $title = $t[$i];
//                }
//                $f = array(
//                    'news_id' => $id,
//                    'file_id' => $file_id,
//                    'title' => $title,
//                );
//                $this->db->insert('news_has_files', $f);
//            } else {
//                $this->deleteFile($file_id);
//                $this->db->where('file_id', $file_id);
//                $this->db->update('files', $data_file);
////                        return $file_id;
//            }
//
//            $i++;
//        }