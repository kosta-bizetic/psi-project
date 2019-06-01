<?php

require_once 'User.php';

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

        $this->class_name = get_class($this);
    }
}
