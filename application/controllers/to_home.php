<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class to_home extends CI_Controller {
	public function __construct() {
		parent::__construct ();	
	}
	public function index() {
            redirect('Home/');
        }
}
