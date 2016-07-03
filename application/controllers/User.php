<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function index() {
        $this->login();
    }
    
    public function login() {
        $this->load->view('login_static');
    }

    public function schedule() {
        $this->load->view('landing_static');
    }

    public function music() {
        $this->load->view('music_static');
    }

    public function people() {
        $this->load->view('people_static');
    }

}
