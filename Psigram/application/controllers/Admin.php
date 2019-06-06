<?php
/**
 * @author Luka Dojcilovic 2016/0135
 * @author Kosta Bizetic 2016/0121
 */

require_once APPPATH.'\\core\\User.php';

/**
 * Admin - Controller for the admin user type.
 *
 * @version 1.0
 */
class Admin extends User {

    /**
    * Creating a new instance.
    *
    * @return void
     */
    public function __construct() {
        parent::__construct();

        if (! ($this->session->has_userdata('user'))
            || $this->session->userdata['user']->type != 'a') {
            redirect();
        }
    }

    /**
     * Method that handles the deletion of any given comment.
     *
     * @param int $id_comment - ID of the comment to be deleted.
     *
     * @return void
     */
    public function deleteCommentHandler($id_comment) {
        $this->MComment->removeComment($id_comment);
        $this->redirectToLastURI();
    }

    /**
     * Method that handles the deletion of any given post.
     *
     * @param int $id_post - ID of the post to be deleted.
     *
     * @return void
     */
    public function deletePostHandler($id_post) {
        $this->MPost->removePost($id_post);
        $this->redirectToLastURI();
    }
}
