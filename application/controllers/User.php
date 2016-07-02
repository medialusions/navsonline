<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function index() {
        $this->login();
    }
    
    public function login() {
        $this->load->view('login_static');
    }

    public function landing() {
        $this->load->view('landing_static');
    }

}
