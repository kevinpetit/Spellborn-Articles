<?php $this->load->view('layout/header.php'); ?>
<div class=contentwrapper>
    <div class="aeditorleft">

<?php $this->load->helper('form'); ?>
<div class=a-error><?php echo validation_errors(); ?></div>
<?php echo form_open('submit/save', 'class="addarticle"'); ?>
<?php echo form_label('Post title', 'title'); ?>
<?php echo form_input('title', '', 'id="atitle"'); ?>
<?php echo form_label('Post content', 'post'); ?>
<?php echo form_textarea('post', '' , 'id="apost"'); ?>
<?php echo form_submit('submitpost', 'Submit article'); ?>
<?php echo form_close(); ?>
<script type="text/javascript">
	CKEDITOR.replace( 'apost',
	{
	toolbar :
		[
			{ name: 'document', items : [ 'NewPage','Preview' ] },
			{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
			{ name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','Scayt' ] },
			{ name: 'insert', items : [ 'Image','Table','HorizontalRule','Smiley','SpecialChar','PageBreak' ] },
					'/',
			{ name: 'styles', items : [ 'Styles','Format' ] },
			{ name: 'basicstyles', items : [ 'Bold','Italic','Strike','-','RemoveFormat' ] },
			{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote' ] },
			{ name: 'links', items : [ 'Link','Unlink','Anchor' ] },
			{ name: 'tools', items : [ 'About' ] }
		],
	uiColor : '#5A5A5A',
	});
</script>  
       </div> 
          
    <aside class="aeditor">
    	Welcome to the Article editor! <br /> <br />
        Please try to make your article as complete as possible: you can write about almost anything, but keep it acceptable. Our website is also available for kids!<br /><br />
        When you press the save button, your article gets saved and you can edit further on a later time. If you want to submit your article to us so we can check it, you'll need to submit the article from your Edit menu.<br /><br />
        Keep in mind we will check for language errors and grammar and your article does not get published right away.<br /><br />
        It's also possible that we ask for you to rewrite your article partially or completely - we don't allow certain content and we aim to publish all sorts of different content. When your article gets approved, you'll get the date of publishing on your dashboard. 
    </aside>
    
    </div>

<?php $this->load->view('layout/footer.php'); ?>