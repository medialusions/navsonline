<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends MY_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Generates data from db.
     * 
     * @param varchar $user_id
     * @return db_resource
     */
    public function generate_user_data($user_id = '') {
        if ($user_id == '')
            $user_id = config_item('auth_user_id');

        $query = $this->db->get_where('users', array('user_id' => $user_id), 1);

        //return the first
        foreach ($query->result_array() as $row)
            return $row;
    }

    /**
     * Generates the sidebar data for the left side
     */
    public function generate_sidebar_data() {
        $data['upcoming_events'] = $this->event->generate_upcoming(config_item('auth_user_id'));
        $data['contact'] = $this->organization->list_users(9);
        //clean up the old blockouts before returning the new
        $data['blockout_dates'] = $this->clean_blockouts(TRUE);

        return $data;
    }

    /**
     * Get blockouts from current user acct
     * @return array of blockouts
     */
    public function get_blockouts($user_id = '') {
        if ($user_id == '')
            $user_id = config_item('auth_user_id');

        //build upcoming query
        $query = $this->db->query(""
                . "SELECT blockouts "
                . "FROM `users` "
                . "WHERE user_id = '$user_id' "
                . "LIMIT 1"
        );

        //get the first
        foreach ($query->result_array() as $blockouts)
            break;

        //return the array
        return json_decode($blockouts['blockouts'], TRUE);
    }

    /**
     * Removes old blockout dates.
     * @return void
     */
    public function clean_blockouts($return = FALSE) {
        //get the blockouts
        $blockouts = $this->get_blockouts();

        $curr_time = time();

        $cleaned = array();
        foreach ($blockouts as $blockout) {
            if ($blockout["date_end"] > $curr_time) {
                array_push($cleaned, $blockout);
            }
        }

        $this->update_blockout($cleaned);

        if ($return)
            return $cleaned;
    }

    /**
     * Updates confirmation of user with event. 
     * 
     * @param int $eid
     * @param int $uid
     * @param bool $value
     * @return array Result of update. 
     */
    public function add_blockout($date_begin, $date_end, $reason, $uid) {//build single event query
        $query = $this->db->query(""
                . "SELECT blockouts FROM users "
                . "WHERE user_id='$uid' ");

        //grab the first/only one in $result
        foreach ($query->result_array() as $result)
            break;

        //json decode as associative array
        if ($result['blockouts'] != '')
            $blockouts = json_decode($result['blockouts'], TRUE);
        else
            $blockouts = array();

        //set new status
        $new = array('start_date' => $date_begin . '', 'date_end' => $date_end . '', 'reason' => $reason);

        //push new onto the end
        array_push($blockouts, $new);

        //update the blockouts
        $response = $this->update_blockout($blockouts, FALSE, $uid);

        if (!$response)
            return array('success' => FALSE, 'reason' => 'Database query error.');
        else
            return array('success' => TRUE);
    }

    /**
     * 
     * @param type $data
     * @param type $json_encoded
     * @param type $uid
     * @return bool Result
     */
    public function update_blockout($data, $json_encoded = FALSE, $uid = '') {
        $this->db->set('blockouts', ($json_encoded ? $data : json_encode($data)));
        $this->db->where('user_id', ($uid == '' ? config_item('auth_user_id') : $uid));
        if (!$this->db->update('users'))
            return FALSE;
        else
            return TRUE;
    }

}
