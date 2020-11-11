
<div class = "commentArea">
	<h1><a href = <?php echo site_url('video/show_comment');?>>click here to write comment</a></h1>
	<div class = "commentDetails">

		<?php foreach ($comments as  $comment_detail) {
				echo "<p><span class = 'username'>" . $comment_detail['username'] . "    <span/><span class = 'time'>   " . $comment_detail['time'] . "</span> </p><br/><p>" . $comment_detail['comment'] . "</p>";
		}?>
	</div>
</div>
<style>
	.commentArea {
		display: flex;
		flex-direction: column;
		text-align: center;
		width: 100%;
		justify-content: center;
		background-color: #fcf8e3;
		border: 1px solid black;
		padding: 50px;
		margin: 20px 0px 20px 0px;
	}
	.commentArea a {
		text-decoration: none;
		color: black;
	}
	.username {
		color:red;
		font-size: 20px;
	}
	.time {
		color:blue;
		font-size: 15px;
	}
</style>
