<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('m_template');
	}
	function index(){		
		$this->session->unset_userdata('user');
		redirect('login');
	}
}