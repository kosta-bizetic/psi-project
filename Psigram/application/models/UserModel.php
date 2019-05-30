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
        $this->user = $this->db->where('username', $username)
                               ->get('user')->row();

        return $this->user != NULL;
    }

    public function checkPassword($password) {
        return $this->user->password == $password;
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

    public function getNumberOfPosts($user_id) {
        return $this->db
                    ->from("Post")
                    ->where("id_user", $user_id)
                    ->count_all_results();
    }

    public function getNumberOfFollowers($user_id) {
        return $this->db
                    ->from("Follows")
                    ->where("id_user_followed", $user_id)
                    ->count_all_results();
    }

    public function getNumberOfFollowing($user_id) {
        return $this->db
                    ->from("Follows")
                    ->where("id_user_following", $user_id)
                    ->count_all_results();
    }

}
