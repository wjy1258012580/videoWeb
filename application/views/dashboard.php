<div class = "dashboard">
	<h1>Recommendation: yesterday most popular</h1>
	<h2>Video Name: <?php echo $query['video_name']?></h2>
	<video width = 500px height = 500px controls>
		<source src = <?php echo base_url('uploads/'.$query['video_path_filename'])?>>
	</video>
	<hr/>
</div>

<style>
	.dashboard h1 {
		color: red;
	}
</style>
