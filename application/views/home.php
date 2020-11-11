

<body>
<?php
    if (isset($_SESSION['login'])) {
        echo "<h1>Recommendation</h1>";
    } else {
        echo "<h1>Home</h1>";
    }
	$_SESSION['loading_counts'] = 0;
	foreach ($videos as  $video) {
	echo "<a href =". site_url("video/video_detail/".$video['video_id']).">
			<video width = 500px height = 500px> 
			<source src =" . base_url("uploads/" . $video['video_path_filename']) . " ></video></a>
		
		<p> Click video to look <br/>Video Name:" . $video['video_name'] . "<br/>Description:" . $video['video_description'] . "<br/>tag: ".$video['tag']."</p>
		<div id = 'hintVideos'></div>";
}?>
</body>


<script>
	window.onload = function() {

		function getScrollTop()
		{
			var scrollTop = 0, bodyScrollTop = 0, documentScrollTop = 0;
			if(document.body){
				bodyScrollTop = document.body.scrollTop;
			}
			if(document.documentElement){
				documentScrollTop = document.documentElement.scrollTop;
			}
			scrollTop = (bodyScrollTop - documentScrollTop > 0) ? bodyScrollTop : documentScrollTop;
			return scrollTop;
		}
		function getScrollHeight(){
			var scrollHeight = 0, bodyScrollHeight = 0, documentScrollHeight = 0;
			if(document.body){
				bSH = document.body.scrollHeight;
			}
			if(document.documentElement){
				dSH = document.documentElement.scrollHeight;
			}
			scrollHeight = (bSH - dSH > 0) ? bSH : dSH ;
			return scrollHeight;
		}
		function getWindowHeight(){
			var windowHeight = 0;
			if(document.compatMode == "CSS1Compat"){
				windowHeight = document.documentElement.clientHeight;
			}else{
				windowHeight = document.body.clientHeight;
			}
			return windowHeight;
		}
		window.onscroll = function(){
			if(getScrollTop() + getWindowHeight() == getScrollHeight()){

				var xmlhttp;
				if (window.XMLHttpRequest) {
					xmlhttp = new XMLHttpRequest();
				} else {
					xmlhttp = new ActiveObject("Microsoft.XMLHTTP");
				}
				xmlhttp.onreadystatechange = function () {
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

						document.getElementById('hintVideos').innerHTML += xmlhttp.responseText;

					}
				}

				xmlhttp.open('GET','Home/loading_video',true);
				xmlhttp.send();
			}
		};
	}

</script>
