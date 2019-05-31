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
        return $this->db
                    ->from("Follows")
                    ->select('id_user_followed')
                    ->where("id_user_following", $id_user)
                    ->get()
                    ->result_array();
    }
}
