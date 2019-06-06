<?php
/**
 * @author Luka Dojcilovic 2016/0135
 * @author Kosta Bizetic 2016/0121
 */

/**
 * MFollows - Model for the Follows database table.
 *
 * @version 1.0
 */
class MFollows extends CI_Model{

    /**
    * Creating a new instance.
    *
    * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Method that gets data of all users that a given users follows from the database.
     *
     * @param int $id_user - ID of users whose data should be gotten.
     *
     * @return Array of strings of IDs of the followed users.
     */
    public function getFollowedUserIds($id_user) {
        $followed_user_ids = $this->db  ->from("Follows")
                                        ->select('id_user_followed')
                                        ->where("id_user_following", $id_user)
                                        ->get()
                                        ->result_array();
        return array_column($followed_user_ids, 'id_user_followed');
    }


    /**
     * Method that checks whether a given user follows another given user.
     *
     * @param int $id_user_following - ID of the user following.
     * @param int $id_user_followed - ID of the user followed.
     *
     * @return bool - Does the following user follow the followed user.
     */
    public function getFollows($id_user_following, $id_user_followed) {
        return $this->db
                    ->from("Follows")
                    ->where('id_user_following', $id_user_following)
                    ->where('id_user_followed', $id_user_followed)
                    ->get()
                    ->result() != NULL;
    }

    /**
     * Method that adds a following between two users to the database.
     *
     * @param int $id_user_following - ID of the user following.
     * @param int $id_user_followed - ID of the followed user.
     *
     * @return void
     */
    public function addFollows($id_user_following, $id_user_followed) {
        $data = array(
            'id_user_following' => $id_user_following,
            'id_user_followed' => $id_user_followed
        );

        $this->db->insert('Follows', $data);
    }

    /**
     * Method that removes a following between two users from the database.
     *
     * @param int $id_user_following - ID of the user following.
     * @param int $id_user_followed - ID of the followed user.
     *
     * @return void
     */
    public function removeFollows($id_user_following, $id_user_followed) {
        $this->db->where('id_user_following', $id_user_following)
                 ->where('id_user_followed', $id_user_followed)
                 ->delete('Follows');
    }
}
