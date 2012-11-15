<?php $this->load->view('layout/header.php'); ?>
<div class=contentwrapper>
    <div class="left">

    <strong><?php echo $this->session->userdata('username'); ?></strong>, your article has been succesfully submitted!
    <br>
    You can return to your <a href=http://www.spellborn.org/articles>dashboard by clicking here</a>.
       </div> 
    </div>

<?php $this->load->view('layout/footer.php'); ?>