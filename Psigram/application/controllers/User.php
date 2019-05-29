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
        $this->data['title'] = 'Psigram';
    }
    
    public function index() {
        $this->feed();
    }
    
    public function feed() {
        $this->load->view('templates/UserHeader.php', $this->data);
    }
    
    public function logOut() {
        $this->session->unset_userdata('user');
        redirect();
    }
}
