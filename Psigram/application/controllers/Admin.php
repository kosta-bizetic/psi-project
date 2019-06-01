<?php

require_once 'User.php';

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

        $this->class_name = get_class($this);
    }
}
