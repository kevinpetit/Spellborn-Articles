<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		// load smf ssi file to check if user is logged in
        require("/path/to/your/ssi/file"); // CHANGE THIS TO YOUR SMF SSI FILE
        $_SESSION['login_url'] = 'http://www.spellborn.org' . $_SERVER['PHP_SELF']; 
		$_SESSION['logout_url'] = 'http://www.spellborn.org' . $_SERVER['PHP_SELF'];
		$this->load->library('session');
		$userdata = array (
					'username' => $context['user']['name'],
					'email' => $context['user']['email']);
		$this->session->set_userdata($userdata);
		if ($context['user']['is_guest']) {
			$this->load->view('login');
		}
		else {
			$this->load->view('dashboard');
		}
	}
}