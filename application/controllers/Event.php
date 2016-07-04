<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends MY_Controller {

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
     * Loads and gets data for schedule page
     */
    public function add() {
        //admin level needed
        $this->require_min_level(9);
        
        $data['title'] = 'New Event';

        $data['user'] = $this->user->generate_user_data($this->auth_user_id);

        $this->load->view('event/add', $data);
    }

}
