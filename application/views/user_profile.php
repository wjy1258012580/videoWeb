<div class = "profileBackground">
	<form action = "user/user_profile" method = "POST">
	<div class = "profileArea">
		<h1 class = "profile_title">My profile</h1>
		<div class = "submitArea">
			<a href = <?php echo site_url('user/location');?>>view location</a></div>
		<hr>
		<div class = "imgArea">
			<img src = <?php
			if (isset($_SESSION["user_icon"])) {
				echo base_url('uploads/'.$_SESSION["user_icon"]);
			} else {
				echo base_url('images/usericon.jpg');
			}?>>
		</div>

		<div class = "submitArea">
			<a href = <?php echo site_url('upload/upload');?>>change icon</a></div>

		<div class = "inputArea">
			<label for = "username">Username: </label><br/><br/>
			<?php echo
				 "<label>".$_SESSION["username"]."</label><br/>";
			?>
		</div>

		<div class = "inputArea">
			<label for = "description">description:</label><br/><br/>
			<?php echo  "<label>".$_SESSION["description"]."</label><br/>"; ?>
		</div>

		<div class = "inputArea">
			<label for = "email">Email:</label><br/><br/>
			<?php echo $email = $_SESSION["email"];
			"<label>".$email."</label><br/>";
			?>
		</div>

        <div class = "submitArea">
            <a href = <?php echo site_url('user/get_wish_list');?>>my wishlist</a></div>
            
        </div>

		<div class = "submitArea">
			<a href = <?php echo site_url('user/edit_profile');?>>edit description</a></div>

		<div class = "submitArea">
			<a href = <?php echo site_url('user/verify');?>>change password</a>
		</div>

	</div>

	</form>>
</div>


<style>
	.imgArea {
		display: flex;
		justify-content: center;
	}

	.imgArea img {
		width: 200px;
		height: 200px;
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
	.profile_title {
		text-align: center;
	}
</style>



