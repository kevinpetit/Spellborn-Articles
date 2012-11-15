<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
| ADMIN CONTROLLER
| Check if you are logged in and have rights to access the admin.
| This controller allows access to the admin features.
|
| Author: Kevjoe - Vampire Trix
| Email: kevin@kevjoe.com
| Website: http://www.kevjoe.com
|
*/

class Admin extends CI_Controller {
    
    public function index() {
        // Load SSI file to link with the forum. 
        require($this->config->item('ssi_url')); // Change location in articles-config.php
        // Check if user is currently logged in.
        if ($context['user']['is_guest']) 
        {
        	// The user is not logged in, so we should load the login view.
			$this->load->view('login');
		}
		else 
        {
           // The user is logged in, so check if the user is an admin user.
           if ($context['user']['is_admin'])
           {
               // The user is an admin user, so load the admin dashboard.
		       $this->load->view('admin-dashboard');
           }
           else
           {
               // Looks like our user hasn't got access, so show him the normal user dashboard.
               $this->load->view('dashboard');
           }
       }
    }
    
    public function check() {
		// Load the article checker / let the admin review the article
		$this->load->view('admin-check.php');
    }
    
    public function savecheck() {
    	// Load up the form and url helper. This will add the check to the database.
		$this->load->helper(array('form'));
		// Load the database 
		$this->load->database();
		// Select the articles table
		$this->db->get('articles');
		// Set up the data to be posted to the database
		$data = array (
			'post' => $this->input->post('post'), // the actual post
			'remarks' => $this->input->post('remarks'), // the remarks made by an admin user
			'checked' => 1); // the article has been checked, so it needs to be flagged as such in our database.
		// Select the right article id in the database to update
		$this->db->where('id', $this->input->post('id'));
		// And, after all of this, submit the updated article to the database.
		$this->db->update('articles', $data);
		// Check if the database got updated.
		if ($this->db->affected_rows() > 0) {
			// The update was succesfull, so show succes page
			$this->load->view('save-succesfull');
		}
		else {
			// The update failed, so show failure page
			$this->load->view('save-failed'); // TODO: make the save-failed file
		}
    }
	
	public function approve() {
		// Approve the article and submit it through to WordPress.
		// Include the WordPress class-IXR.php file
		include($this->config->item('ixr_url')); // Change location if needed in articles-config.php file
		// Get all information from this post in the database. Select the id, title and postcontent from the database.
		$this->db->select('id, title, post');
		// From all that information get only the data with the submitted post ID.
		$this->db->where('id', $this->input->post('id'));
		// Set up the query to get this information
		$query = $this->db->get('articles');
		// set the published flag in the database to true
		foreach ($query->result() as $row) {
	  		$this->db->get('articles'); // Get the articles table
			$data = array ('publish' => 1); // Set the publish flag to true
			$this->db->where('id', $this->input->post('id')); // But only where the ID is equal to what has been posted
			$this->db->update('articles', $data); // Update the database.

			// Now, we have to set up the data that will be posted to WordPress using XML-RPC.
			$title= $row->title; // $title variable will insert your blog title 
			$body= $row->post; // $body will insert your blog content (article content)
			$category= "uncategorized"; // Comma seperated pre existing categories. Ensure that these categories exists in your blog.
			$encoding = "UTF-8";
			$keywords = "Article";
		 
		 	// Clean up the values in order to prevent sql injection
		    $title = htmlentities($title,ENT_NOQUOTES,$encoding);
		    $keywords = htmlentities($keywords,ENT_NOQUOTES,$encoding);
		 
			// Set up the content parameters
		    $content = array(
		        'title'=>$title,
		        'description'=>$body,
		        'mt_allow_comments'=>1,  // 1 to allow comments
		        'mt_allow_pings'=>1,  // 1 to allow trackbacks
		        'post_type'=>'post',
		        'mt_keywords'=>$keywords,
		        'categories'=>array($category)
				//'custom_fields' =>  array($customfields)
		    );
		 
		// Create the client object
		$client = new IXR_Client($this->config->item('xmlrpc_url')); // Change in the articles-config file.

		// Your WordPress login information. Change in the articles-config file.
		$username = $this->config->item('wp_username');
		$password = $this->config->item('wp_password');

		$params = array(0,$username,$password,$content,true); // Last parameter is 'true' which means post immideately, to save as draft set it as 'false'
		 
		// Submit to WordPress
		if (!$client->query('metaWeblog.newPost', $params)) {
			// Something went wrong, so submit the error message and stop the execution.
		    die('Something went wrong - '.$client->getErrorCode().' : '.$client->getErrorMessage());
		}
		else
			// The post has been published succesfully, so show succes page!
			$this->load->view('published-succesfully'); 
		}
	}
}