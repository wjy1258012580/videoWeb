<div class = "loginBackground">
	<form action = "login_result" method = "POST">
	<div class = "loginArea">
		<h1 class = "login_title">LOGIN</h1>
		<hr>
		<div class = "inputArea">
			<label for = "username">Username: </label><br/><br/>
			<?php
				if (isset($_COOKIE["username"])) {
					$username = $_COOKIE['username'];
					echo "<input type = 'text' name = 'username' value = $username>";
				} else {
					echo "<input type = 'text' name = 'username'>";
				}
			?>
			<br/>
		</div>

		<div class = "inputArea">
			<label for = "password">Password:</label><br/><br/>
			<input type = 'password' name = 'password'>
		</div>

		<div class = "submitArea">
			<div><input type = "checkbox" name = "checkbox" value = "checkbox">Remember me</div>
			<div><a href = <?php echo site_url('user/login_result');?>><input type = "submit" name = "submit" value = "log in"/></a></div>

		</div>

		<div class = "submitArea">
			<div><a href = <?php echo site_url('user/register');?>>register</a></div>
			<div><a href = <?php echo site_url('user/verify');?>>Forget Password?</a></div>
		</div>


	</div>

	</form>
</div>


<style>
.loginBackground{
	width:100%;
	height:100%;
}
.loginBackground form {
	width:100%;
	height:100%;
	align-items: center;
	justify-content: center;
	display: flex;
}
.loginArea {
	width:800px;
	height:auto;
	background-color: #fcf8e3;
	border-radius: 5px;
	border:2px solid #333333;
}
.loginArea h1 {
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
	justify-content: space-around;
	margin:30px;
	display:flex;
}
</style>


