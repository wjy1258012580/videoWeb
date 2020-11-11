
<div class = "UploadBackground">
	<?php echo form_open_multipart('upload/edit_video_details');?>
	<div class = "UploadArea">
		<h1 class = "register_title">Upload video</h1>
		<hr>
		<div class = "inputArea">
			<label for = "video_name">Video Name: </label><br/><br/>
			<input type = "text" name = "video_name"/><br/>
		</div>

		<div class = "inputArea">
			<label for = "video_description">Description:</label><br/><br/>
			<input type = "text" name = "video_description"/><br/>
		</div>

		<div class = "inputArea">
			<select name = "select">
				<option value ="animal">animal</option>
				<option value ="game">game</option>
				<option value="people">people</option>
				<option value="other">other</option>
			</select>
		</div>

		<div class = "inputArea">
			<label for = "hash">show my name as:</label><br/><br/>
			<select name = "hash_select">
				<option value ="TRUE">anonymous to everyone</option>
				<option value ="FALSE">username</option>
			</select>
		</div>


		<div class = "submitArea">
			<input type="submit" value="upload"/>
		</div>

    </div>
    </form>

	</div>


</div>


<style>
	.UploadBackground{
		width:100%;
		height:100%;
	}
	.UploadBackground form {
		width:100%;
		align-items: center;
		justify-content: center;
		display: flex;
		margin-top:20px;
	}
	.UploadArea {
		width:800px;
		height:auto;
		background-color: #fcf8e3;
		border-radius: 5px;
		border:2px solid #333333;
	}
	.UploadArea h1 {
		text-align: center;
	}
	.inputArea {
		text-align: center;
		padding: 20px;
	}
	.inputArea input {
		width:600px;
		height:35px;
	}
	.submitArea {
		text-align: center;
		margin:30px;
	}
</style>





