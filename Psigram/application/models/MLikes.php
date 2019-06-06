<?php
/**
 * @author Luka Dojcilovic 2016/0135
 * @author Kosta Bizetic 2016/0121
 */

/**
 * MLikes - Model for the likes database table.
 *
 * @version 1.0
 */
class MLikes extends CI_Model {

    /**
    * Creating a new instance.
    *
    * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Method that checks whether a given users liked a given post.
     *
     * @param int $id_user - ID of the user.
     * @param int $id_post - ID of the post.
     *
     * @return bool - Does the given user like the given post.
     */
    public function getLikesExist($id_user, $id_post) {
        return $this->db->from('Likes')
                        ->where('id_user', $id_user)
                        ->where('id_post', $id_post)
                        ->get()
                        ->row() != NULL;
    }

    /**
     * Method that gets data of all the users that liked a given post from the database.
     *
     * @param int $id_post - ID of the post for which the likers should be gotten.
     *
     * @return void
     */
    public function getPostLikers($id_post) {
        return $this->db->from('Likes')
                        ->where('id_post', $id_post)
                        ->join('User', 'User.id_user = Likes.id_user')
                        ->get()
                        ->result();
    }

    /**
     * Method that adds a like from a given user to a given post.
     *
     * @param int $id_user - ID of the user.
     * @param int $id_post - ID of the post.
     *
     * @return void
     */
    public function addLikes($id_user, $id_post) {
        $data = array(
            'id_user' => $id_user,
            'id_post' => $id_post
        );
        $this->db->insert('Likes', $data);
    }

    /**
     * Method that removes a like from a given user to a given post.
     *
     * @param int $id_user - ID of the user.
     * @param int $id_post - ID of the post.
     *
     * @return void
     */
    public function removeLikes($id_user, $id_post) {
        $this->db   ->from('Likes')
                    ->where('id_user', $id_user)
                    ->where('id_post', $id_post)
                    ->delete();
    }

}
