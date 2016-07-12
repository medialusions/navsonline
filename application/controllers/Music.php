<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Music extends MY_Controller {

    /**
     * Constructor. Gets user data/status.
     */
    public function __construct() {
        parent::__construct();

        //pre load
        $this->require_min_level(1);
    }

    /**
     * Loads and gets data for music page
     */
    public function add_song() {
        //admin level needed
        $this->require_min_level(9);

        //if post data found
        if ($this->input->post())
            $event_id = $this->song->create();
        else {
            show_404();
            return;
        }

        redirect('music/edit/' . $event_id);
    }

    /**
     * Loads and gets data for schedule page
     */
    public function edit($id) {
        //admin level needed
        $this->require_min_level(9);
    }

    /**
     * Loads and gets data for music page
     */
    public function view($id) {
        $data['song'] = $this->song->get($id);

        $data['title'] = $data['song']['title'];

        $this->load->view('music/view', $data);
    }

}
