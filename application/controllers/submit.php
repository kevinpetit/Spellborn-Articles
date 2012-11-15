<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
| SUBMIT CONTROLLER
| Check if you are logged in and have rights to access the submit article.
| This controller allows access to article editor.
|
| Author: Kevjoe - Vampire Trix
| Email: kevin@kevjoe.com
| Website: http://www.kevjoe.com
|
*/

class Submit extends CI_Controller {
	public function index() {
		// Set up the SMF SSI integration
		require($this->config->item('ssi_url'));
		// Change the login and logout URL to point to our application
		$_SESSION['login_url'] = base_url() . $_SERVER['PHP_SELF']; 
		$_SESSION['logout_url'] = base_url() . $_SERVER['PHP_SELF'];
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
			// Else, he is already logged in and we should load the editor.
			$this->load->view('submit-article');
	   }
    }
    
    public function save() {
    	// Check if the user has logged in or not before we can do anything.
		// Set up the SMF SSI integration
		require($this->config->item('ssi_url'));
		// Change the login and logout URL to point to our application
		$_SESSION['login_url'] = base_url() . $_SERVER['PHP_SELF']; 
		$_SESSION['logout_url'] = base_url() . $_SERVER['PHP_SELF'];
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
			// The user is logged in, so the validation so we can save.
			// Load up the form helper
			$this->load->helper(array('form'));
			// Load up the form_validation
			$this->load->library('form_validation');
			// Set up the form_validation
			$this->form_validation->set_rules('title', 'Post title', 'required');
			$this->form_validation->set_rules('post', 'Post content', 'required');

			// Check if the form_validation has succesfully run
			if ($this->form_validation->run() == FALSE)
			{
				// It has not run succesfully, so reload the submit-article view
				$this->load->view('submit-article');
			}
			else
			{
				// Load the database up
	   			$this->load->database();
	   			// Get the articles table
	    		$this->db->get('articles');
	    		$data = array(
					'title' => $this->input->post('title'), // Get the title of the post
					'post' => $this->input->post('post'), // Get the post content
					'author' => $this->session->userdata('username')); // Get the post author
	   			$this->db->insert('articles', $data); // Insert data into the articles table
				$this->load->view('save-succesfull'); // And finally, show succes page.
			}
		}
	}
	
	public function edit() {
    	// Check if the user has logged in or not before we can do anything.
		// Set up the SMF SSI integration
		require($this->config->item('ssi_url'));
		// Change the login and logout URL to point to our application
		$_SESSION['login_url'] = base_url() . $_SERVER['PHP_SELF']; 
		$_SESSION['logout_url'] = base_url() . $_SERVER['PHP_SELF'];
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
			// The user has right to be here, so show the article editor
		$this->load->view('edit-article');	    
	   }
	}
	   
	public function saveedit() {
		// Now we are going to save our edited post.
		// Load up the form helper
		$this->load->helper(array('form'));
		// Load up the database
	    $this->load->database();
	    // Get the articles table
	    $this->db->get('articles');
	    // Set up the post data to be updated
	    $data = array (
			'post' => $this->input->post('post'),
		);
		// Change it only where the id is the same
	    $this->db->where('id', $this->input->post('id'));
	    // And finally update it
	    $this->db->update('articles', $data);
	    // And after this has been done, show the succesful page
		$this->load->view('save-succesfull');
	}
	
	public function confirmsubmit() {
		// Get the articles table
		$this->db->get('articles');
		// Set the submit date and status
		$data = array (
			'submittedon' => date("Y-m-d"),
			'submitted' => 1,
			'checked' => 0); 
		// Update the info in the database
		$this->db->where('id', $this->uri->segment(3,0));
		// Update the articles database
		$this->db->update('articles', $data);

		// Let's set up an email to notify the admin users they have received a new post.
		// Before we can send an email we'll need to load the email library...
		$this->load->library('email');
		$this->email->from($this->config->item('admin_email'), $this->config->item('sitename')); /* CHANGE EMAIL TO YOUR EMAIL ADDRESS AND FROM VALUE */
		$this->email->to($this->config->item('admin_email')); /* CHANGE EMAIL TO YOUR EMAIL ADRESS WHICH HAS TO RECEIVE THE EMAILS */
		$this->email->subject($this->config->item('admin_newarticle_subject'));
		$this->email->message ($this->config->item('admin_newarticle_body'));
		$this->email->send(); 
		// If something goes wrong, uncomment this line below to allow the debugger to show up.
		if($this->config->item('enable_maildebugger') == TRUE) {
			echo $this->email->print_debugger();
		}
		
		// Load the submit succesfull view.
		$this->load->view('submit-succesfull');
	}
	
	public function unsubmit() {
		// Unsubmit an article (remove it from review queue)
		// Get the articles table
		$this->db->get('articles');
		// Remove the submittedon and submitted values
		$data = array (
			'submittedon' => '0000-00-00',
			'submitted' => 0
		);
		// But only do this on the article with the submitted ID
		$this->db->where('id', $this->uri->segment(3,0));
		// Update the articles table
		$this->db->update('articles', $data);
		// Finally load up the unsubmit-succesfull view.
		$this->load->view('unsubmit-succesfull');
	}
	
	public function delete() {
		// Delete an article. This will not really delete an article, for support or error purposes, but disable it in the database.
		// Get the articles table
		$this->db->get('articles');
		// Set up the deleted flag
		$data = array (
			'deleted' => '1'
		);
		// Do this only for the right id.
		$this->db->where('id', $this->uri->segment(3,0));
		// Actually update the database
		$this->db->update('articles', $data);
		// Finally load up the delete-succesfull view.
		$this->load-view('delete-succesfull');
	}
}