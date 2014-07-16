<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class m_template extends CI_Model {

    private $title = 'สถานคุ้มครองสวัสดิภาพเด็ก|ภาคตะวันออกเฉียงเหนือ|จังหวัดขอนแก่น';
    private $view_name = NULL;
    private $set_data = NULL;
    private $debud_data = NULL;

    function set_Debug($data) {
        $this->debud_data = $data;
    }

    function set_Title($name) {
        $this->title = $name;
    }

    function set_Content($name, $data) {
        $this->view_name = $name;
        $this->set_data = $data;
    }

    function showTemplate() {
        //--- Redirect to current page ---//
        $data['page'] = $this->uri->segment(1);

        //--- Alert System ---//
        $data['alert'] = $this->session->userdata('alert');
        $this->session->unset_userdata('alert');

        $data['title'] = $this->title;
        $data['debug'] = $this->debud_data;

        $this->load->view('theme_header', $data);
        $this->load->view($this->view_name, $this->set_data);
        $this->load->view('theme_footer');
    }

//    function showTemplateAdmin() {
//         //--- Redirect to current page ---//
//        $data['page'] = $this->uri->segment(1);
//        
//        //--- Alert System ---//
//        $data['alert'] = $this->session->userdata('alert');
//        $this->session->unset_userdata('alert');
//        
//        $data['title'] = $this->title;
//        $data['debug'] = $this->debud_data;
//        
//        $this->load->view('admin/theme_header_admin.php',$data);
//        $this->load->view($this->view_name, $this->set_data);
//        $this->load->view('admin/theme_footer_admin.php');
//    }

}
