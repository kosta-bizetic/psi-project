<?php

/**
 * Description of MComment
 *
 * @author Kosta
 */
class MComment extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function getCommentsForPost($id_post) {
        return $this->db->from('Comments')
                        ->join('User', 'User.id_user = Comments.id_user')
                        ->where('id_post', $id_post)
                        ->get()
                        ->result();
    }

    public function addComment($text, $id_user, $id_post) {
        $data = array(
            'text' => $text,
            'id_user' => $id_user,
            'id_post' => $id_post
        );
        $this->db->insert('Comment', $data);
    }

    public function removeComment($id_comment) {
        $this->db   ->where('id_comment', $id_comment)
                    ->delete("Comment");
    }
}