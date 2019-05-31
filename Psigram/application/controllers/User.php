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

    public function __construct() {
        parent::__construct();
        if (! ($this->session->has_userdata('user')) ||
                ! ($this->session->userdata['user']->type == 'u')) {
            redirect();
        }

        $this->load->model("PostModel");
        $this->load->model('UserModel');

        $this->data['title'] = 'Psigram';

        $this->user = $this->session->userdata['user'];
    }

    public function index() {
        redirect('user/feed');
    }

    public function feed() {
        $this->data['posts'] = $this->PostModel->getAllPosts();

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
            $this->PostModel->addPost($config['file_name'].$this->upload->data('file_ext'), $this->user->id_user );

            redirect("User/feed");
        }
    }

    public function profile() {
        $this->data['user'] = $this->user;
        $this->data['num_posts'] = $this->UserModel->getNumberOfPosts($this->user->id_user);
        $this->data['num_followers'] = $this->UserModel->getNumberOfFollowers($this->user->id_user);
        $this->data['num_following'] = $this->UserModel->getNumberOfFollowing($this->user->id_user);
        $this->load->view('user/profile.php', $this->data);
    }

    public function logOut() {
        $this->session->unset_userdata('user');
        redirect();
    }
}
