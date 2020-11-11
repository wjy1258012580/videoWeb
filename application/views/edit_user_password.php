<div class = "profileBackground">
	<form action = "user/edit_user_password" method = "POST">
	<div class = "profileArea">
		<h1 class = "profile_title">change password</h1>
		<hr>
		<div class = "inputArea">

			<label for = "username">Username: </label><br/><br/>
			<?php echo $username = $_SESSION["username"];
			"<label>".$username."</label><br/>";
			?>

		</div>

		<div class = "inputArea">
			<label for = "password">new Password:</label><br/><br/>
			<input type = "password" name = "new_password"/><br/>
		</div>

		<div class = "submitArea">
			<a href = <?php echo site_url('user/edit_user_password');?>><input type = "submit" name = "submit" value = "submit"/></a>
		</div>

	</div>

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





