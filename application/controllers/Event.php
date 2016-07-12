<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends MY_Controller {

    /**
     * Constructor. Gets user data/status.
     */
    public function __construct() {
        parent::__construct();

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

        //if post data found
        if ($this->input->post())
            $event_id = $this->event->create();
        else {
            show_404();
            return;
        }

        redirect('event/edit/' . $event_id);
    }

    /**
     * Loads and gets data for schedule page
     */
    public function edit($id) {
        //admin level needed
        $this->require_min_level(9);
        //verify organization id

        //if post data found
        if ($this->input->post())
            $event_id = $this->event->create();
        else {
            show_404();
            return;
        }

        redirect('event/edit/' . $event_id);
    }

}
