<?php
/**
 * @author Luka Dojcilovic 2016/0135
 * @author Kosta Bizetic 2016/0121
 */

/**
 * MComment - Model for the comment database table.
 *
 * @version 1.0
 */
class MComment extends CI_Model {

    /**
    * Creating a new instance.
    *
    * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Method that gets all comments of a given post from the database.
     *
     * @param int $id_post - ID of the post for which the comments should be gotten.
     *
     * @return  Array of objects containing comment data.
     */
    public function getComments($id_post) {
        return $this->db->from('Comment')
                        ->join('User', 'User.id_user = Comment.id_user')
                        ->where('id_post', $id_post)
                        ->order_by('Comment.timestamp ASC')
                        ->get()
                        ->result();
    }

    /**
     * Method that gets data of a given comment from the database.
     *
     * @param int $id_comment - ID of the comment for which the data should be gotten.
     *
     * @return Object containing comment data.
     */
    public function getComment($id_comment) {
        return $this->db->from('Comment')
                        ->where('id_comment', $id_comment)
                        ->get()
                        ->row();
    }

    /**
     * Array that adds a comment by a given user to a given post to the database.
     *
     * @param string $text - Contents of the comment.
     * @param int $id_user - ID of the user who created the comment.
     * @param int $id_post - ID of the post to which the comment should be added.
     *
     * @return void
     */
    public function addComment($text, $id_user, $id_post) {
        $data = array(
            'text' => $text,
            'id_user' => $id_user,
            'id_post' => $id_post
        );
        $this->db->insert('Comment', $data);
    }

    /**
     * Method that removes a given comment from the database.
     *
     * @param int $id_comment - ID of the comment to be removes.
     *
     * @return void
     */
    public function removeComment($id_comment) {
        $this->db   ->where('id_comment', $id_comment)
                    ->delete("Comment");
    }
}
