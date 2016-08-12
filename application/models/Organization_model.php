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

        $toRet = array();
        $i = 0;
        foreach ($query->result_array() as $user) {
            $toRet[$i] = $user;
            //additional data
            $toRet[$i]['last_scheduling'] = $this->user->last_scheduling($user['user_id']);
            $i++;
        }

        //return the array
        return $toRet;
    }
    
    public function user_search($name, $organization) {
        //generate query
        $this->db->like('first_name', $name, 'after');
        $this->db->or_like('last_name', $name, 'after');
        $this->db->like('organizations', '' . $organization . ',');
        $this->db->limit(8);
        $this->db->from('users');

        //get built query
        $query_string = $this->db->get_compiled_select();

        //execute
        $query = $this->db->query($query_string);
        return $query->result_array();
    }

    public function get($organization_id = '') {
        if ($organization_id == '')
            $organization_id = $this->organization_id;

        //build upcoming query
        $query = $this->db->query(""
                . "SELECT * "
                . "FROM `organization` "
                . "WHERE id >= '$organization_id' "
        );

        //return the array
        foreach ($query->result_array() as $row)
            return $row;
    }

}
