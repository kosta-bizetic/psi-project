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
        $this->db->order_by('id_post DESC');
        return $this->db->get('post')->result();
    }

    public function getPostsForFeed($id_user, $followed_users) {
        $followed_users_ids = [];
        if ($followed_users == null) {
            array_push($followed_users_ids, '');
        }else {
            foreach ($followed_users as $followed_user) {
                array_push($followed_users_ids, $followed_user->id_user_followed);
            }
        }

        return $this->db
                    ->from('post')
                    ->where('id_user', $id_user)
                    ->or_where('sponsored', 1)
                    ->or_where_in('id_user', $followed_users_ids)
                    ->order_by('id_post DESC')
                    ->get()
                    ->result();
    }

    public function addPost($image_name, $id_user) {
        $data = array(
            'image_name' => $image_name,
            'id_user' => $id_user
        );
        $this->db->insert('post', $data);
    }
}
