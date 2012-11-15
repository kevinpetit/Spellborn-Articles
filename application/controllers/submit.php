<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Submit extends CI_Controller {
	public function index() {
	require("/path/to/your/ssi/file"); // CHANGE THIS TO YOUR SMF SSI FILE
		$_SESSION['login_url'] = 'http://yoursite.org (change to your site)' . $_SERVER['PHP_SELF']; 
		$_SESSION['logout_url'] = 'http://yoursite.org (change to your site)' . $_SERVER['PHP_SELF'];
		$this->load->library('session');
		$userdata = array (
					'username' => $context['user']['name'],
					'email' => $context['user']['email']);
		$this->session->set_userdata($userdata);
	   if ($context['user']['is_guest']) {
			$this->load->view('login');
		}
		else {
		$this->load->view('submit-article');
	   }
    }
    
    public function save() {
	require("/path/to/your/ssi/file"); // CHANGE THIS TO YOUR SMF SSI FILE
		$_SESSION['login_url'] = 'http://yoursite.org (change to your site)' . $_SERVER['PHP_SELF']; 
		$_SESSION['logout_url'] = 'http://yoursite.org (change to your site)' . $_SERVER['PHP_SELF'];
		$this->load->library('session');
		$userdata = array (
					'username' => $context['user']['name'],
					'email' => $context['user']['email']);
		$this->session->set_userdata($userdata);
	if ($context['user']['is_guest']) {
			$this->load->view('login');
		}
		else {
	$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');
	$this->form_validation->set_rules('title', 'Post title', 'required');
	$this->form_validation->set_rules('post', 'Post content', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('submit-article');
		}
		else
		{
	    $this->load->database();
	    $this->db->get('articles');
	    $data = array(
		'title' => $this->input->post('title'),
		'post' => $this->input->post('post'),
		'author' => $this->session->userdata('username'));
	    $this->db->insert('articles', $data);
	    
			$this->load->view('save-succesfull');
		}
	}
	}
	
	public function edit() {
	    require("/path/to/your/ssi/file"); // CHANGE THIS TO YOUR SMF SSI FILE
		$_SESSION['login_url'] = 'http://yoursite.org (change to your site)' . $_SERVER['PHP_SELF']; 
		$_SESSION['logout_url'] = 'http://yoursite.org (change to your site)' . $_SERVER['PHP_SELF'];
		$this->load->library('session');
		$userdata = array (
					'username' => $context['user']['name'],
					'email' => $context['user']['email']);
		$this->session->set_userdata($userdata);
	   if ($context['user']['is_guest']) {
			$this->load->view('login');
		}
		else {
		  
		$this->load->view('edit-article');
	    
	   }
	   }
	   
	public function saveedit() {
		$this->load->helper(array('form', 'url'));
	    $this->load->database();
	    $this->db->get('articles');
	    $data = array (
		'post' => $this->input->post('post'),);
	    $this->db->where('id', $this->input->post('id'));
	    $this->db->update('articles', $data);
	    
	$this->load->view('save-succesfull');
	}
	
	public function confirmsubmit() {
	
		$this->db->get('articles');
		$data = array (
			'submittedon' => date("Y-m-d"),
			'submitted' => 1); 
		$this->db->where('id', $this->uri->segment(3,0));
		$this->db->update('articles', $data);

		// Time to send an email to the admin users so they know there's a new submitted post. Hard coded.
			// Before we can send an email we'll need to load the email library...
			$this->load->library('email');
			$this->email->from('your@email.org', 'Your Email From'); /* CHANGE EMAIL TO YOUR EMAIL ADDRESS AND FROM VALUE */
			$this->email->to('your@email.org'); /* CHANGE EMAIL TO YOUR EMAIL ADRESS WHICH HAS TO RECEIVE THE EMAILS */
			$this->email->subject('New article submitted!');
			$this->email->message ("Hello! This is a quick post to let you know that there has been a new article submitted. Time to check it out? You can do that on your dashboard, which you can find on http://yoursite.org (change to your site)/articles/index.php/admin");
			$this->email->send(); 
			// if something goes wrong, uncomment this to allow the debugger to show up.
			// echo $this->email->print_debugger();	
		
		$this->load->view('submit-succesfull');
	}
	
	public function unsubmit() {
		$this->db->get('articles');
		$data = array (
			'submittedon' => '0000-00-00',
			'submitted' => 0);
		$this->db->where('id', $this->uri->segment(3,0));
		$this->db->update('articles', $data);
		
		$this->load->view('unsubmit-succesfull');
	}
	
	public function delete() {
		$this->db->get('articles');
		$data = array (
			'deleted' => '1');
		$this->db->where('id', $this->uri->segment(3,0));
		$this->db->update('articles', $data);
		
		$this->load-view('delete-succesfull');
	}
	
	}
	
