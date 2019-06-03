<?php

require_once APPPATH.'\\core\\User.php';

/**
 * Description of Standard
 *
 * @author Kosta
 */
class Standard extends User {
    public function __construct() {
        parent::__construct();

        if (! ($this->session->has_userdata('user'))
            || $this->session->userdata['user']->type != 's') {
            redirect();
        }
    }
}
