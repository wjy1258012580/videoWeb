<?php


class Video extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_data');
		$this->load->library('session');
		$this->load->model('video_model');
		$this->load->helper('url_helper');

	}

	/**
	 * video detail page
	 */
	public function video_detail($video_id) {
		$this->judgeSession();
		$data['query'] = $this->video_model->get_video($video_id);
		$this->load->view('header');
		$_SESSION['v_id'] = $video_id;
		if (isset($_SESSION['login'])) {

			$like_count = count($this->video_model->like_count($_SESSION['u_id'], $_SESSION['v_id']));
			$dislike_count = count($this->video_model->dislike_count($_SESSION['u_id'], $_SESSION['v_id']));
			$data['like_counts'] = $like_count;
			$data['dislike_counts'] = $dislike_count;

			$_SESSION['wish'] = 'FALSE';
			$query = $this->video_model->get_wish_list($_SESSION['u_id'], $_SESSION['v_id']);
			if ($query) {
				if ($query['wish'] == 'TRUE') {
					$_SESSION['wish'] = 'TRUE';
				}

			}
		}

		$this->load->view('video', $data);
		$comment_query = $this->video_model->get_comment($video_id);
		$data['comments'] = $comment_query;
		$this->load->view('comment_show',$data);
	}

	/**
	 * connect database to filter data
	 */
	public function search_video() {
		$this->judgeSession();
		$key_words = $this->input->post("search");
		$data ['search_videos'] = $this->video_model->search_video($key_words);
		$this->load->view('header');
		$this->load->view('video_search',$data);
	}

	/**
	 * user click like video
	 */
	public function like_video() {
		$this->judgeSession();
		$query = $this->video_model->check_vote($_SESSION['u_id'], $_SESSION['v_id']);
		$attitude = $query['voting'];
		if ($attitude == 'LIKE') {
			$this->load->view('message/already_like');
		} else if ($attitude == 'DISLIKE'){
			$this->load->view('message/relike');
			$this->video_model->upload_vote($_SESSION['u_id'], $_SESSION['v_id'],'LIKE');
		} else if (!$attitude) {
			$this->video_model->vote_video($_SESSION['u_id'], $_SESSION['v_id'],'LIKE');
			redirect(site_url()."/video/video_detail/".$_SESSION['v_id']);
		}

	}

	/**
	 * user dislike video
	 */
	public function dislike_video() {
		$this->judgeSession();
		$query = $this->video_model->check_vote($_SESSION['u_id'], $_SESSION['v_id']);
		$attitude = $query['voting'];
		if ($attitude == 'LIKE') {
			$this->load->view('message/redislike');
			$this->video_model->upload_vote($_SESSION['u_id'], $_SESSION['v_id'],'DISLIKE');
		} else if ($attitude == 'DISLIKE'){
			$this->load->view('message/already_dislike');
		} else if (!$attitude) {
			$this->video_model->vote_video($_SESSION['u_id'], $_SESSION['v_id'],'DISLIKE');
		}
	}

	/**
	 * add or remove wish list
	 */
	public function add_list() {
		$this->judgeSession();
		$query = $this->video_model->get_wish_list($_SESSION['u_id'], $_SESSION['v_id']);
		$attitude = $query['wish'];
		if ($attitude == 'TRUE') {
			$this->load->view('message/remove_wishlist');
			$this->video_model->remove_wish_list($_SESSION['u_id'], $_SESSION['v_id']);
		} else {
			$this->video_model->add_wish_list($_SESSION['u_id'], $_SESSION['v_id']);
			redirect(site_url()."/video/video_detail/".$_SESSION['v_id']);
		}
	}

	/**
	 * show video comment
	 */
	public function show_comment() {
		$this->judgeSession();
		$this->load->view('comment');
	}

	/**
	 * add comment
	 */
	public function edit_comment() {
		$this->judgeSession();
		$ip = $_SERVER['REMOTE_ADDR'];
		$comment = $this->input->post("user_comment");
		if (isset($_SESSION['username'])) {
			$this->video_model->insert_comment($_SESSION['username'], $_SESSION['v_id'],$comment);
		} else {
			$this->video_model->insert_comment($ip, $_SESSION['v_id'],$comment);
		}
		redirect(site_url()."/video/video_detail/".$_SESSION['v_id']);

	}

	/**
	 * get real ip
	 */
	

	/**
	 * judge user active time
	 */
	function judgeSession() {
		if (isset($_SESSION['time'])) {
			if ($_SESSION['time'] + 1800 > time()) {
				$_SESSION['time'] = time();
			} else {
				session_destroy();
				redirect(site_url()."/user/login");
			}
		}
	}

}
