<?php $this->load->view('layout/header.php'); ?>
<div class=contentwrapper>
    <div class="aeditorleft">

<?php $this->load->helper('form'); ?>
<div class=a-error><?php echo validation_errors(); ?></div>
<?php echo form_open('admin/savecheck', 'class="addarticle"'); ?>

    <?php
        $this->db->select('id, title, post, author, remarks');
        $this->db->where('id', $this->uri->segment(3,0));
        $query = $this->db->get('articles');
	// Check if there are any posts returned. If there aren't any returned, either the post doesn't excist.
	if ($query->num_rows() == 0)
	{
	echo "<div class=a-error>We are sorry, humble admin, but we couldn't find a post with this ID.</div>";
	}
	// But if there is a post returned, the post excists, so we show the edit form...
	else
	{
	        foreach ($query->result() as $row) 
		{
		    echo form_label('Post title', 'title'); 
		    $title = $row->title;
		    echo form_input('title', $title, 'id="atitle"');
		    $id = $row->id;
		    echo form_hidden('id', $id); 
		    $post = $row->post;
		    echo form_textarea('post', $post , 'id="apost"'); 
		    echo form_fieldset('Remarks');
		    $remarks = $row->remarks;
		    echo form_textarea('remarks', $remarks , 'id="aremarks"');
		    echo form_fieldset_close();
		}
	}
        ?>
<?php echo form_submit('submitpost', 'Save remarks'); ?>
<?php echo form_close(); ?>

<?php echo form_open('admin/approve/4', 'class="aaprove"'); ?>
<?   foreach ($query->result() as $row) 
	{
	    $id = $row->id;
	    echo form_hidden('id', $id); 
	}
?>
<?php echo form_fieldset('Approve'); ?>
<?php echo form_submit('submitpost', 'Publish post now'); ?>
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
	
		CKEDITOR.replace( 'aremarks',
	{
	toolbar :
		[
			{ name: 'basicstyles', items : [ 'Bold','Italic','Strike','-','RemoveFormat' ] },
			{ name: 'paragraph', items : [ 'NumberedList','BulletedList'] },
		],
	uiColor : '#E27272',
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