<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Organization_model extends MY_Model {

    public $organization_id;

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();

        $this->organization_id = $this->session->userdata('organization_id');
    }

    public function list_users($min_auth_level = 1, $organization_id = '') {
        if ($organization_id == '')
            $organization_id = $this->organization_id;
        
        //build upcoming query
        $query = $this->db->query(""
                . "SELECT * "
                . "FROM `users` "
                . "WHERE organizations LIKE '%$organization_id,%' "
                . "AND auth_level >= '$min_auth_level' "
                . "ORDER BY last_name ASC"
        );

        //return the array
        return $query->result_array();
    }

}
