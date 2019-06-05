<?php

/**
 * Description of MUser
 *
 * @author LukaDojcilovic
 */
class MUser extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function getUserByUsername($username) {
        return $this->db->from('User')
                        ->where('username', $username)
                        ->get()
                        ->row();
    }

    public function getUser($id_user) {
        return $this->db->from('User')
                        ->where('id_user', $id_user)
                        ->get()
                        ->row();
    }

    public function getAllUsers() {
        return $this->db->from('User')
                        ->get()
                        ->result();
    }

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

    private function prepareToGetFollowers($id_user) {
        $this->db   ->from('Follows')
                    ->join('User', 'User.id_user = Follows.id_user_following')
                    ->where('Follows.id_user_followed', $id_user);
    }


    public function getFollowers($id_user) {
        $this->prepareToGetFollowers($id_user);
        return $this->db->get()
                        ->result();
    }

    public function getFollowersGenderStatistics($id_user) {
        $this->prepareToGetFollowers($id_user);
        $this->db   ->select('gender, COUNT(*) as num_followers')
                    ->group_by('gender');

        return $this->db->get()->result();
    }

    public function getFollowing($id_user) {
        return $this->db->from('Follows')
                        ->join('User', 'User.id_user = Follows.id_user_followed')
                        ->where('Follows.id_user_following', $id_user)
                        ->get()
                        ->result();
    }



    public function addUser($data) {
        $this->db->insert('user', $data);
    }

    public function otherUsernameDoesntExist($username) {
        return $this->db->from('User')
                        ->where('username', $username)
                        ->where("id_user != ", $this->session->userdata['user']->id_user)
                        ->get()
                        ->row() == NULL;
    }

    public function otherEmailDoesntExist($email) {
        return $this->db->from('User')
                        ->where('email', $email)
                        ->where("id_user != ", $this->session->userdata['user']->id_user)
                        ->get()
                        ->row() == NULL;
    }

    public function updateUser($id_user, $data) {
        $this->db   ->where('id_user', $id_user)
                    ->update('User', $data);
    }

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
