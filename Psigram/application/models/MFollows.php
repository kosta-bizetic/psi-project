<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MFollows
 *
 * @author Kosta
 */
class MFollows extends CI_Model{
    public function __construct() {
        parent::__construct();
    }

    public function getFollowedUserIds($id_user) {
        return $this->db->from("Follows")
                        ->select('id_user_followed')
                        ->where("id_user_following", $id_user)
                        ->get()
                        ->result();
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
        return $this->db->from("Follows")
                        ->select('id_user_following')
                        ->where("id_user_followed", $user_id)
                        ->get()
                        ->result();
    }

    public function getNumberOfFollowers($user_id) {
        return $this->db->from("Follows")
                        ->where("id_user_followed", $user_id)
                        ->count_all_results();
    }

    public function getNumberOfFollowing($user_id) {
        return $this->db->from("Follows")
                        ->where("id_user_following", $user_id)
                        ->count_all_results();
    }

    public function createFollows($id_user_following, $id_user_followed) {
        $data = array(
            'id_user_following' => $id_user_following,
            'id_user_followed' => $id_user_followed
        );

        $this->db->insert('follows', $data);
    }

    public function deleteFollows($id_user_following, $id_user_followed) {
        $this->db->where('id_user_following', $id_user_following)
                 ->where('id_user_followed', $id_user_followed)
                 ->delete('follows');
    }
}