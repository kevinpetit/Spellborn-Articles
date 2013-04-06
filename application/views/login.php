<?php $this->load->view('layout/header.php'); ?>
<div class=contentwrapper>
    <div class="left">
        <div class=a-error>You need to be signed in to access the Articles system.</div>
        <br>
        Please log in using your Spellborn Fan Hub forum username and password.
        <div class=aelogin>
        <?php ssi_login(); ?>
        <a href=""<?php echo base_url() ?>/forum/index.php?action=reminder">If you've forgotten your password - don't worry, it happens to the best of us! - click here.</a>
        </div>
    </div>
</div>
<?php $this->load->view('layout/footer.php'); ?>