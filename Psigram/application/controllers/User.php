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

    public function __construct() {
        parent::__construct();
        if (! ($this->session->has_userdata('user')) ||
                ! ($this->session->userdata['user']->type == 'u')) {
            redirect();
        }
        $this->data['title'] = 'Psigram';
    }

    public function index() {
        $this->feed();
    }

    public function feed() {
        $this->load->view('templates/UserHeader.php', $this->data);
    }

    public function addPost() {
        if (empty($this->input->post('upload'))) {
            $this->load->view('templates/UserHeader.php', $this->data);
            $this->load->view('templates/AddPost.php', $this->data);
        } else {
            $user = $this->session->userdata['user'];
            $config['upload_path']          = '..//Uploads//';
            $config['file_name']            = $user->username."_".time();
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 2000;
            $config['max_width']            = 1024;
            $config['max_height']           = 768;

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('image'))
            {
                    $this->data['error'] = $this->upload->display_errors();

                    $this->load->view('templates/UserHeader.php', $this->data);
                    $this->load->view('templates/AddPost.php', $this->data);
            }
            else
            {
                    // $data = array('upload_data' => $this->upload->data());

                    redirect("User/feed");
            }
        }
    }

    public function profile() {
        $this->load->view('templates/UserHeader.php', $this->data);

        $user = $this->session->userdata['user'];
        $this->data['user'] = $user;
        $this->data['num_posts'] = $this->db
                ->from("Post")
                ->where("id_user", $user->id_user)
                ->count_all_results();
        $this->data['num_followers'] = $this->db
                ->from("Follows")
                ->where("id_user_followed", $user->id_user)
                ->count_all_results();
        $this->data['num_following'] = $this->db
                ->from("Follows")
                ->where("id_user_following", $user->id_user)
                ->count_all_results();

        $this->load->view('templates/Profile.php', $this->data);
    }

    public function logOut() {
        $this->session->unset_userdata('user');
        redirect();
    }
}
