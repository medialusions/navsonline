<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    /**
     * Redirect upon knowledge of login status
     */
    public function index() {
        $this->login();
    }

    /**
     * Loads login page and handles login actions
     */
    public function login() {
        $data;
        $this->load->view('login_static', $data);
    }

    /**
     * Loads and gets data for schedule page
     */
    public function schedule() {
        $data['title'] = 'Welcome';

        $this->load->view('landing_static', $data);
    }

    /**
     * Loads and gets data for music page
     */
    public function music() {
        $data['title'] = 'Song Center';

        $this->load->view('music_static', $data);
    }

    /**
     * Loads and gets data for people page
     */
    public function people() {
        $data['title'] = 'People';

        $this->load->view('people_static', $data);
    }

    /**
     * Gets data for the left rail
     */
    public function get_rail() {
        
    }

}
