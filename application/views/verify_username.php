<div class = "profileBackground">
	<form action = "verify_username" method = "POST">
	<div class = "profileArea">
		<h1 class = "profile_title">verify username and email</h1>
		<hr>
		<div class = "inputArea">

			<label for = "username">Username: </label><br/><br/>
			<input type = "text" name = "username"/><br/>

		</div>

		<div class = "inputArea">
			<label for = "email">Email:(please type it)</label><br/><br/>
			<input type = "email" name = "email"/><br/>
		</div>

		<div class = "submitArea">
			<a href = <?php echo site_url('user/verify_username');?>><input type = "submit" name = "submit" value = "Next"/></a>
		</div>

	</div>
	</form>
</div>


<style>
	.registerBackground{
		width:100%;
		height:100%;
	}
	.registerBackground form {
		width:100%;
		height:100%;
		align-items: center;
		justify-content: center;
		display: flex
	}
	.registerArea {
		width:800px;
		height:500px;
		background-color: #fcf8e3;
		border-radius: 5px;
		border:2px solid #333333;
	}
	.registerArea h1 {
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





<?php
