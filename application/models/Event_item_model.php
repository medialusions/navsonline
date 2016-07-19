<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Event_item_model extends MY_Model {

    public $organization_id;

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();

        $this->organization_id = $this->session->userdata('organization_id');
    }

    public function get($eid) {
        //Ensure organization is set
        $this->organization_id = $this->session->userdata('organization_id');
        //build upcoming query
        $query = $this->db->query(""
                . "SELECT * "
                . "FROM event_item "
                . "WHERE event_id='$eid' ");

        //return the only
        return $query->result_array();
    }

}
