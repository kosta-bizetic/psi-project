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

        $this->form_validation->set_error_delimiters('<font color="red">', '</font>');
    }

    public function _remap($method, $params = array())
    {
        $this->preparePosttitle($method);
        $this->data['title'] = 'Psigram';
        $this->class_name = get_class($this);

        if ( ! $this->session->has_userdata('curr_uri')) {
            $this->session->userdata['curr_uri'] = '';
        }
        $this->session->userdata['old_uri'] = $this->session->userdata['curr_uri'];
        $this->session->userdata['curr_uri'] = $this->uri->uri_string();

        if (method_exists($this, $method))
        {
                return call_user_func_array(array($this, $method), $params);
        }
        show_404();
    }

    protected function redirectToLastURI() {
        redirect($this->session->userdata['old_uri']);
    }

    protected function preparePosttitle($function) {
        return $this->data['posttitle'] = implode(' ', preg_split('/(?=[A-Z])/', ucfirst($function)));
    }
}
