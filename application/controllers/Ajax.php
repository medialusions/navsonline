<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends MY_Controller {

    /**
     * Constructor. Gets user data/status.
     */
    public function __construct() {
        parent::__construct();
    }

    public function event_confirm($eid, $uid, $value = TRUE) {
        //call the model function
        $response = $this->event->confirm($eid, $uid, $value);
        echo json_encode($response);
    }

    /**
     * See event_confirm($eid, $uid, FALSE)
     */
    public function event_deny($eid, $uid) {
        $this->event_confirm($eid, $uid, FALSE);
    }

}
