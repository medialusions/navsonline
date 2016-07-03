<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function index() {
        $this->login();
    }

    public function login() {
        $data;
        $this->load->view('login_static', $data);
    }

    public function schedule() {
        $data['title'] = 'Welcome';

        $this->load->view('landing_static', $data);
    }

    public function music() {
        $data['title'] = 'Song Center';

        $this->load->view('music_static', $data);
    }

    public function people() {
        $data['title'] = 'People';

        $this->load->view('people_static', $data);
    }

}
