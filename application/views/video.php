<div class = "video_page">
	<h2>Video Name: <?php echo $query['video_name']?></h2>
	<video width = 500px height = 500px controls>
		<source src = <?php echo base_url('uploads/'.$query['video_path_filename'])?>>
	</video>
	<h3>Description: <?php echo $query['video_description']?></h3>
	<h3>Uploader: <?php echo $query['video_uploader']?></h3>
	<?php
	if (isset($_SESSION["login"])) {
		echo "<h3><a href = ".site_url('video/like_video').">LIKE ".$like_counts."</a></h3>
			<h3><a href =".site_url('video/dislike_video').">DISLIKE ".$dislike_counts."</a></h3>
			<h3><a href =".site_url('video/add_list').">WISH LIST<br/> status: ".$_SESSION['wish']."</a></h3>";
	} else {
	}?>

</div>

<style>

	.video_page {
		display: flex;
		flex-direction: column;
		align-items: center;
	}
	.video_page a {
		text-decoration: none;
		color: cornflowerblue;
	}
</style>

