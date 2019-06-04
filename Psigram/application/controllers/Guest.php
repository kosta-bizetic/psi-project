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
        $this->form_validation->set_rules('password', 'Password', array(array('logInValidation', array($this->MUser, 'logInValidation'))));
        $this->form_validation->set_message('logInValidation', 'Wrong username or password');

        if ($this->form_validation->run() == TRUE) {
            $this->redirectToType();
        } else {
            $this->load->view('guest/login', $this->data);
        }
    }

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
        $this->form_validation->set_rules('type', 'Account', 'required|in_list[s,b]');

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

    private function redirectToType() {
        switch ($this->session->userdata('user')->type) {
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
