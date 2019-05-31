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
    public function __construct() {
        parent::__construct();
    }

    public function getUserByUsername($username) {
        return $this->db
                    ->where('username', $username)
                    ->get('user')
                    ->row();
    }

    public function getUserById($id_user) {
        return $this->db
                    ->where('id_user', $id_user)
                    ->get('user')
                    ->row();
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

    public function getFollows($id_user_following, $id_user_followed) {
        return $this->db
                    ->from("Follows")
                    ->where('id_user_following', $id_user_following)
                    ->where('id_user_followed', $id_user_followed)
                    ->get()
                    ->result() != NULL;
    }

    public function getFollowers($user_id) {
        return $this->db
                    ->select('id_user_following')
                    ->from("Follows")
                    ->where("id_user_followed", $user_id)
                    ->get()
                    ->result();
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
