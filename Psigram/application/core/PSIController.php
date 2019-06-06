<?php
/**
 * @author Luka Dojcilovic 2016/0135
 * @author Kosta Bizetic 2016/0121
 */

class PSIController extends CI_Controller {
    var $data = array();
    var $class_name;

    /**
    * Creating a new instance.
    *
    * @return void
     */
    public function __construct() {
        parent::__construct();

        $this->form_validation->set_error_delimiters('<font color="red">', '</font>');
    }

    /**
     * Method which remaps controller function calls.
     *
     * @param string $method - Original name of the called method.
     * @param type $params - Original parameters of the called method.
     * @return void
     */
    public function _remap($method, $params = array())
    {
        return $this->data['posttitle'] = implode(' ', preg_split('/(?=[A-Z])/', ucfirst($method)));
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

    /**
     * Redirects the user to the uri before the last request.
     *
     * @return void
     */
    protected function redirectToLastURI() {
        redirect($this->session->userdata['old_uri']);
    }

    /**
     * Redirects user to the correct controller based on his user type.
     *
     * @param type $method - Name of the method to redirect the user to.
     * @return void
     */
    protected function redirectToType($method='feed') {
        switch ($this->session->userdata('user')->type) {
            case 'a': redirect("Admin/$method");
            case 'b': redirect("Business/$method");
            case 's': redirect("Standard/$method");
        }
    }
}
