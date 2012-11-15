<?php $this->load->view('layout/header.php'); ?>
    <div class="row">
        <div class="twelve columns panel">
            <div style="text-align: center;">Welcome <strong><?php echo $this->session->userdata('username'); ?></strong> to the <?php $this->config->item('sitename'); ?> article system administration!</div>
        </div>
    </div>

    <div class="nine columns">

    <h2>All submitted articles</h2>
    <div class="alert-box">Please note that these aren't approved yet and require moderation.</div>
    <table border="0" cellpadding="4" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>ID</th><th>Title</th><th>Author</th><th>Submitted on</th><th>Moderate</th></tr>
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
    	    echo '<td><a href='. base_url() .'index.php/admin/check/';
    	    echo $row->id;
    	    echo '>Moderate article</a></td>';
            echo '</tr>';
            }
        ?> 
        </tbody>
    </table>

    <h2>All approved articles</h2>
    <div class="alert-box">Please note that some of these might be published already.</div>
    <table border="0" cellpadding="4" cellspacing="0" width="100%">
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

    <div class="three columns">
        <aside>
        	<a class="radius button" href="<?php echo base_url() ?>index.php/submit">Submit a new article</a>
            <div class="radius button alert"><?php ssi_logout(); ?></div>
        </aside>
    </div>

<?php $this->load->view('layout/footer.php'); ?>