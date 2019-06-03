<?php

require_once APPPATH.'\\core\\User.php';

/**
 * Description of Admin
 *
 * @author Kosta
 */
class Admin extends User {
    public function __construct() {
        parent::__construct();

        if (! ($this->session->has_userdata('user'))
            || $this->session->userdata['user']->type != 'a') {
            redirect();
        }
    }

    public function deleteCommentHandler($id_comment) {
        $this->MComment->removeComment($id_comment);
        $this->redirectToLastURI();
    }

    public function deletePostHandler($id_post) {
        $this->MPost->removePost($id_post);
        $this->redirectToLastURI();
    }
}
