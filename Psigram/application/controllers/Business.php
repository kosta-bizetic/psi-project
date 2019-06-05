<?php

require_once APPPATH.'\\core\\User.php';

/**
 * Description of Business
 *
 * @author Kosta
 */
class Business extends User {

    public function __construct() {
        parent::__construct();

        if (! ($this->session->has_userdata('user'))
            || $this->session->userdata['user']->type != 'b') {
            redirect();
        }
    }

    private function getGenderStatistics() {
        $gender_translation = $this->config->item('gender_translation');

        $genders = array();
        foreach ($gender_translation as $translation) {
            $genders[$translation] = 0;
        }

        $results = $this->MUser->getFollowersGenderStatistics($this->user->id_user);
        foreach ($results as $result) {
            $genders[$gender_translation[$result->gender]] += $result->num_followers;
        }

        return $genders;
    }


    public function statistics() {
        $this->data['user'] = $this->user;
        $this->data['follows'] = false;

        $this->data['genders'] = $this->getGenderStatistics();
        $this->data['age'] = $this->MUser->getFollowersAgeStatistics($this->user->id_user);

        $this->load->view('user/business/statistics.php', $this->data);
    }

    public function sponsorHandler($id_post) {
        $post = $this->MPost->getPost($id_post);
        if ($post->id_user == $this->user->id_user) {
            $this->MPost->setSponsored($id_post, $post->sponsored ? 0 : 1);
            $this->redirectToLastURI();
        } else {
            redirect();
        }
    }
}
