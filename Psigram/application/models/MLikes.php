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
                        ->where('id_post', $id_post)
                        ->get()
                        ->row() != NULL;
    }

    public function getPostLikers($id_post) {
        return $this->db->from('Likes')
                        ->where('id_post', $id_post)
                        ->join('User', 'User.id_user = Likes.id_user')
                        ->get()
                        ->result();
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
