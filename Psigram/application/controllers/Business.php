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
