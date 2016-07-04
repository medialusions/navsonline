<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

    /**
     * Constructor. Gets user data/status.
     */
    public function __construct() {
        parent::__construct();

        //load models
        $this->load->model('blockout_model', 'blockout', TRUE);
        $this->load->model('event_model', 'event', TRUE);
        $this->load->model('music_model', 'music', TRUE);
        $this->load->model('organization_model', 'organization', TRUE);
        $this->load->model('user_model', 'user', TRUE);

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

        if ($this->authentication->current_hold_status()) {
            $this->load->view('errors/auth/user_banned');
            return;
        }

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

        $data['user'] = $this->user->generate_user_data($this->auth_user_id);

        $this->load->view('schedule', $data);
    }

    /**
     * Loads and gets data for schedule page
     */
    public function music() {
        $this->require_min_level(1);

        $data['title'] = 'Welcome';

        $data['user'] = $this->user->generate_user_data($this->auth_user_id);

        $this->load->view('music_static', $data);
    }

    /**
     * Gets data for the left rail
     */
    public function get_rail() {
        
    }

}
