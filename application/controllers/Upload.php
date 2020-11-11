<?php


class Upload extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper("form","url");
		$this->load->model('user_data');
		$this->load->model('video_model');
		$this->load->library('session');
	}

	/**
	 * go to upload icon view
	 */
	public function upload() {
		$this->load->view('upload_icon');
	}

	/**
	 * This function to handle upload icon
	 */
	public function do_upload() {
		$config['upload_path']='./uploads/';
		$config['allowed_types']='gif|jpg|png';
		$config['max_size']=100;
		$config['max_width']=1024;
		$config['max_height']=768;
		$this->load->library('upload',$config);
		if($this->upload->do_upload('userfile')){
			$filename = $this->upload->data('file_name');
			$path = $filename;
			$_SESSION['user_icon'] = $filename;
			$this->user_data->upload_user_icon($_SESSION['username'],$path);
			$this ->load-> view('message/upload_success_icon');
		}else{
			$error = array("error" => $this->upload->display_errors());
			$this->load->view('message/failure_upload',$error);
		}
	}

	/**
	 * go to upload video page
	 */
	public function upload_video() {
		$this->load->view('header');
		$this->load->view('upload_video');

	}

	/**
	 * Get the video details from view, and use session to save it
	 */
	public function edit_video_details() {
		$video_name = $this->input->post("video_name");
		if (isset($_POST['select'])) {
            $tag = $_POST['select'];
        }
		if (isset($_POST['hash_select'])) {
            $hash = $_POST['hash_select'];
        }
        if (isset($tag)) {
            $_SESSION['tag'] = $tag;
        } else {
            $_SESSION['tag'] = 'Other';
        }
        if (isset($hash)) {
            $_SESSION['hash'] = $hash;
        } else {
            $_SESSION['hash'] = 'FALSE';
        }
		$video_description = $this->input->post("video_description");
		$_SESSION['video_name'] = $video_name;
		$_SESSION['video_description'] = $video_description;
		$uploader = $_SESSION['username'];
		if ($_SESSION['hash'] == 'TRUE') {
			$_SESSION['uploader'] = crc32($uploader);
		} else {
			$_SESSION['uploader'] = $uploader;
		}
		$this->load->view('choose_video');
	}

	/**
	 * handle upload video, and get the sessions details
	 * and filename from upload->data
	 * put them to database
	 */
	public function deal_upload_video() {
		$config['upload_path']='./uploads/';
		$config['allowed_types']='mp4|ogg|webm';
		$config['max_size']=100000;
		$config['max_width']=1280;
		$config['max_height']=1280;
		$this->load->library('upload',$config);
		if($this->upload->do_upload('userfile')){
			$filename = $this->upload->data('file_name');
			$this->video_model->upload_video($_SESSION['video_name'],$_SESSION['uploader'],$_SESSION['video_description'],$_SESSION['u_id'],$filename,$_SESSION['tag'],$_SESSION['hash']);
			$data['filename'] = $filename;
			$this ->load-> view('message/upload_success', $data);
		}else{
			$error = array("error" => $this->upload->display_errors());
			$this->load->view('choose_video',$error);
		}
	}
}
