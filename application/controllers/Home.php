<?php

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_data');
		$this->load->library('session');
		$this->load->model('video_model');
	}

	/**
	 * Show all video in home page
	 */
    public function index() {

		$this->load->view('header');
        if (isset($_SESSION['time'])) {
			if ($_SESSION['time'] + 1800 > time()) {
				$_SESSION['time'] = time();
			} else {
				session_destroy();
				redirect(site_url()."/user/login");
			}
//			$date = date('Y-m-d');
//			sscanf($date, "%d-%d-%d",$year,$month,$day);
//			$yesterday = sprintf("%d-%d-%d", $year,$month,$day -1);
//			$query = $this->video_model->dashboard($yesterday);
//			$data['query'] = $this->video_model->get_video($query['v_id']);
//			$this->load->view('dashboard', $data);
		}
		$videos = $this->video_model->get_all_video();
		if (isset($_SESSION['login'])) {
			$recom = $this->video_model->recommendation($_SESSION['u_id']);
			if ($recom) {
				$videos = $this->video_model->filter($recom['tag']);
			}
		}
		$video_array = array();

		for ($i = 0; $i < 3; $i++) {
			if (isset($videos[$i])) {
				array_push($video_array, $videos[$i]);
			}
		}
		$data['videos'] = $video_array;
		$this->load->view('home',$data);
    }

	/**
	 * loading video
	 */
    public function loading_video() {
		if (isset($_SESSION['time'])) {
			if ($_SESSION['time'] + 1800 > time()) {
				$_SESSION['time'] = time();
				} else {
				session_destroy();
				redirect(site_url()."/user/login");
			}
			}

    	$new_videos = array();
		$videos = $this->video_model->get_all_video();
		if (isset($_SESSION['login'])) {
			$recom = $this->video_model->recommendation($_SESSION['u_id']);
			if ($recom) {
				$videos = $this->video_model->filter($recom['tag']);
			}
		}
    	$start_value = $_SESSION['loading_counts'] * 3 + 3;
    	$finish_value = $start_value + 2;

    	for ($i = $start_value; $i <= $finish_value; $i++) {

//    		for ($z = 0; $z < 3; $z ++) {
    			if (isset($videos[$i])) {
					array_push($new_videos, $videos[$i]);
				}

//			}

		}

		foreach ($new_videos as  $new_video) {
			echo "<a href =". site_url("video/video_detail/".$new_video['video_id']).">
			<video width = 500px height = 500px>
			<source src =" . base_url("uploads/" . $new_video['video_path_filename']) . " ></video></a>

		<p> Click video to look <br/>Video Name:" . $new_video['video_name'] . "<br/>Description:" . $new_video['video_description'] . "<br/>tag: ".$new_video['tag']."</p>";
		}
//		$this->session->set_userdata('loading_counts', $this->session->userdata('loading_counts')+1);
		$counts = $this->session->userdata('loading_counts');
    	$this->session->set_userdata('loading_counts', $counts+1);
	}


}

?>
