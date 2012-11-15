<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
    
    public function index() {
        // Load SSI file
        require("/path/to/your/ssi/file"); // CHANGE THIS TO YOUR SMF SSI FILE
        // Check if user is currently logged in.
        if ($context['user']['is_guest']) 
        {
                        // If not logged in, show login form
			$this->load->view('login');
	}
	else 
        {
           // If logged in, check if the user has access to the admin.
           // Checks if the user is in the usergroup 16, which is the portal staff.
           if (in_array(16, $user_info['groups']))
           {
               // The user is in the portal staff, so show the admin panel
	       $this->load->view('admin-dashboard');
           }
           else
           {
               // Looks like our user hasn't got access, so show him the normal dashboard.
               $this->load->view('dashboard');
           }
       }
    }
    
    public function check() {

	$this->load->view('admin-check.php');
    }
    
    public function savecheck() {

		$this->load->helper(array('form', 'url'));
		$this->load->database();
		$this->db->get('articles');
		$data = array (
			'post' => $this->input->post('post'),
			'remarks' => $this->input->post('remarks'),
			'checked' => 1);
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('articles', $data);
		    
		$this->load->view('save-succesfull');
	
    }
	
	public function approve() {
	  include("../wp-includes/class-IXR.php");
	  $this->db->select('id, title, post');
      $this->db->where('id', $this->input->post('id'));
      $query = $this->db->get('articles');
      foreach ($query->result() as $row) 
	  {
	  		$this->db->get('articles');
			$data = array ('publish' => 1);
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('articles', $data);
		
	  	$customfields=array('key'=>'communityauthor', 'value'=>'community member' ); // Insert your custom values like this in Key, Value format
		$title= $row->title; // $title variable will insert your blog title 
		$body= $row->post; // $body will insert your blog content (article content)
		$category= "Community"; // Comma seperated pre existing categories. Ensure that these categories exists in your blog.
		$post_type= "Community";
		$encoding = "UTF-8";
		$keywords = "Article";
		 
		 
		    $title = htmlentities($title,ENT_NOQUOTES,$encoding);
		    $keywords = htmlentities($keywords,ENT_NOQUOTES,$encoding);
		 
		    $content = array(
		        'title'=>$title,
		        'description'=>$body,
		        'mt_allow_comments'=>1,  // 1 to allow comments
		        'mt_allow_pings'=>1,  // 1 to allow trackbacks
		        'post_type'=>'post',
		        'mt_keywords'=>$keywords,
		        'categories'=>array($category),
				'custom_fields' =>  array($customfields)
		    );
		 
		// Create the client object
		$client = new IXR_Client('http://www.yoursite.org/xmlrpc.php'); // CHANGE THIS TO YOUR WORDPRESS XMLRPC FILE
		 
		 $username = "your user"; // CHANGE THIS TO YOUR USERNAME
		 $password = "your password";  // CHANGE THIS TO YOUR WORDPRESS PASSWORD
		 $params = array(0,$username,$password,$content,true); // Last parameter is 'true' which means post immideately, to save as draft set it as 'false'
		 
		// Run a query for PHP
		if (!$client->query('metaWeblog.newPost', $params)) {
		    die('Something went wrong - '.$client->getErrorCode().' : '.$client->getErrorMessage());
		}
		else
		   $this->load->view('published-succesfully'); 
	
	}
	}
	}