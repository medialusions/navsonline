<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

    /**
     * Constructor. Gets user data/status.
     */
    public function __construct() {
        parent::__construct();

        //load models
        $this->load->model('blockout_model', 'blockout');
        $this->load->model('event_model', 'event');
        $this->load->model('music_model', 'music');
        $this->load->model('organization_model', 'organization');
        $this->load->model('user_model', 'user');

        //helpers
        $this->load->helper('form');
    }

    /**
     * Redirect upon knowledge of login status
     */
    public function index() {
        $this->schedule();
    }

    /**
     * Log out
     */
    public function logout() {
        $this->authentication->logout();

        // Set redirect protocol
        $redirect_protocol = USE_SSL ? 'https' : NULL;

        redirect(site_url(LOGIN_PAGE . '?logout=1', $redirect_protocol));
    }

    /**
     * Loads login page and handles login actions
     */
    public function login() {
        // Method should not be directly accessible
        if ($this->uri->uri_string() == 'user/login')
            redirect('login');

        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post')
            $this->require_min_level(1);

        $this->setup_login_form();

        $this->load->view('login');
    }

    /**
     * Loads and gets data for schedule page
     */
    public function schedule() {
        $this->require_min_level(1);
        
        $data['title'] = 'Welcome';
        
        $data['auth_user_id'] = $this->auth_user_id;
        $data['auth_level'] = $this->auth_level;

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
