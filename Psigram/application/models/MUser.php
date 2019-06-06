<?php
/**
 * @author Luka Dojcilovic 2016/0135
 * @author Kosta Bizetic 2016/0121
 */

/**
 * MUser - Model for the user database table.
 *
 * @version 1.0
 */
class MUser extends CI_Model {

    /**
    * Creating a new instance.
    *
    * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Method that gets user data from the database.
     *
     * @param string $username - username of the user.
     * @return Object containing user data
     */
    public function getUserByUsername($username) {
        return $this->db->from('User')
                        ->where('username', $username)
                        ->get()
                        ->row();
    }

    /**
     * Method that gets user data from the database.
     *
     * @param int $id_user - id of the user.
     * @return Object containing user data.
     */
    public function getUser($id_user) {
        return $this->db->from('User')
                        ->where('id_user', $id_user)
                        ->get()
                        ->row();
    }

    /**
     * Method which searches the database for users based on search text.
     *
     * @param string $search_text - Text to search for.
     * @return Array of objects containing user data.
     */
    public function searchUsers($search_text) {
        $words = preg_split("/[\s]+/", strtolower($search_text));
        $this->db   ->from('User')
                    ->like('name', '', 'none');
        foreach ($words as $word) {
            $this->db->or_like('LOWER(username)', $word, 'after');
            $this->db->or_like('LOWER(name)', $word, 'after');
            $this->db->or_like('LOWER(surname)', $word, 'after');
        }

        return $this->db->get()
                        ->result();
    }

    /**
     * Helper method which prepares the query to get followers of a given user
     * from the database.
     *
     * @param int $id_user - id of the given user.
     */
    protected function prepareToGetFollowers($id_user) {
        $this->db   ->from('Follows')
                    ->join('User', 'User.id_user = Follows.id_user_following')
                    ->where('Follows.id_user_followed', $id_user);
    }

    /**
     * Method which gets all followers of a given user from the database.
     *
     * @param int $id_user - id of the given user.
     * @return Array of objects containing user data.
     */
    public function getFollowers($id_user) {
        $this->prepareToGetFollowers($id_user);
        return $this->db->get()
                        ->result();
    }

    /**
     * Method which gets all users that a given user follows from the database.
     *
     * @param int $id_user - id of the given user.
     * @return Array of objects containing user data.
     */
    public function getFollowing($id_user) {
        return $this->db->from('Follows')
                        ->join('User', 'User.id_user = Follows.id_user_followed')
                        ->where('Follows.id_user_following', $id_user)
                        ->get()
                        ->result();
    }

    /**
     * Method which gets followers gender statistics of a given user
     * from the database.
     *
     * @param int $id_user - id of the given user.
     * statistics should be gotten.
     * @return Array of objects containing followers gender statistic data.
     */
    public function getFollowersGenderStatistics($id_user) {
        $this->prepareToGetFollowers($id_user);
        $this->db   ->select('gender, COUNT(*) as num_followers')
                    ->group_by('gender');

        return $this->db->get()->result();
    }

    /**
     * Method which gets followers age statistics of a given user
     * from the database.
     *
     * @param int $id_user - id of the user whose followers age
     * statistics should be gotten.
     * @return Array of objects containing followers age statistic data.
     */
    public function getFollowersAgeStatistics($id_user) {
        $age_bounds = array(array(18, 25), array(26, 40), array(41, 60),
                            array(61, 80), array(81, 1000));
        $age = array();
        foreach ($age_bounds as $age_bound) {
            $this->prepareToGetFollowers($id_user);
            $condition = "TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()) >=";
            $this->db   ->where($condition, $age_bound[0])
                        ->where($condition, $age_bound[1]);
            array_push($age, $this->db->count_all_results());
        }

        return $age;
    }

    /**
     * Method which adds a new user to the database.
     *
     * @param Array $data - Array which contains all the required data for a
     * user to be added to the database.
     * @return void
     */
    public function addUser($data) {
        $this->db->insert('user', $data);
    }

    /**
     * Checks whether a username does not exists in the database excluding the
     * logged in user's username.
     *
     * @param string $username - Username to check for.
     * @return boolean - TRUE if does not exist, FALSE otherwise.
     */
    public function otherUsernameDoesntExist($username) {
        return $this->db->from('User')
                        ->where('username', $username)
                        ->where("id_user != ", $this->session->userdata['user']->id_user)
                        ->get()
                        ->row() == NULL;
    }

    /**
     * Checks whether an email does not exists in the database excluding the
     * logged in user's email.
     *
     * @param string $email - Email to check for.
     * @return boolean - TRUE if does not exist, FALSE otherwise.
     */
    public function otherEmailDoesntExist($email) {
        return $this->db->from('User')
                        ->where('email', $email)
                        ->where("id_user != ", $this->session->userdata['user']->id_user)
                        ->get()
                        ->row() == NULL;
    }

    /**
     * Updates a given user's data in the database.
     *
     * @param int $id_user - id of the given user.
     * @param Array $data - Array which contains the updated user's data.
     * @return void
     */
    public function updateUser($id_user, $data) {
        $this->db   ->where('id_user', $id_user)
                    ->update('User', $data);
    }

    /**
     * Validates a log in
     *
     * @param string $password - Password to validate.
     * @return boolean - TRUE if the credentials are correct, FALSE otherwise.
     */
    public function logInValidation($password) {
        $username = $this->input->post('username');
        $user = $this->getUserByUsername($username);
        if ($user == NULL || $user->password != $password) {
            return FALSE;
        }
        $this->session->set_userdata('user', $user);
        return TRUE;
    }

}
