<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserController
 *
 * @author LukaDojcilovic
 */
class UserModel extends CI_Model {
    public $user;

    public function __construct() {
        parent::__construct();
    }
    
    public function getUser($username) {
        $result = $this->db->where('username', $username)
                    ->get('user');
        
        $this->user = $result->row();
        
        if($this->user == NULL){
            return false;
        }
        return true;
    }
    
    public function checkPassword($password) {
        return $this->user->password == $password;
    }
    
}