<?php foreach ($search_videos as  $search_video) {
	echo "<a href =". site_url("video/video_detail/".$search_video['video_id'])."><video width = 500px height = 500px> 
			<source src =" . base_url("uploads/" . $search_video['video_path_filename']) . " ></video></a>
		<p> Video Name:" . $search_video['video_name'] . "<br/>Description:" .
		$search_video['video_description'] . "<br/>
		Uploader Username: ".$search_video['video_uploader']."<br/>
		</p>";
}
