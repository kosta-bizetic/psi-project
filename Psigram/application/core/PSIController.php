<?php

/**
 * Description of PSIController
 *
 * @author Kosta
 */
class PSIController extends CI_Controller {
    var $data = array();
    var $class_name;

    public function __construct() {
        parent::__construct();
    }

    protected function preparePosttitle($function) {
        return $this->data['posttitle'] = implode(' ', preg_split('/(?=[A-Z])/', ucfirst($function)));
    }
}
