<div>
	<?php if(isset($error)) {echo $error;} ?>
    <?php echo form_open_multipart('upload/deal_upload_video');?>
	<h1>Upload Video</h1>
	<input type="file" name="userfile"/>
	<br><br>
		<input type="submit" value="upload"/>
	</form>
</div>
