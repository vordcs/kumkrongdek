<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lang extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    function set($language) {
        if ($language == "thai" || $language == "english") {
            $this->session->set_userdata('site_lang', $language);
        } else {
            $this->session->set_userdata('site_lang', "thai");
        }
        redirect(base_url());
    }

}
