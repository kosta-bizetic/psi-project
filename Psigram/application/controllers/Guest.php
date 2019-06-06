<?php
/**
 * @author Luka Dojcilovic 2016/0135
 * @author Kosta Bizetic 2016/0135
 */

require_once APPPATH.'\\core\\PSIController.php';

/**
* Guest – Controller for users not logged in to the system.
*
* @version 1.0
*/
class Guest extends PSIController {

    /**
    * Creating a new instance.
    *
    * @return void
     */

    public function __construct() {
        parent::__construct();
        if ($this->session->has_userdata('user')) {
            $this->redirectToType();
        }

        $this->load->model('MUser');
    }

    /**
     * Default method for calls to this controller.
     *
     * @return void
     */
    public function index() {
        redirect("$this->class_name/logIn");
    }

    /**
     * Method that loads the log in view and handles the log in procedure.
     *
     * @return void
     */
    public function logIn() {
        $this->form_validation->set_rules('username', 'Username');
        $this->form_validation->set_rules('password', 'Password', array(array('logInValidation', array($this->MUser, 'logInValidation'))));
        $this->form_validation->set_message('logInValidation', 'Wrong username or password');

        if ($this->form_validation->run() == TRUE) {
            $this->redirectToType();
        } else {
            $this->load->view('guest/login', $this->data);
        }
    }

    /**
     * Method that loads the registration view and handles the registration procedure.
     *
     * @return void.
     */
    public function registration() {
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[User.username]');
        $this->form_validation->set_message('is_unique', '{field} already exists');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('confirm-password', 'Confirm Password', 'required|matches[password]');
        $this->form_validation->set_rules('name', 'Name', 'required|alpha_numeric_spaces');
        $this->form_validation->set_rules('surname', 'Last name', 'required|alpha_numeric_spaces');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[User.email]');
        $this->form_validation->set_rules('date_of_birth', 'Date of birth', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required|in_list[m,f]');
        $this->form_validation->set_rules('type', 'Account type', 'required|in_list[s,b]');

        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'name' => $this->input->post('name'),
                'surname' => $this->input->post('surname'),
                'email' => $this->input->post('email'),
                'date_of_birth' => $this->input->post('date_of_birth'),
                'gender' => $this->input->post('gender'),
                'type' => $this->input->post('type')
            );
            $this->MUser->addUser($data);
            $user = $this->MUser->getUserByUsername($data['username']);

            $this->session->set_userdata('user', $user);

            $this->redirectToType();
        } else {
            $this->load->view("guest/registration", $this->data);
        }
    }
}
