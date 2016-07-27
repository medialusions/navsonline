<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

    /**
     * Constructor. Gets user data/status.
     */
    public function __construct() {
        parent::__construct();
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
            $this->require_min_level(3);

        $this->setup_login_form();

        $this->load->view('login');
    }

    /**
     * Loads and gets data for schedule page
     */
    public function schedule($page = 1) {
        $this->require_min_level(3);
        $data['title'] = 'Welcome';

        $data['user'] = $this->user->generate_user_data($this->auth_user_id);

        $data['upcoming_events'] = $this->event->generate_upcoming($this->auth_user_id, 10, $page, ($this->auth_level >= 9 || $this->input->get('v') == 'all'));
        $data['pagination'] = $this->event->get_pagination($page);
        $data['pagination']['current'] = $page;

        $data['sidebar'] = $this->user->generate_sidebar_data($this->auth_user_id);

        $this->load->view('schedule', $data);
    }

    /**
     * Loads and gets data for music page
     */
    public function music($page = 1) {
        $this->require_min_level(3);
        $data['title'] = 'Music Center';

        $data['user'] = $this->user->generate_user_data($this->auth_user_id);
        $data['sidebar'] = $this->user->generate_sidebar_data($this->auth_user_id);

        $data['songs'] = $this->music->get($page);
        $data['pagination'] = $this->music->get_pagination($page);
        $data['pagination']['current'] = $page;

        $this->load->view('music', $data);
    }

    /**
     * Loads and gets data for music page
     */
    public function people() {
        if ($this->input->post()) {
            //admin needed to add
            $this->require_min_level(9);
            if ($this->user->create()) {
                //bring it back
                redirect('user/people');
            } else {
                show_error("Please try again.", 400, "Error Creating User");
            }
        } else {
            $this->require_min_level(3);
            $data['title'] = 'People Center';

            $data['user'] = $this->user->generate_user_data($this->auth_user_id);
            $data['sidebar'] = $this->user->generate_sidebar_data($this->auth_user_id);

            $data['users'] = $this->user->get();
            $data['pagination'] = array();

            $this->load->view('people', $data);
        }
    }

    /**
     * welcome page for creating new account. User is not required to login
     */
    public function welcome() {
        $r = $this->input->get('r');
        $u = $this->input->get('u');

        //missing something or hack
        if (is_null($u) || is_null($r))
            show_error("You're missing a few things.", 400, "Error Creating Account");

        $u_rec = $this->user->get_recovery_verification_data($u);
        //Returns false if not found or recovery date is before now
        if (!$u_rec || !is_null($u_rec->username))
            show_error("This user is already created.", 401, "Error Creating Account");

        $r_dec = myurldecode($r);
        //recovery code doesn't match the one stored
        if ($r_dec != $u_rec->passwd_recovery_code)
            show_error("Something isn't right. Request a new link from your account manager.", 401, "Error Creating Account");

        $data = array();
        if ($this->input->post()) {
            if ($this->input->post('password') == '' || $this->input->post('strength') < 3) {
                $data['errors'] = "Password is not strong enough";
                GOTO load_view;
            }
            $change_passwd_response = $this->user->change_password($this->input->post('password'), $this->input->post('password_2'), $u, $r_dec);
            if ($change_passwd_response) {
                $change_username_response = $this->user->change_username($this->input->post('username'), $u);
                if ($change_username_response) {
                    //login and redirect
                    $auth_model = $this->authentication->auth_model;
                    // Get normal authentication data using email address
                    if ($auth_data = $this->{$auth_model}->get_auth_data($u_rec->email)) {
                        //set to redirect
                        $this->authentication->redirect_after_login();
                        // Set auth related session / cookies
                        $this->authentication->maintain_state($auth_data);
                    }
                } else {
                    $data['errors'] = $response['message'];
                }
            } else {
                $data['errors'] = $response['message'];
            }
        }
        load_view:
        $this->load->view('user/welcome', $data);
    }

}
