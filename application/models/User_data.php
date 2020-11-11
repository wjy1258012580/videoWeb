<?php
class User_data extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	/**
	 * get user details when user name = user name
	 * @param $username
	 * @return
	 */
	public function get_user_details($username) {
		$query = $this->db->get_where('user',array('username' => $username));
		return $query->row_array();
	}

	/**
	 * user update
	 * @param $username
	 * @param $password
	 * @param $email
	 * @param $secret_question
	 * @param $answer
	 * @return int 0 mean register success, 1 mean insert failed, return 2 mean user name same,return 3 mean email exists
	 */
	public function user_register($username, $password, $email, $secret_question, $answer) {
		$username_same = $this->db->get_where('user',array('username' => $username));
		$email_same = $this->db->get_where('user',array('email' => $email));
		if ($username_same -> row_array()) {
			return 2;
		}
		if ($email_same -> row_array()) {
			return 3;
		}
		$insert_query = $this->db->insert('user',array('username' => $username,
												'password' => $password,
												'email' => $email,
												'secret_question' => $secret_question,
												'answer' => $answer));
		if ($insert_query) {
			return 0;
		} else {
			return 1;
		}
	}

	/**
	 * update password
	 * @param $username
	 * @param $new_password
	 */
	public function change_password($username,$new_password) {
		$this->db->where('username',$username);
		$this->db->update('user', array('password' => $new_password));
	}

	/**
	 * update description
	 * @param $username
	 * @param $new_description
	 */
	public function upload_description($username, $new_description) {
		$this->db->where('username',$username);
		$this->db->update('user', array('description' => $new_description));
	}

	/**
	 * update file name
	 * @param $username
	 * @param $image_path
	 */
	public function upload_user_icon ($username,$image_path) {
		$this->db->where('username', $username);
		$this->db->update('user', array('user_icon' => $image_path));
	}

	public function get_wish_list ($u_id) {
        $query = $this->db->get_where('wishlist',array('u_id' => $u_id, 'wish'=> 'TRUE'));
        return $query->result_array();
    }

    public function get_wish_video ($v_id) {
        $query = $this->db->get_where('video',array('video_id' => $v_id));
        return $query->row_array();
    }
}
