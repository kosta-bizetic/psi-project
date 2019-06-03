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


}
