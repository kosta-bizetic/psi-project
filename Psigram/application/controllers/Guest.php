<?php

require_once APPPATH.'\\core\\PSIController.php';

/**
 * Description of Guest
 *
 * @author LukaDojcilovic
 */
class Guest extends PSIController {

    public function __construct() {
        parent::__construct();
        if ($this->session->has_userdata('user')) {
            $this->redirectToType();
        }

        $this->load->model('MUser');
    }

    public function index() {
        redirect("$this->class_name/logIn");
    }

    public function logIn() {
        $this->form_validation->set_rules('username', 'Username');
        $this->form_validation->set_rules('password', 'Password', array(array('logInValidation', array($this->MUser, 'logInValidation'))));
        $this->form_validation->set_message('logInValidation', 'Wrong username or password');

        if ($this->form_validation->run() == FALSE){
            $this->load->view('guest/login', $this->data);
        } else {
            $this->redirectToType();
        }
    }

    public function registration($message=null) {
        $this->data['message'] = $message;

        $this->load->view("guest/registration", $this->data);
    }

    public function registrationHandler() {
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

        $message = "";

        if ($this->MUser->usernameExists($data['username'])) {
            $message .= "Username already exists. <br/>";
        }
        if ($this->MUser->emailExists($data['email'])) {
            $message .= "Email already exists. <br/>";
        }

        if ($message != "") {
            $this->registration($message);
        } else {
            $this->MUser->addUser($data);
            $user = $this->MUser->getUserByUsername($data['username']);

            if ($user != null) {
                $this->session->set_userdata('user', $user);
                $this->redirectToType($user->type);
            } else {
                $this->registration("There was an error. Please try again.");
            }
        }
    }

    private function redirectToType() {
        $type = $this->session->userdata('user')->type;
        switch ($type) {
            case 'a':
                redirect('Admin');
                break;
            case 'b':
                redirect('Business');
                break;
            case 's':
                redirect('Standard');
                break;
        }
    }
}
