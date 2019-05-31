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
class MPost extends CI_Model {

    public function __construct() {
        parent::__construct();

        $this->load->model("MFollows");
    }

    public function getAllPosts() {
        $this->db->order_by('id_post DESC');
        return $this->db->get('post')->result();
    }

    public function getPostsForFeed($user) {
        $all_users_ids = [];
        $users_followed = $this->MFollows->getFollowedUserIds($user->id_user);
        foreach ($users_followed as $user_followed) {
            array_push($all_users_ids, $user_followed->id_user_followed);
        }
        array_push($all_users_ids, $user->id_user);

        $this->db->from('post')
                 ->where_in('id_user', $all_users_ids);
        if ($user->type == 'u') {
            $this->db->or_where('sponsored', 1);
        }
        $this->db->order_by('timestamp DESC');

        return $this->db->get()->result();
    }

    public function getPostsForProfile($id_user) {
        return $this->db
                    ->from('post')
                    ->where('id_user', $id_user)
                    ->order_by('id_post DESC')
                    ->get()
                    ->result();
    }

    public function getNumberOfPosts($user_id) {
        return $this->db->from("Post")
                        ->where("id_user", $user_id)
                        ->count_all_results();
    }

    public function addPost($image_name, $id_user) {
        $data = array(
            'image_name' => $image_name,
            'id_user' => $id_user
        );
        $this->db->insert('post', $data);
    }
}