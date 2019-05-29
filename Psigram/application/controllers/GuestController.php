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
class GuestController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("UserModel");
    }
    
    public function index($message=null) {
        $this->load->view("loginPage.php", ['message' => $message]);
    }
    
    public function login() {
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
                            ('autor',$this->UserModel->user);
                    
                    switch ($this->UserModel->user->type) {
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
                } else {
                    $this->index('Incorrect password.');
                }
            } else {
                $this->index('Incorrect username.');
            }
        }
    }
    
}
