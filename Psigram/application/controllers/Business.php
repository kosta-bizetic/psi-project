<?php
/**
 * @author Luka Dojcilovic 2016/0135
 * @author Kosta Bizetic 2016/0135
 */


require_once APPPATH.'\\core\\User.php';

/**
 * Business - Controller for the business user type
 *
 * @version 1.0
 */
class Business extends User {

    /**
    * Creating a new instance.
    *
    * @return void
     */
    public function __construct() {
        parent::__construct();

        if (! ($this->session->has_userdata('user'))
            || $this->session->userdata['user']->type != 'b') {
            redirect();
        }
    }

    /**
     * Method that returns the users follower distribution by gender.
     *
     * @return Array() - Number of followers per gender.
     */
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

    /**
     * Method that loads the statics view.
     *
     * @return void
     */
    public function statistics() {
        $this->data['user'] = $this->user;
        $this->data['follows'] = false;

        $this->data['genders'] = $this->getGenderStatistics();
        $this->data['age'] = $this->MUser->getFollowersAgeStatistics($this->user->id_user);

        $this->load->view('user/business/statistics.php', $this->data);
    }

    /**
     * Method that handles promoting/unpromoting posts.
     *
     * @param $id_post ID of post to be promoted/unpromoted.
     *
     * @return void
     */
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
