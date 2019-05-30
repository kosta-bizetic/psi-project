<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GuestController
 *
 * @author LukaDojcilovic
 */
class Guest extends CI_Controller {

    var $data = array();

    public function __construct() {
        parent::__construct();
        if ($this->session->has_userdata('user')) {
            $this->redirectToType($this->session->userdata('user')->type);
        }

        $this->load->model("UserModel");

        $this->data['title'] = 'Psigram';
    }

    public function index() {
        $this->login();
    }

    public function login($message=null) {
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
            if($this->UserModel->
                    getUser($this->input->post('username'))){

                if($this->UserModel->
                        checkPassword($this->input->post('password'))){

                    $this->session->set_userdata
                            ('user',$this->UserModel->user);

                    $this->redirectToType($this->UserModel->user->type);
                } else {
                    $this->login('Incorrect password.<br/>');
                }
            } else {
                $this->login('Incorrect username.<br/>');
            }
        }
    }

    public function registration($message=null) {
        $data['message'] = $message;

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

        if ($this->UserModel->usernameExists($data['username'])) {
            $message .= "Username already exists. <br/>";
        }
        if ($this->UserModel->emailExists($data['email'])) {
            $message .= "Email already exists. <br/>";
        }

        if ($message != "") {
            $this->registration($message);
        } else {
            if ($this->UserModel->addUser($data)) {;
                $this->session->set_userdata
                            ('user',$this->UserModel->user);

                $this->redirectToType($this->UserModel->user->type);
            } else {
                $this->registration("There was an error. Please try again.");
            }
        }
    }

    private function redirectToType($type) {
        switch ($type) {
            case 'a':
                Redirect("Admin");
                break;
            case 'b':
                Redirect("Business");
                break;
            case 'u':
                Redirect("User");
                break;
        }
    }
}
