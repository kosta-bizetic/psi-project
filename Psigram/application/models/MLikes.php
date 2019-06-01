<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MLikes
 *
 * @author Kosta
 */
class MLikes extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function getLikesExist($id_user, $id_post) {
        return $this->db->from('Likes')
                        ->where('id_user', $id_user)
                        ->and_where('id_post', $id_post)
                        ->get()
                        ->row() != NULL;
    }

    public function addLikes($id_user, $id_post) {
        $data = array(
            'id_user' => $id_user,
            'id_post' => $id_post
        );
        $this->db->insert('Likes', $data);
    }

    public function removeLikes($id_user, $id_post) {
        $this->db   ->from('Likes')
                    ->where('id_user', $id_user)
                    ->where('id_post', $id_post)
                    ->delete();
    }
}
