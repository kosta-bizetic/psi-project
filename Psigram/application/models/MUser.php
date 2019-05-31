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
class MUser extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function getUserByUsername($username) {
        return $this->db->from('user')
                        ->where('username', $username)
                        ->get()
                        ->row();
    }

    public function getUserById($id_user) {
        return $this->db->from('user')
                        ->where('id_user', $id_user)
                        ->get()
                        ->row();
    }

    public function getAllUsers() {
        return $this->db->from('user')
                        ->get()
                        ->result();
    }

    public function usernameExists($username) {
        return $this->db->where('username', $username)
                        ->get('user')
                        ->row() != NULL;
    }

    public function emailExists($email) {
        return $this->db
                    ->where('email', $email)
                    ->get('user')
                    ->row() != NULL;
    }

    public function addUser($data) {
        $this->db->insert('user', $data);
    }

}
