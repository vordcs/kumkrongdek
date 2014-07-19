<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class m_news extends CI_Model {
    function getDatetimeNow() {
        return date('Y-m-d H:i:s');
    } 
    
    function set_form_add() {
        $f_news_title=array(
            'name'=>'news_title',
            'class'=>'form-control',
            'placeholder' => '',
            'value' => set_value('news_title')
        );
        
        $f_news_content=array(
            'name'=>'news_content',
            'class'=>'form-control',
            'id'=>'content',
            'placeholder' => '',
            'value' => set_value('news_content')
        );
        
        $f_news_img=array(
            'name'=>'news_img',
//            'class'=>'form-control',
            'placeholder' => '',
            'value' => set_value('news_img')
        );
        
        $f_public_date=array(
            'name'=>'public_date',
            'class'=>'form-control',
            'placeholder' => '',
            'value' => set_value('public_date')
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
          'form' => form_open_multipart('News_ad/add', array('class' => 'form-horizontal', 'id' => 'form_news')), 
            'news_title'=>  form_input($f_news_title),
            'news_content'=> form_textarea($f_news_content),
            'news_img'=> form_upload($f_news_img),
            'news_status' => form_dropdown('news_status', $f_status, set_value('news_status'), 'class="form-control"'),
            'news_highlight' => form_dropdown('news_highlight', $f_highlight, set_value('news_highlight'), 'class="form-control"'),
            'public_date' => form_input($f_public_date),
            'images' => NULL,
        );
        
        return $form_add;
    }
    function set_form_edit($data) {
        $f_news_title=array(
            'name'=>'news_title',
            'class'=>'form-control',
            'placeholder' => '',
            'value' => (set_value('news_title') ==NULL) ? $data['news_title'] : set_value('news_title')
        );
        
        $f_news_content=array(
            'name'=>'news_content',
            'class'=>'form-control',
            'id'=>'content',
            'placeholder' => '',
            'value' => (set_value('news_content') ==NULL) ? $data['news_content'] : set_value('news_content')
        );
        
        $f_news_img=array(
            'name'=>'news_img',
//            'class'=>'form-control',
            'placeholder' => '',
            'value' => (set_value('news_img') ==NULL) ? $data['news_img'] : set_value('news_img')
        );
        
        $f_public_date=array(
            'name'=>'public_date',
            'class'=>'form-control',
            'placeholder' => '',
            'value' => (set_value('public_date') ==NULL) ? $data['public_date'] : set_value('public_date')
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
          'form' => form_open_multipart('News_ad/edit' . $data['news_id'], array('class' => 'form-horizontal', 'id' => 'form_news')), 
            'news_title'=>  form_input($f_news_title),
            'news_content'=> form_textarea($f_news_content),
            'news_img'=> form_upload($f_news_img),
            'news_status' => form_dropdown('news_status', $f_status, (set_value('news_status') == NULL) ?$data['news_status']:set_value('news_status'), 'class="form-control"'),
            'news_highlight' => form_dropdown('news_highlight', $f_highlight, (set_value('news_highlight') == NULL) ?$data['news_highlight']:set_value('news_highlight'), 'class="form-control"'),
            'public_date' => form_input($f_public_date),
            'images' => NULL,
        );
        
        return $form_edit;
    }
    public function validation_add() {
         $this->form_validation->set_rules('news_title', 'ชื่อเรื่อง', 'required|trim|xss_clean');
         $this->form_validation->set_rules('news_content', 'เนื้อหา', 'required|trim|xss_clean');
         if(empty($_FILES['news_img']['name']))
            $this->form_validation->set_rules('news_img', 'รูปภาพ', 'required|trim|xss_clean');
         $this->form_validation->set_rules('public_date', 'วันที่', 'required|trim|xss_clean');
         
         return TRUE;
        
    }
    
    public function validation_edit() {
         $this->form_validation->set_rules('news_title', 'ชื่อเรื่อง', 'required|trim|xss_clean');
         $this->form_validation->set_rules('news_content', 'เนื้อหา', 'required|trim|xss_clean');
         $this->form_validation->set_rules('public_date', 'วันที่', 'required|trim|xss_clean');
         
         return TRUE;
        
    }
    
    public function get_post_form_add(){
        $page_data=array(
            'news_title'=>  $this->input->post('news_title'),
            'news_content'=>  $this->input->post('news_content'),
            'news_status'=>  $this->input->post('news_status'),
            'news_highlight'=>  $this->input->post('news_highlight'),
            
        );
        
        return $page_data;
    }
    
    public function get_post_form_edit($id){
        $page_data=array(
            'news_title'=>  $this->input->post('news_title'),
            'news_content'=>  $this->input->post('news_content'),
            'news_status'=>  $this->input->post('news_status'),
            'news_highlight'=>  $this->input->post('news_highlight'),
            
        );
        
        return $page_data;
    }
    
   
}
