<div class = "header">
		<a class = "title" href = <?php echo site_url('home')?>>HOME</a>
		<form action = "video/search_video" method = "POST">
		<div class = "searchArea">
			<input type = "text" name = "search" class = "searchInput" id = "search" value = "" onKeyUp = "showHint(this.value)" placeholder= "search video"/>
			<div id = "hint_completion">

			</div>

		</div>
		<?php echo form_close(); ?>
		<div class = "userArea">
			<div class="hover-btn">
				<img src = <?php
					if (isset($_SESSION["user_icon"])) {
						echo base_url('uploads/'.$_SESSION["user_icon"]);
					} else {
						echo base_url('images/usericon.jpg');
					}?>>
			</div>
			<div class="drop-content">
				<?php
				if (isset($_SESSION["login"])) {
					echo "<a href =".site_url('user/user_profile').">user profile</a><br/>";
					echo "<a href =".site_url('upload/upload_video').">upload video</a><br/>";
					echo "<a href =".site_url('user/logout').">logout</a>";
				} else {
					echo "<a href =".site_url('user/login').">log in</a><br/>";
					echo "<a href =".site_url('user/register').">register</a>";
				}
				?>
			</div>
		</div>
		</form>
	</div>



<style>
	.title {
		color:#ffffff;
		align-items: center;
		margin-right: 5px;
		display: flex;
		text-decoration: none;
	}
	.searchTitle {
		color:#ffffff;
		align-items: center;
		margin-right: 5px;
		display: flex;
		text-decoration: none;
	}
.header
{
	width:100%;
	display: flex;
	background-color: #333333;
	flex-direction: row;
	height: 40px;
	flex-wrap: nowrap;
	justify-content: flex-end;
}
.searchArea {
	display:flex;
	height:100%;
	width:auto;
}
.searchInput{
	margin: 5px;
	padding: 10px;
	text-align: center;
	background-color: #f0f0f0;
	border-radius: 5px;
	width:200px;
}
.userArea img {
	width: 30px;
	height: 30px;
	margin: 5px;
	margin-right: 50px;
}

.userArea {
	position: relative;
	display: inline-block;
}
.hover-btn {
	cursor: pointer;
}
.drop-content {
	display: none;
	position: absolute;
	z-index: 1;
	background-color: #ffffff;
	font-size: small;
	w
}
.hint_completion li{
    color:white;
    cursor:pointer;
}


.userArea:hover .drop-content {
	display: block;
}
.userArea:hover .hover-btn {
}
</style>
<script>
function showHint(value) {
	var xmlhttp;
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else {
		xmlhttp = new ActiveObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function () {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById('hint_completion').innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.open('GET','User/autocompletion?keyword='+ value,true);
	xmlhttp.send();
}
function showWord(value) {
	document.getElementById('search').value = value;
}

</script>
