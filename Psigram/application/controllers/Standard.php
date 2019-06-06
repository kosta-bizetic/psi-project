<?php
/**
 * @author Luka Dojcilovic 2016/0135
 * @author Kosta Bizetic 2016/0135
 */

require_once APPPATH.'\\core\\User.php';

/**
 * Standard - Controller for the standard user type
 *
 * @version 1.0
 */
class Standard extends User {

    /**
    * Creating a new instance.
    *
    * @return void
     */
    public function __construct() {
        parent::__construct();

        if (! ($this->session->has_userdata('user'))
            || $this->session->userdata['user']->type != 's') {
            redirect();
        }
    }
}
