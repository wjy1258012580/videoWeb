<div class = "registerBackground">
	<form action = "register_result" method = "POST">
	<div class = "registerArea">
		<h1 class = "register_title">Create Account</h1>
		<hr>
		<div class = "inputArea">
			<label for = "username">Username: </label><br/><br/>
			<input type = "text" name = "username"/><br/>
		</div>

		<div class = "inputArea">
			<label for = "password">Password:</label><br/><br/>
			<input type = "password" name = "password"/><br/>
		</div>

		<div class = "inputArea">
			<label for = "email">Email:</label><br/><br/>
			<input type = "email" name = "email"/><br/>
		</div>

		<div class = "inputArea">
			<label for = "secret_question">Set a secret question to protect your account:</label><br/><br/>
			<input type = "text" name = "secret_question"/><br/>
		</div>

		<div class = "inputArea">
			<label for = "answer">Set the answer:</label><br/><br/>
			<input type = "text" name = "answer"/><br/>
		</div>

		<div class = "submitArea">
			<a href = <?php echo site_url('user/register_result');?>><input type = "submit" name = "submit" value = "create"/></a>
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
		align-items: center;
		justify-content: center;
		display: flex;
		margin-top:20px;
	}
	.registerArea {
		width:800px;
		height:auto;
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



