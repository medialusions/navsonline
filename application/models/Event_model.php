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

        $user_id = config_item('auth_user_id');

        //init setup of users and roles matrix
        $users = array($user_id => array('confirmed' => true));
        $roles = array($user_id => array('event-manager'));

        //setting up insert
        $data = array(
            'name' => $event_name,
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

    /**
     * Returns next dates. Change limit with param
     */
    public function generate_upcoming($user_id = '', $limit = 4, $page = 1) {
        //Ensure organization is set
        $this->organization_id = $this->session->userdata('organization_id');
        if ($limit == -1) {
            $limit_q = "LIMIT " . (($page - 1) * 10) . ", 10";
        } else {
            $limit_q = ($limit > 0 ? "LIMIT $limit" : '');
        }
        //build upcoming query
        $query = $this->db->query(""
                . "SELECT * "
                . "FROM event "
                . "WHERE organization='$this->organization_id' "
                . ($user_id == '' ? '' : "AND  users_matrix LIKE '%$user_id%' ")
                . "AND date > " . time() . " "
                . "ORDER BY date ASC "
                . $limit_q);

        //return the array
        return $query->result_array();
    }

    /**
     * Returns the pagination array
     * @param int $page Page number
     */
    public function get_pagination($page) {
        //Ensure organization is set
        $this->organization_id = $this->session->userdata('organization_id');
        //build upcoming query
        $query = $this->db->query(""
                . "SELECT * "
                . "FROM event "
                . "WHERE organization='$this->organization_id' ");
        $num_rows = $query->num_rows();

        return pagination($num_rows, $page);
    }

    /**
     * Updates confirmation of user with event. 
     * 
     * @param int $eid
     * @param int $uid
     * @param bool $value
     * @return array Result of update. 
     */
    public function confirm($eid, $uid, $value) {//build single event query
        $query = $this->db->query(""
                . "SELECT users_matrix FROM event "
                . "WHERE id='$eid' ");

        //grab the first/only one in $result
        foreach ($query->result_array() as $result)
            break;

        //json decode as associative array
        $users_matrix = json_decode($result['users_matrix'], TRUE);

        if (array_key_exists($uid, $users_matrix) === false)
            return array('success' => FALSE, 'reason' => 'Unauthorized. User not scheduled for this event.');

        //set new status
        $users_matrix[$uid]['confirmed'] = (bool) $value;

        $this->db->set('users_matrix', json_encode($users_matrix));
        $this->db->where('id', $eid);
        $response = $this->db->update('event');

        if (!$response)
            return array('success' => FALSE, 'reason' => 'Database query error.');
        else
            return array('success' => TRUE);
    }

    /**
     * Removes event if organization matches that of that event
     * @param int $eid
     * @param int $organization
     * @return array Response
     */
    public function delete($eid, $organization = '') {
        //get session organization if unset
        if ($organization == '')
            $organization = $this->session->userdata('organization_id');
        //verify organization first
        $query = $this->db->query(""
                . "SELECT organization FROM event "
                . "WHERE id='$eid' ");
        //grab the first/only one in $result
        foreach ($query->result_array() as $result)
            break;
        $organization_db = $result['organization'];
        if ($organization_db != $organization)
            return array('success' => FALSE, 'reason' => 'Unauthorized. User has no control of this organization.');
        //passed organization verification
        //delete the row
        $response = $this->db->delete('event', array('id' => $eid));
        if (!$response)
            return array('success' => FALSE, 'reason' => 'Database query error.');
        else
            return array('success' => TRUE);
    }

}
