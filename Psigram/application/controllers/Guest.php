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
            $this->redirectToType($this->session->userdata('user')->type);
        }

        $this->load->model('MUser');

        $this->data['title'] = 'Psigram';
        $this->class_name = get_class($this);
    }

    public function index() {
        redirect("$this->class_name/login");
    }

    public function logIn($message=null) {
        $this->preparePosttitle(__FUNCTION__);
        $this->data['message'] = $message;

        $this->load->view('guest/login', $this->data);
    }

    public function loginHandler() {
        $this->form_validation->
           set_rules('username', "username", "required");
        $this->form_validation->
           set_rules('password', "password", "required");

        if ($this->form_validation->run() == FALSE){
            $this->index();
        } else {
            $user = $this->MUser->getUserByUsername($this->input->post('username'));

            if($user != null){
                if ($user->password == $this->input->post('password')){
                    $this->session->set_userdata
                            ('user', $user);

                    $this->redirectToType($user->type);
                } else {
                    $this->login('Incorrect password.<br/>');
                }
            } else {
                $this->login('Incorrect username.<br/>');
            }
        }
    }

    public function registration($message=null) {
        $this->preparePosttitle(__FUNCTION__);
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

    private function redirectToType($type) {
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
