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

}
