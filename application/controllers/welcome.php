<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		// Set up the SMF SSI integration
		require($this->config->item('ssi_url'));
		// Change the login and logout URL to point to our application
		$_SESSION['login_url'] = $base_url() . $_SERVER['PHP_SELF']; 
		$_SESSION['logout_url'] = $base_url() . $_SERVER['PHP_SELF'];
		// Load up the session library
		$this->load->library('session');
		// Set up the user session with information from SMF
		$userdata = array (
					'username' => $context['user']['name'],
					'email' => $context['user']['email']);
		// Set it actually up.
		$this->session->set_userdata($userdata);
		if ($context['user']['is_guest']) {
			// If the user is a guest, we'll need to let him login
			$this->load->view('login');
		}
		else {
			$this->load->view('dashboard');
		}
	}
}