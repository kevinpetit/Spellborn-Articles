<?php $this->load->view('layout/header.php'); ?>
    <div class="row">
        <div class="twelve columns panel">
            <div style="text-align: center;">Welcome <strong><?php echo $this->session->userdata('username'); ?></strong> to the <?php $this->config->item('sitename'); ?> article system administration!</div>
        </div>
    </div>

    <div class="nine columns">

    <h2>Your saved articles</h2>
    <div class="alert-box">Note that you still need to submit these to us in order to get them reviewed</div>
    <table border="0" cellpadding="4" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>ID</th><th>Title</th><th>Last edit</th><th>Edit</th><th>Submit</th></tr>
        </thead>
        <tbody>
       <?php        
        $this->db->select('id, title, lastedit');
        $this->db->where('author', $this->session->userdata('username'));
        $this->db->where('submitted !=', '1');
        $this->db->where('publish' , '0000-00-00');
        $query = $this->db->get('articles');
        foreach ($query->result() as $row) {
            echo '<tr>';
            echo '<td>'; echo $row->id; echo '</td>';
            echo '<td>'; echo $row->title; echo '</td>';
            echo '<td>'; echo $row->lastedit; echo '</td>';
	    echo '<td> <a href="'. base_url() .'index.php/submit/edit/';
	    echo $row->id;
	    echo '">Edit</a>';
	    echo '<td><a href="'. base_url() .'index.php/submit/confirmsubmit/';
	    echo $row->id;
	    echo '">Submit</a></td>';
            echo '</tr>';
        }
        ?> 
        </tbody>
    </table>

    <h2>Your submitted articles</h2>
    <div class="alert-box">Please note that these aren't approved yet.</div>
    <table border="0" cellpadding="4" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>ID</th><th>Title</th><th>Submitted on</th><th>Unsubmit</th></tr>
        </thead>
    <tbody>
    <?php
        $this->db->select('id, title, submittedon');
        $this->db->where('author', $this->session->userdata('username'));
        $this->db->where('submitted', '1');
        $this->db->where('checked', '0');
        $query = $this->db->get('articles');
        foreach ($query->result() as $row) {
            echo '<tr>';
            echo '<td>'; echo $row->id; echo '</td>';
            echo '<td>'; echo $row->title; echo '</td>';
	    echo '<td>'; echo $row->submittedon; echo '</td>';
	    echo '<td><a href="'. base_url() .'index.php/submit/unsubmit/';
	    echo $row->id;
	    echo '">Unsubmit</a></td>';
            echo '</tr>';
        }
        ?> 
        </tbody>
    </table>
    
    <h1>Your checked articles</h1>
    <div class="alert-box">Please note that you'll need to review our remarks and update your article accordingly.</div>
    <table border="0" cellpadding="4" cellspacing="0" width="100%">
        <thead>
            <tr>
            <th>ID</th><th>Title</th><th>Remarks</th><th>Edit</th><th>Submit</th></tr>
        </thead>
    <tbody>
    <?php
        $this->db->select('id, title, remarks, publish');
        $this->db->where('author', $this->session->userdata('username'));
        $this->db->where('submitted', '1');
        $this->db->where('remarks !=', '' );
		$this->db->where('publish', 0);
        $query = $this->db->get('articles');
		foreach ($query->result() as $row) {
            echo '<tr>';
            echo '<td>'; echo $row->id; echo '</td>';
            echo '<td>'; echo $row->title; echo '</td>';
            echo '<td>'; echo $row->remarks; echo '</td>';
	    echo '<td> <a href="'. base_url() .'index.php/submit/edit/';
	    echo $row->id;
	    echo '">Edit</a>';
	    echo '<td><a href="'. base_url() .'index.php/submit/confirmsubmit/';
	    echo $row->id;
	    echo '">Submit</a></td>';
        echo '</tr>';
        }
        ?> 
        </tbody>
    </table>

    
    <h2>Your published articles</h2>
    <div class="alert-box">Thank you for your work! ;). Your articles listed below are now posted on our portal.</div>
    <table border="0" cellpadding="4" cellspacing="0" width="100%">
    <thead>
    <tr>
    <th>ID</th><th>Title</th></tr>
    </thead>
    <tbody>
    <?php
        $this->db->select('id, title, publish');
        $this->db->where('author', $this->session->userdata('username'));
        $this->db->where('publish', 1);
        $query = $this->db->get('articles');
        foreach ($query->result() as $row) {
            echo '<tr>';
            echo '<td>'; echo $row->id; echo '</td>';
            echo '<td>'; echo $row->title; echo '</td>';
            echo '</tr>';
        }
        ?> 
        </tbody>
        </table>
    <?php

    ?>
</div>

    <div class="three columns">
        <aside>
        	<a class="radius button" href="<?php echo base_url(); ?>index.php/submit">Submit a new article</a>
            <div class="radius button alert"><?php ssi_logout(); ?></div>
        </aside>   
 </div>

<?php $this->load->view('layout/footer.php'); ?>