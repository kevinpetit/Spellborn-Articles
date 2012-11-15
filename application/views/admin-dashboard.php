<?php $this->load->view('layout/header.php'); ?>
<div class=contentwrapper>
    <div class="left">

<div class=a-info><strong>Info:</strong> We're still working hard on this part of the system. Not all features are available.</div>
	<br>
    Welcome <strong><?php echo $this->session->userdata('username'); ?></strong> to the Spellborn Fan Hub Article system administration!
    <br>
    
    <h1>All submitted articles</h1>
    <h2 class="anotice">Please note that these aren't approved yet.</h2>
    <div class="aetable">
    <table border="0" cellpadding="4" cellspacing="0">
    <thead>
    <tr>
    <th>ID</th><th>Title</th><th>Author</th><th>Submitted on</th><th>Check</th></tr>
    </thead>
    <tbody>
    <?php
        $this->db->select('id, title, author, submittedon');
        $this->db->where('submitted', true);
		$this->db->where('publish', false);
        $query = $this->db->get('articles');
        foreach ($query->result() as $row) {
            echo '<tr>';
            echo '<td>'; echo $row->id; echo '</td>';
            echo '<td>'; echo $row->title; echo '</td>';
	    echo '<td>'; echo $row->author; echo '</td>';
	    echo '<td>'; echo $row->submittedon; echo '</td>';
	    echo '<td><a class=checklink href=http://www.spellborn.org/articles/index.php/admin/check/';
	    echo $row->id;
	    echo '>Check</a></td>';
            echo '</tr>';
        }
        ?> 
        </tbody>
        </table>
    </div>

<h1>All approved articles</h1>
    <h2 class="anotice">Please note that some of these might be published already.</h2>
    <div class="aetable">
    <table border="0" cellpadding="4" cellspacing="0">
    <thead>
    <tr>
    <th>ID</th><th>Title</th><th>Author</th></tr>
    </thead>
    <tbody>
    <?php
        $this->db->select('id, title, author, publish');
        $this->db->where('publish !=', 0);
        $query = $this->db->get('articles');
        foreach ($query->result() as $row) {
            echo '<tr>';
            echo '<td>'; echo $row->id; echo '</td>';
            echo '<td>'; echo $row->title; echo '</td>';
            echo '<td>'; echo $row->author; echo '</td>';;
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
    	<div class="a-bigbutton bred"><a href=http://www.spellborn.org/articles/index.php/submit>Submit an article</a></div>
        <div class="a-bigbutton bblack"><?php ssi_logout(); ?></div>
    </aside>
    
    </div>

<?php $this->load->view('layout/footer.php'); ?>