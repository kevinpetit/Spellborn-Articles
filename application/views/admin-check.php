<?php $this->load->view('layout/header.php'); ?>
<div class="nine columns">

	<?php $this->load->helper('form'); ?>

	<div class="alert-box alert">
		<?php echo validation_errors(); ?>
	</div>

	<?php 
		echo form_open('admin/savecheck', 'class="addarticle"'); 
		// Get information from database
		$this->db->select('id, title, post, author, remarks');
		$this->db->where('id', $this->uri->segment(3,0));
		$query = $this->db->get('articles');
		// Now check if we get any posts returned. If there is't anything returned, the post doesn't excist.
		if ($query->num_rows() == 0) {
			echo "<div class='alert-box alert'>We are sorry, humble admin, but we couldn't find a post with this ID.</div>";
		}
		else {
			foreach ($query->result() as $row) {
				echo form_fieldset('Submitted article', 'Submitted article');
				echo form_label('Post title');
				$title = $row->title;
				echo form_input('title', $title);
				$id = $row->id;
				echo form_hidden('id', $id);
				$post = $row->post;
				echo form_textarea('post', $post, 'id="posteditor" class="ckeditor"');
				echo form_fieldset_close();
				echo form_fieldset('Remarks');
				$remarks = $row->remarks;
				echo form_textarea('remarks', $remarks, 'id="remarkseditor" class="ckeditor"');
				echo form_fieldset_close();
			}
		}

       	echo form_submit('submitpost', 'Save remarks', 'class="medium button"');
		echo form_close();

		echo form_open('admin/approve/'.$id.'');
		
		foreach ($query->result() as $row) 
		{
	    	$id = $row->id;
	    	echo form_hidden('id', $id); 
		}
		echo form_submit('submitpost', 'Publish post now', 'class="medium button"');
		echo form_close();
	?>
</div> 

<div class="three columns panel">
    <aside class="aeditor">
    	Welcome to the Article editor! <br /> <br />
        Please try to make your article as complete as possible: you can write about almost anything, but keep it acceptable. Our website is also available for kids!<br /><br />
        When you press the save button, your article gets saved and you can edit further on a later time. If you want to submit your article to us so we can check it, you'll need to submit the article from your Edit menu.<br /><br />
        Keep in mind we will check for language errors and grammar and your article does not get published right away.<br /><br />
        It's also possible that we ask for you to rewrite your article partially or completely - we don't allow certain content and we aim to publish all sorts of different content. When your article gets approved, you'll get the date of publishing on your dashboard. 
    </aside>
</div>

<script type="text/javascript">
	CKEDITOR.replace('posteditor',
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
	});
</script>  
<script type="text/javascript">
	CKEDITOR.replace('remarkseditor',
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
	});
</script>  

<?php $this->load->view('layout/footer.php'); ?>