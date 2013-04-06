<?php $this->load->view('layout/header.php'); ?>
<div class=contentwrapper>
    <div class="left">

    <strong><?php echo $this->session->userdata('username'); ?></strong>, your article has been succesfully saved!
    <br>
    You can make edits to your article from your <a href="<?php echo base_url() ?>">dashboard</a>.
       </div> 
    </div>

<?php $this->load->view('layout/footer.php'); ?>