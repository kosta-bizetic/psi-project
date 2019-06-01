<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KorisnikController
 *
 * @author Kosta
 */
class User extends CI_Controller {

    var $data = array();
    var $user;
    var $class_name;

    public function __construct() {
        parent::__construct();
        if (! ($this->session->has_userdata('user'))) {
            redirect();
        }

        $this->load->model('MPost');
        $this->load->model('MUser');
        $this->load->model('MFollows');

        $this->data['title'] = 'Psigram';
        $this->user = $this->session->userdata['user'];
        $this->class_name = get_class($this);
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
        $config['max_size']             = 2000;
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

    public function profile($user_id) {
        $profile_user = $this->MUser->getUserById($user_id);
        $this->data['user'] = $profile_user;
        $this->data['follows'] = $this->MFollows->getFollows($this->user->id_user, $profile_user->id_user);
        $this->data['num_posts'] = $this->MPost->getNumberOfPosts($profile_user->id_user);
        $this->data['num_followers'] = $this->MFollows->getNumberOfFollowers($profile_user->id_user);
        $this->data['num_following'] = $this->MFollows->getNumberOfFollowing($profile_user->id_user);
        $this->data['posts'] = $this->MPost->getPostsForProfile($profile_user->id_user);
        $this->load->view('user/profile.php', $this->data);
    }

    public function followHandler($id_user_followed) {
        $this->MFollows->addFollows($this->user->id_user, $id_user_followed);
        redirect("$this->class_name/profile/".$id_user_followed);
    }

    public function unfollowHandler($id_user_followed) {
        $this->MFollows->removeFollows($this->user->id_user, $id_user_followed);
        redirect("$this->class_name/profile/".$id_user_followed);
    }

    public function logOut() {
        $this->session->unset_userdata('user');
        redirect();
    }

    public function search() {
        $this->data['users'] = $this->MUser->getAllUsers();

        $this->load->view('user/search.php', $this->data);
    }

}