<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Event_model extends MY_Model {

    public $organization_id;

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();

        $this->organization_id = $this->session->userdata('organization_id');
    }

    /**
     * Must have name and date/time in post data
     */
    public function create() {
        $event_name = $this->input->post('event_name', TRUE);
        $event_date = $this->input->post('event_date', TRUE);
        $event_time = $this->input->post('event_time', TRUE);

        $timestamp = verify_date_time($event_date, $event_time);

        //clean $vars
        $event_name_clean = $this->db->escape($event_name);
        $user_id = config_item('auth_user_id');

        //init setup of users and roles matrix
        $users = array($user_id => array('confirmed' => true));
        $roles = array($user_id => array('event-manager'));

        //setting up insert
        $data = array(
            'name' => $event_name_clean,
            'organization' => $this->organization_id,
            'date' => $timestamp,
            'date_created' => time(),
            'created_by' => $user_id,
            'users_matrix' => json_encode($users),
            'roles_matrix' => json_encode($roles)
        );

        $this->db->insert('event', $data);

        return $this->db->insert_id();
    }

    public function generate_upcoming() {
        //build upcoming query
        $query = $this->db->query(""
                . "SELECT * FROM event "
                . "WHERE organization='$this->organization_id' "
                . "AND date > " . time() . " "
                . "ORDER BY date ASC "
                . "LIMIT 4");

        //return the array
        return $query->result_array();
    }

}
