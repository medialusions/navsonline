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

        redirect('event/view/' . $event_id);
    }

    public function add_item() {
        //admin level needed
        $this->require_min_level(9);

        $this->event_item->add();
        
        redirect('event/view/' . $this->input->post('event_id'));
    }

    /**
     * Loads and gets data for event page
     */
    public function view($id) {
        //user login needed
        $this->require_min_level(1);
        //get event data
        $data['event'] = $this->event->get($id);
        //get event items
        $data['items'] = $this->event_item->get($id);

        //setup view
        $data['title'] = $data['event']['name'];
        $this->load->view('event/view', $data);
    }

}
