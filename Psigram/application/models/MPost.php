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

    public function getSinglePost($id_post) {
        $user = $this->session->userdata['user'];

        return $this->db->select('*, Post.id_post, Post.id_user, CASE WHEN Likes.id_user IS NULL THEN 0 ELSE 1 END AS likes', false)
                        ->from('Post')
                        ->join('User', 'User.id_user = Post.id_user')
                        ->join('Likes', "Likes.id_post = Post.id_post AND Likes.id_user = $user->id_user", "left")
                        ->where('Post.id_post', $id_post)
                        ->order_by('Post.timestamp DESC')
                        ->get()
                        ->row();
    }

    private function prepareToGetPosts($user_ids) {
        $user = $this->session->userdata['user'];

        $this->db   ->select('*, Post.id_post, Post.id_user, CASE WHEN Likes.id_user IS NULL THEN 0 ELSE 1 END AS likes', false)
                    ->from('Post')
                    ->join('User', 'User.id_user = Post.id_user')
                    ->join('Likes', "Likes.id_post = Post.id_post AND Likes.id_user = $user->id_user", "left")
                    ->where_in('Post.id_user', $user_ids)
                    ->order_by('Post.timestamp DESC');
    }

    public function getPostsForFeed($user) {
        $all_users_ids = $this->MFollows->getFollowedUserIds($user->id_user);
        array_push($all_users_ids, $user->id_user);

        $this->prepareToGetPosts($all_users_ids);

        if ($user->type == 's') {
            $this->db->or_where('Post.sponsored', 1);
        }

        return $this->db->get()->result();
    }

    public function getPostsForProfile($id_user) {
        $this->prepareToGetPosts($id_user);

        return $this->db->get()->result();
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
        $this->db->insert('Post', $data);
    }

    public function removePost($id_post) {
        $this->db   ->where('id_post', $id_post)
                    ->delete('Post');
    }
}
