<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends MY_Model {

    public $title;
    public $content;
    public $date;

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

    public function generate_rail_data() {
        $data['upcoming_events'] = $this->event->generate_upcoming(config_item('auth_user_id'));
        $data['contact'] = $this->organization->list_users(9);

        return $data;
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

        $this->db->set('blockouts', json_encode($blockouts));
        $this->db->where('user_id', $uid);
        $response = $this->db->update('users');

        if (!$response)
            return array('success' => FALSE, 'reason' => 'Database query error.');
        else
            return array('success' => TRUE);
    }

}
