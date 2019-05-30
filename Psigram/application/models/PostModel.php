<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PostModel
 *
 * @author LukaDojcilovic
 */
class PostModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getAllPosts() {
        return $this->db->get('post')->result();
    }

}
