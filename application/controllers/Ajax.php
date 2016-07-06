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
     * @param bool $value
     * @return void
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
     * Uses get vars
     * ?db={db}&de={de}&reason={reason}&uid={uid}
     * @return void
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

    /**
     * Deletes the selected blockout date and echos response
     * @param text $uid
     * @param unix $date_begin
     * @param unix $date_end
     * @return void
     */
    public function blockout_delete($uid, $date_begin, $date_end) {
        //get all
        $blockouts = $this->user->get_blockouts($uid);

        //remove single blockout
        $clean = array();
        foreach ($blockouts as $blockout) {
            if ($blockout['start_date'] != $date_begin && $blockout['date_end'] != $date_end) {
                array_push($clean, $blockout);
            }
        }

        //update it
        $response = $this->user->update_blockout($clean, FALSE, $uid);

        //response
        if (!$response)
            echo json_encode(array('success' => FALSE, 'reason' => 'Database query error.'));
        else
            echo json_encode(array('success' => TRUE));
    }

}
