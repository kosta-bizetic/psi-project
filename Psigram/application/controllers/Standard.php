<?php

require_once 'User.php';

/**
 * Description of Basic
 *
 * @author Kosta
 */
class Standard extends User {
    public function __construct() {
        parent::__construct();

        if (! ($this->session->has_userdata('user'))
            || ! ($this->session->userdata['user']->type != 's')) {
            redirect();
        }

        $this->class_name = get_class($this);
    }

}
