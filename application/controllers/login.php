<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Login extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		$this->load->model ( 'm_login', '', TRUE );
		$this->load->library ( 'form_validation' );
	}
	public function index() {
		// Check loged in go to main.
		if ($this->session->userdata ( 'user' ) != NULL) {
			redirect ( 'main' );
		}
		
		// --- Login Process ---//
		// Check for check brute force
		$config ['count'] = 5;
		if ($this->session->userdata ( 'BruteForce' ) == NULL) {
			$this->session->set_userdata ( 'BruteForce', 0 );
		}
		if ($this->session->userdata ( 'BruteForce' ) >= $config ['count']) {
			show_error ( "คุณล็อคอินผิดติดต่อกัน เราได้บล็อค IP คุณแล้ว กรุณาลองใหม่หลังจากผ่านไป 2 ชั่วโมง", 203, "คุณถูกบล็อค IP" );
		}
		if ($this->m_login->set_validation () && $this->form_validation->run () == TRUE) {
			$temp_f = $this->m_login->get_post ();
			
			$temp_u = $this->m_login->select_user ( $temp_f ['username'], $temp_f ['password'] );
			if ($temp_u == NULL) {
				$data ['message'] = '<div class="alert alert-error">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>เข้าระบบไม่สำเร็จ!</strong> Username หรือ Password อาจจะไม่ถูกต้อง
			</div>';
				// Count brute force
				$temp_bf = $this->session->userdata ( 'BruteForce' );
				$this->session->set_userdata ( 'BruteForce', ++ $temp_bf );
			} else {
				// Clear count brute force
				$this->session->unset_userdata ( 'BruteForce' );
				$this->session->set_userdata ( 'user', $temp_u [0] );
				redirect ( 'main' );
			}
		}
		
		// Sent data to page and show page.
		$data ['form'] = form_open ( 'login', array (
				'class' => 'form-signin' 
		) );
		$data ['input'] = $this->m_login->set_form ();
		
		$this->load->view ( 'login', $data );
	}
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */