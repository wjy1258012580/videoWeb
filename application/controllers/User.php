<?php


class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_data');
        $this->load->model('video_model');
        $this->load->helper('url_helper');
        $this->load->helper('cookie');
        $this->load->library('session');
    }

    /**
     * Show login view
     */
    public function login()
    {
        $this->load->view('header');
        $this->load->view('login');
    }

    /**
     * judge login success or failure
     * when login success, set the session
     * and if checkbox exists, set the cookie
     */
    public function login_result()
    {
        $username = $this->input->post("username");
        $password = $this->input->post("password");
        $checkbox = $this->input->post("checkbox");
        $query = $this->user_data->get_user_details($username);
        $email = $query['email'];
        $hash_password = $query['password'];
        $description = $query['description'];

        if ($query) {

            if (password_verify($password, $hash_password)) {
                if ($checkbox) {
                    set_cookie('username', $username, time() - 3600);
                } else {
                    delete_cookie('username');
                }
                if ($query['user_icon']) {
                    $_SESSION['user_icon'] = $query['user_icon'];

                }
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;
                $_SESSION['email'] = $email;
                $_SESSION['description'] = $description;
                $_SESSION['time'] = time();
                $_SESSION['secret_question'] = $query['secret_question'];
                $_SESSION['u_id'] = $query['user_id'];
                $_SESSION['login'] = true;
                $data['username'] = $username;
                $this->load->view('header');
                $this->load->view('success_login', $data);
            } else {
                $this->load->view('header');
                $this->load->view('failure_login');
            }

        } else {
            $this->load->view('failure_login');
        }
    }

    /**
     * go to register page
     */
    public function register()
    {
        $this->load->view('header');
        $this->load->view('register');
    }

    /**
     * handle register.
     * Get the details using input->post(info)
     * and password_hash the secret answer and password
     * $ create_success  = 0 mean register success, 1 mean insert failed,
     * 2 mean user name same, 3 mean email exists
     */
    public function register_result()
    {
        $register_username = $this->input->post("username");
        $password = $this->input->post("password");
        if (strlen($password) > 7) {
            $register_password = password_hash($password, PASSWORD_DEFAULT);
            $email = $password = $this->input->post("email");
            $secret_question = $this->input->post("secret_question");
            $answer = password_hash($this->input->post("answer"), PASSWORD_DEFAULT);

            $create_success = $this->user_data->user_register($register_username, $register_password, $email, $secret_question, $answer);
            if ($create_success == 0) {
                $this->load->view('header');
                $this->load->view('register_success');
            } else if ($create_success == 1) {
                $this->load->view('header');
                $this->load->view('message/register_error_1');
            } else if ($create_success == 2) {
                $this->load->view('header');
                $this->load->view('message/register_error_2');
            } else if ($create_success == 3) {
                $this->load->view('header');
                $this->load->view('message/register_error_3');
            } else {
                $this->load->view('header');
                $this->load->view('message/register_error_1');
            }
        } else {
            $this->load->view("message/password_short");
        }

    }

    /**
     * show user profile, if not login, it will show error
     */
    public function user_profile()
    {
        if ($_SESSION['time'] + 1800 > time()) {
            $_SESSION['time'] = time();
            $this->load->view('header');
            if (isset($_SESSION['login'])) {
                $this->load->view('user_profile');
            } else {
                $this->load->view('message/user_profile_error');
            }
        } else {
            session_destroy();
            redirect(site_url() . "/user/login");
        }
    }

    /**
     * show location view
     */
    public function location()
    {
        $this->timeControl();
        $this->load->view('header');
        $this->load->view('location');
    }

    /**
     * go to edit password pages
     */
    public function edit()
    {
        $this->timeControl();
        $this->load->view('header');
        $this->load->view('edit_user_password');
    }

    /**
     * deal with user password. if new password and old password are same -> show error
     *  if old password and password in database not match ->show error
     */
    public function edit_user_password()
    {
        $this->timeControl();
        $new_password = password_hash($this->input->post("new_password"), PASSWORD_DEFAULT);

        $query = $this->user_data->get_user_details($_SESSION['username']);
        if ($new_password != $query['password']) {
            $this->user_data->change_password($_SESSION['username'], $new_password);
            session_destroy();
            $this->load->view('message/success_change_password');
        } else {
            $this->load->view('message/failure_edit_password');
        }


    }

    /**
     * go to edit profile view
     */
    public function edit_profile()
    {
        $this->timeControl();
        $this->load->view('header');
        $data['description'] = $_SESSION['description'];
        $this->load->view('edit_profile', $data);
    }

    /**
     * handle update description
     */
    public function edit_user_profile()
    {
        $this->timeControl();
        $description = $_POST['descr'];
        if ($description != $_SESSION['description']) {
            $this->user_data->upload_description($_SESSION['username'], $description);
            $_SESSION['description'] = $description;
            $this->load->view('header');
            $this->load->view('message/upload_success_icon');
        } else {
            $this->load->view('header');
            $this->load->view('message/description_same');
        }
    }

    /**
     * log out, destroy session
     */
    public function logout()
    {
        $_SESSION = array();
        redirect(site_url() . "/home");
    }

    /**
     * go to verify username page
     */
    public function verify()
    {
        $this->timeControl();
        $this->load->view('verify_username');
    }

    /**
     * deal with verify username and email
     */
    public function verify_username()
    {
        $this->timeControl();
        $verify_username = $this->input->post("username");
        $verify_email = $this->input->post("email");
        if (isset($_SESSION['login'])) {
            if ($verify_username == $_SESSION['username'] && $verify_email == $_SESSION['email']) {
                $query = $this->user_data->get_user_details($verify_username);
                $data['secret_question'] = $query['secret_question'];
                $this->load->view('verify_user_details', $data);
            } else {
                $this->load->view('message/username_incorrect');
            }
        } else {
            $query = $this->user_data->get_user_details($verify_username);
            if ($query) {
                if ($verify_username == $query['username'] && $verify_email == $query['email']) {
                    $_SESSION['username'] = $verify_username;
                    $_SESSION['secret_question'] = $query['secret_question'];
                    $data['secret_question'] = $query['secret_question'];
                    $this->load->view('verify_user_details', $data);
                } else {
                    $this->load->view('message/username_incorrect');
                }
            } else {
                $this->load->view('message/username_incorrect');
            }
        }

    }

    /**
     * judge the secret question answer
     */
    public function verify_details()
    {
        $this->timeControl();
        $secret_answer = $this->input->post("answer");
        $query = $this->user_data->get_user_details($_SESSION['username']);
        if (password_verify($secret_answer, $query['answer'])) {
            redirect(site_url() . '/user/edit');
        } else {
            $this->load->view('secretAns_failure');
        }
    }

    public function autocompletion()
    {

        $keyword = $this->input->get("keyword");
        $name_array = $this->video_model->auto_completion($keyword);
        $response = "<ul>";
        foreach ($name_array as $name) {
            $list = "showWord('" . $name['video_name'] . "')";
            $response = $response . '<li onclick="' . $list . '">' . $name['video_name'] . "</li>";
        }
        $response = $response . "</ul>";
        echo $response;
    }

    function timeControl()
    {
        if (isset($_SESSION['login'])) {
            if ($_SESSION['time'] + 1800 > time()) {
                $_SESSION['time'] = time();
            } else {
                session_destroy();
                redirect(site_url() . "/user/login");
            }
        }
    }


    function get_wish_list()
    {
        if (isset($_SESSION['u_id'])) {
            $query = $this->user_data->get_wish_list($_SESSION['u_id']);
            $videos = array();
            foreach ($query as  $video) {
                $video_row = $this->user_data->get_wish_video($video['v_id']);
                array_push($videos, $video_row);
            }
            $data['wish_videos'] = $videos;
            $this->load->view('header');
            $this->load->view('wishlist', $data);
        } else {
            $this->load->view('header');
            $this->load->view('message/failure_wishlist');
        }
    }
}

