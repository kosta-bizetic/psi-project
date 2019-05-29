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
