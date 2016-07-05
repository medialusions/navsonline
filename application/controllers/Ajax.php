<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends MY_Controller {

    /**
     * Constructor. Gets user data/status.
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * API for updating event confirmation
     * @param int $eid
     * @param int $uid
     * @param json $value
     */
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

    /**
     * @TODO create blockout
     * @TODO delete blockout
     */
    public function blockout_add() {
        //get and format date
        $date_begin = verify_date(stripslashes($this->input->get('db')));
        $date_end = verify_date(stripslashes($this->input->get('de')));

        //get other vars
        $reason = $this->input->get('reason');
        $uid = $this->input->get('uid');
        
        //send it to the model
        $result = $this->user->add_blockout($date_begin, $date_end, $reason, $uid);
        echo json_encode($result);
    }

    public function blockout_delete($uid, $date_begin, $date_end) {
        
    }

}
