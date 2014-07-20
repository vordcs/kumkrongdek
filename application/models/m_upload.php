<?php

Class m_upload extends CI_Model {

    function upload_image($folder,$input_file,$img_id = NULL) {

        if (!empty($_FILES[$input_file]['name'])) {

            $config['upload_path'] = "assets/img/".$folder;
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
                $config2['new_image'] = 'assets/img/'.$folder.'/thumbs/' . $finfo['file_name'];
                $config2['maintain_ratio'] = TRUE;
                $config2['thumb_marker'] = '';
                $config2['width'] = 1;
                $config2['height'] = 500;
                $config2['maintain_ratio'] = TRUE;
                $config2['master_dim'] = 'height';
                $this->load->library('image_lib', $config2);
                $this->image_lib->resize();

                $data_img = array(
                    'image_name' => $finfo['file_name'],
                    'image_full' => $folder.'/'. $finfo['file_name'],
                    'image_small' => $folder.'/thumbs/' . $finfo['file_name'],
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
    public function deleteImage($image_id) {
        $this->db->select('image_path,image_name');
        $this->db->from('images');
        $this->db->where('image_id', $image_id);
        $query = $this->db->get();
        $row = $query->row_array();

        unlink($row['image_path'] . $row['image_name']);
        unlink($row['image_path'] . 'thumbs/' . $row['image_name']);
    }

}
