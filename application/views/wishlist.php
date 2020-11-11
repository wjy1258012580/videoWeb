


<?php
	foreach ($wish_videos as  $video) {
	echo "<a href =". site_url("video/video_detail/".$video['video_id']).">
			<video width = 500px height = 500px> 
			<source src =" . base_url("uploads/" . $video['video_path_filename']) . " ></video></a>
		
		<p> Click video to look <br/>Video Name:" . $video['video_name'] . "<br/>Description:" . $video['video_description'] . "<br/>tag: ".$video['tag']."</p>
		<div id = 'hintVideos'></div>";
}?>

