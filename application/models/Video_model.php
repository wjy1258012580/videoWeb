<?php


class Video_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_all_video() {
		$query = $this->db->get('video');
		return $query->result_array();
	}

	public function get_video($video_id) {
		$this->db->where('video_id',$video_id);
		$query = $this->db->get('video');
		return $query -> row_array();
	}

	public function upload_video($video_name, $video_uploader, $video_description, $u_id, $video_path_filename, $tag,$hash) {
		$this->db->insert('video',array('video_name' => $video_name,
			'video_uploader' => $video_uploader,
			'video_description' => $video_description,
			'u_id' => $u_id,
			'video_path_filename' => $video_path_filename,
			'tag' => $tag,
			'hash' =>$hash));
	}

	public function search_video($key_words) {
		$this->db->like('video_description', $key_words, 'both');
		$this->db->or_like('video_name', $key_words, 'both');
		return $this -> db -> get('video')->result_array();
	}

	public function auto_completion($key_words) {

		$this->db->like('video_name', $key_words, 'both');
		return $this -> db -> get('video')->result_array();
	}

	public function vote_video($u_id,$v_id,$like) {
		$this->db->insert('vote',array('u_id' => $u_id,
			'v_id' => $v_id,
			'voting' => $like));
	}

	public function check_vote($u_id,$v_id) {
		$query = $this->db->get_where('vote',array('u_id' => $u_id, 'v_id' => $v_id));
		return $query -> row_array();
	}

	public function like_count($u_id,$v_id) {
		$query =$this->db->get_where('vote',array('u_id' => $u_id, 'v_id' => $v_id , 'voting' => 'LIKE'));
		return $query -> result();
	}

	public function dislike_count($u_id,$v_id) {
		$query = $this->db->get_where('vote',array('u_id' => $u_id, 'v_id' => $v_id , 'voting' => 'DISLIKE'));
		return $query -> result();
	}

	public function upload_vote($u_id,$v_id,$like) {
		$this->db->where('u_id',$u_id);
		$this->db->where('v_id',$v_id);
		$this->db->update('vote', array('voting' => $like));
	}

	public function add_wish_list($u_id,$v_id) {
		$this->db->insert('wishlist',array('u_id' => $u_id,
			'v_id' => $v_id,
			'wish' => 'TRUE'));
	}

	public function remove_wish_list($u_id,$v_id) {
		$this->db->delete('wishlist',array('u_id' => $u_id,
			'v_id' => $v_id));
	}

	public function get_wish_list($u_id,$v_id) {
		$query = $this->db->get_where('wishlist',array('u_id' => $u_id,
			'v_id' => $v_id));
		return $query->row_array();
	}

//	public function dashboard($date) {
//		$query = $this->db->query("SELECT v_id, count(*) as count FROM vote WHERE time = ".$date." AND voting = 'LIKE' GROUP BY v_id ORDER BY count DESC LIMIT 1");
//		return $query->row_array();
//	}

	public function insert_comment($username,$v_id,$comment) {
		$this->db->insert('comment',array('username' => $username,
			'v_id' => $v_id,
			'comment' => $comment));
	}

	public function get_comment($v_id) {
		$query = $this->db->get_where('comment',array(
			'v_id' => $v_id));
		return $query->result_array();
	}

	public function recommendation($u_id) {
		$query = $this->db->query("SELECT D.tag as tag, count(*) as count FROM vote V, video D WHERE V.u_id = ".$u_id." AND D.video_id = V.v_id AND V.voting = 'LIKE' GROUP BY D.tag ORDER BY count DESC LIMIT 1");
		return $query->row_array();
	}

	public function filter($tag) {
		$this->db->where('tag',$tag);
		$query = $this->db->get('video');
		return $query -> result_array();
}
}
