<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Organization_model extends MY_Model {

  public $organization_id;

  public function __construct() {
    // Call the CI_Model constructor
    parent::__construct();

    $this->organization_id = $this->session->userdata('organization_id');
  }

  public function list_users($min_auth_level = 1, $organization_id = '', $show_archived = true) {
    if ($organization_id == '') {
      $organization_id = $this->organization_id;
    }

    if ($min_auth_level <= 2 && !$show_archived) {
      $min_auth_level = 3;
    }

    //build upcoming query
    $query = $this->db->query(""
    . "SELECT * "
    . "FROM `users` "
    . "WHERE organizations LIKE '%$organization_id,%' "
    . "AND auth_level >= '$min_auth_level' "
    . "ORDER BY last_name ASC" );

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

  public function user_search($name, $organization, $restriction = "") {
    //restrictions
    $restricted = FALSE;
    if ($restriction != "") {
      $restricted = TRUE;
      $eid = $restriction;
      $event = $this->event->get($eid);
      $users_matrix = json_decode($event['users_matrix'], TRUE);
      $date = $event['date'];
    }

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
    $result = $query->result_array();
    if ($restricted) {
      //remove users who have a blockout or are already scheduled
      $updated = array();
      foreach ($result as $user) {
        $okay_for_scheduling = TRUE;
        $blockouts = json_decode($user['blockouts'], TRUE);
        foreach ($blockouts as $blockout) //sift through the blockouts
        if ($date <= $blockout['date_end'] && $date >= $blockout['start_date'])
        $okay_for_scheduling = FALSE; //remove user potential
        if (key_exists($user['user_id'], $users_matrix))
        $okay_for_scheduling = FALSE; //remove user potential
        if ($okay_for_scheduling) //only add if it passed
        array_push($updated, $user);
      }
      return $updated;
    } else {
      return $result;
    }
  }

  public function get($organization_id = '') {
    if ($organization_id == '')
    $organization_id = $this->organization_id;

    //build upcoming query
    $query = $this->db->query(""
    . "SELECT * "
    . "FROM `organization` "
    . "WHERE id >= '$organization_id' " );

    //return the array
    foreach ($query->result_array() as $row)
    return $row;
  }  
}
