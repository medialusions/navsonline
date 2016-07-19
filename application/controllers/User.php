<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

    /**
     * Constructor. Gets user data/status.
     */
    public function __construct() {
        parent::__construct();

        //helpers
        $this->load->helper('form');

        //pre load
        $auth_array = array('', 'user/schedule', 'user/people', 'user/preferences');
        if (array_search($this->uri->uri_string(), $auth_array) !== FALSE) {
            $this->require_min_level(1);
        }
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
    public function schedule($page = 1) {
        $data['title'] = 'Welcome';

        $data['user'] = $this->user->generate_user_data($this->auth_user_id);
        $this->session->set_userdata('organization_id', extract_organization($data['user']['organizations']), 0);

        $data['upcoming_events'] = $this->event->generate_upcoming($this->auth_user_id, -1);
        $data['pagination'] = $this->event->get_pagination($page);
        $data['pagination']['current'] = $page;

        $data['sidebar'] = $this->user->generate_sidebar_data($this->auth_user_id);

        $this->load->view('schedule', $data);
    }

    /**
     * Loads and gets data for music page
     */
    public function music($page = 1) {
        $this->require_min_level(1);
        $data['title'] = 'Music Center';

        $data['user'] = $this->user->generate_user_data($this->auth_user_id);
        $this->session->set_userdata('organization_id', extract_organization($data['user']['organizations']), 0);
        $data['sidebar'] = $this->user->generate_sidebar_data($this->auth_user_id);

        $data['songs'] = $this->music->get($page);
        $data['pagination'] = $this->music->get_pagination($page);
        $data['pagination']['current'] = $page;

        $this->load->view('music', $data);
    }

}
