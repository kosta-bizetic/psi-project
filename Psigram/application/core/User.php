<?php

require_once 'PSIController.php';

/**
 * Description of User
 *
 * @author Kosta
 */
class User extends PSIController {

    var $user;

    public function __construct() {
        parent::__construct();
        if (! ($this->session->has_userdata('user'))) {
            redirect();
        }

        $this->load->model('MUser');
        $this->load->model('MPost');
        $this->load->model('MComment');
        $this->load->model('MFollows');
        $this->load->model('MLikes');
        $this->load->model('MComment');

        $this->user = $this->session->userdata['user'];
    }

    public function index() {
        redirect("$this->class_name/feed");
    }

    public function feed() {
        $this->data['posts'] = $this->MPost->getPostsForFeed($this->user);

        $this->load->view('user/feed.php', $this->data);
    }

    public function addPost() {
        $this->load->view('user/addPost.php', $this->data);
    }

    public function addPostHandler() {
        $config['upload_path']          = 'uploads//';
        $config['file_name']            = $this->user->username."_".time();
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 4000;
        $config['max_width']            = 1024*4;
        $config['max_height']           = 768*4;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('image')) {
                $this->data['error'] = $this->upload->display_errors();
                $this->addPost();
        } else {
            $this->MPost->addPost($config['file_name'].$this->upload->data('file_ext'), $this->user->id_user );

            redirect("$this->class_name/feed");
        }
    }

    public function profile($user_id=NULL) {
        $profile_user = $this->user;
        if ($user_id != NULL) {
            $profile_user = $this->MUser->getUser($user_id);
        }
        $this->data['user'] = $profile_user;
        $this->data['follows'] = $this->MFollows->getFollows($this->user->id_user, $profile_user->id_user);
        $this->data['posts'] = $this->MPost->getPostsForProfile($profile_user->id_user);
        $this->load->view('user/profile.php', $this->data);
    }

    public function editProfile() {
        $this->form_validation->set_rules('username', 'Username', array('required', array('otherUsernameDoesntExist', array($this->MUser, "otherUsernameDoesntExist"))));
        $this->form_validation->set_message('otherUsernameDoesntExist', '{field} already exists');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required|alpha_numeric_spaces');
        $this->form_validation->set_rules('surname', 'Last name', 'required|alpha_numeric_spaces');
        $this->form_validation->set_rules('email', 'Email', array('required', array('otherEmailDoesntExist', array($this->MUser, "otherEmailDoesntExist"))));
        $this->form_validation->set_message('otherEmailDoesntExist', '{field} already exists');
        $this->form_validation->set_rules('date_of_birth', 'Date of birth', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required|in_list[m,f]');
        if ($this->user->type != 'a') {
            $this->form_validation->set_rules('type', 'Account type', 'required|in_list[s,b]');
        } else {
            $this->form_validation->set_rules('type', 'Account type', 'required|in_list[s,b,a]');
        }


        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'name' => $this->input->post('name'),
                'surname' => $this->input->post('surname'),
                'email' => $this->input->post('email'),
                'date_of_birth' => $this->input->post('date_of_birth'),
                'gender' => $this->input->post('gender'),
                'type' => $this->input->post('type')
            );

            $this->MUser->updateUser($this->user->id_user, $data);
            $user = $this->MUser->getUserByUsername($data['username']);

            $this->session->set_userdata('user', $user);

            $this->redirectToType('profile');
        } else {
            $this->data['user'] = $this->user;
            $this->load->view('user/editProfile.php', $this->data);
        }
    }

    public function followHandler($id_user_followed) {
        $this->MFollows->addFollows($this->user->id_user, $id_user_followed);
        $this->redirectToLastURI();
    }

    public function unfollowHandler($id_user_followed) {
        $this->MFollows->removeFollows($this->user->id_user, $id_user_followed);
        $this->redirectToLastURI();
    }

    public function likeHandler($id_post, $likes) {
        if (!$likes) {
            $this->MLikes->addLikes($this->user->id_user, $id_post);
        } else {
            $this->MLikes->removeLikes($this->user->id_user, $id_post);
        }

        $this->redirectToLastURI();
    }

    public function post($id_post) {
        $post = $this->MPost->getSinglePost($id_post);
        if ($post == NULL) {
            switch ($this->user->type) {
                case 'a': redirect($this->class_name.'/feed');
                default: redirect($this->class_name.'/profile/'.$this->user->id_user);
            }
        }

        $this->data['post'] = $post;
        $this->data['comments'] = $this->MComment->getComments($id_post);

        $this->load->view('user/post.php', $this->data);
    }

    public function addCommentHandler($id_post) {
        $comment_text = $this->input->post('comment_text');
        if ( ! empty($comment_text)) {
            $this->MComment->addComment($comment_text, $this->user->id_user, $id_post);
        }
        $this->redirectToLastURI();
    }

    public function logOut() {
        $this->session->unset_userdata('user');
        redirect();
    }

    public function search() {
        $search_text = $this->input->post('search_text');
        $this->data['users'] = $this->MUser->searchUsers($search_text);

        $this->load->view('user/userList.php', $this->data);
    }

    public function likers($post_id) {
        $this->data['users'] = $this->MLikes->getPostLikers($post_id);

        $this->load->view('user/userList.php', $this->data);
    }

    public function followers($user_id) {
        $this->data['users'] = $this->MUser->getFollowers($user_id);

        $this->load->view('user/userList.php', $this->data);
    }

    public function following($user_id) {
        $this->data['users'] = $this->MUser->getFollowing($user_id);

        $this->load->view('user/userList.php', $this->data);
    }

    public function deleteCommentHandler($id_comment) {
        $comment = $this->MComment->getComment($id_comment);
        if ($comment->id_user == $this->user->id_user) {
            $this->MComment->removeComment($id_comment);
            $this->redirectToLastURI();
        } else {
            redirect();
        }
    }

    public function deletePostHandler($id_post) {
        $post = $this->MPost->getPost($id_post);
        if ($post->id_user == $this->user->id_user) {
            $this->MPost->removePost($id_post);
            $this->redirectToLastURI();
        } else {
            redirect();
        }
    }
}