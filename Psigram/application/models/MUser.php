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
        return $this->db->from('User')
                        ->where('username', $username)
                        ->get()
                        ->row();
    }

    public function getUserById($id_user) {
        return $this->db->from('User')
                        ->where('id_user', $id_user)
                        ->get()
                        ->row();
    }

    public function getAllUsers() {
        return $this->db->from('User')
                        ->get()
                        ->result();
    }

    public function searchUsers($search_text) {
        $words = preg_split("/[\s]+/", strtolower($search_text));
        $this->db   ->from('User')
                    ->like('name', '', 'none');
        foreach ($words as $word) {
            $this->db->or_like('LOWER(username)', $word, 'after');
            $this->db->or_like('LOWER(name)', $word, 'after');
            $this->db->or_like('LOWER(surname)', $word, 'after');
        }

        return $this->db->get()
                        ->result();
    }

    public function getFollowers($user_id) {
        return $this->db->from('Follows')
                        ->join('User', 'User.id_user = Follows.id_user_following')
                        ->where('Follows.id_user_followed', $user_id)
                        ->get()
                        ->result();
    }

    public function getFollowing($user_id) {
        return $this->db->from('Follows')
                        ->join('User', 'User.id_user = Follows.id_user_followed')
                        ->where('Follows.id_user_following', $user_id)
                        ->get()
                        ->result();
    }

    public function usernameExists($username) {
        return $this->db->from('User')
                        ->where('username', $username)
                        ->get()
                        ->row() != NULL;
    }

    public function emailExists($email) {
        return $this->db->from('User')
                        ->where('email', $email)
                        ->get()
                        ->row() != NULL;
    }

    public function addUser($data) {
        $this->db->insert('user', $data);
    }

}
