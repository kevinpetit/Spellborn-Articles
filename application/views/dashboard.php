<?php $this->load->view('layout/header.php'); ?>
<div class=contentwrapper>
    <div class="left">

<div class=a-info><strong>Info:</strong> We're still working hard on this part of the system. Not all features are available.</div>
	<br>
    Welcome <strong><?php echo $this->session->userdata('username'); ?></strong> to the Spellborn Fan Hub Article system!
    <br>
    <h1>Your saved articles</h1>
    <h2 class=anotice>Note that you still need to submit these to us in order to get them reviewed </h2>
    <div class="aetable">
        <table border="0" cellpadding="4" cellspacing="0">
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
	    echo '<td> <a class=editlink href=http://www.spellborn.org/articles/index.php/submit/edit/';
	    echo $row->id;
	    echo '>Edit</a>';
	    echo '<td><a class=submitlink href=http://www.spellborn.org/articles/index.php/submit/confirmsubmit/';
	    echo $row->id;
	    echo '>Submit</a></td>';
            echo '</tr>';
        }
        ?> 
        </tbody>
        </table>

    </div>
    <h1>Your submitted articles</h1>
    <h2 class="anotice">Please note that these aren't approved yet.</h2>
    <div class="aetable">
    <table border="0" cellpadding="4" cellspacing="0">
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
	    echo '<td><a class=unsubmitlink href=http://www.spellborn.org/articles/index.php/submit/unsubmit/';
	    echo $row->id;
	    echo '>Unsubmit</a></td>';
            echo '</tr>';
        }
        ?> 
        </tbody>
        </table>
    </div>
    
    <h1>Your checked articles</h1>
    <h2 class="anotice">Please note that you'll need to review our remarks and update your article accordingly.</h2>
    <div class="aetable">
    <table border="0" cellpadding="4" cellspacing="0">
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
	    echo '<td> <a class=editlink href=http://www.spellborn.org/articles/index.php/submit/edit/';
	    echo $row->id;
	    echo '>Edit</a>';
	    echo '<td><a class=submitlink href=http://www.spellborn.org/articles/index.php/submit/confirmsubmit/';
	    echo $row->id;
	    echo '>Submit</a></td>';
            echo '</tr>';
        }
        ?> 
        </tbody>
        </table>
    </div>
    
        <h1>Your published articles</h1>
    <h2 class="anotice">Thank you for your work! ;). Your articles listed below are now posted on our portal.</h2>
    <div class="aetable">
    <table border="0" cellpadding="4" cellspacing="0">
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
           </div> 
    <aside>
    	<div class="a-bigbutton bred"><a href=http://www.spellborn.org/articles/index.php/submit>Submit a new article</a></div>
        <div class="a-bigbutton bblack"><?php ssi_logout(); ?></div>
    </aside>
    
    </div>

<?php $this->load->view('layout/footer.php'); ?>