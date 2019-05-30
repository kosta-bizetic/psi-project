<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PostModel
 *
 * @author LukaDojcilovic
 */
class PostModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getAllPosts() {
        return $this->db->get('post')->result();
    }

    public function addPost($image_name, $id_user) {
        $data = array(
            'image_name' => $image_name,
            'id_user' => $id_user
        );
        $this->db->insert('post', $data);
    }
}
