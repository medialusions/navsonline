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
                . "WHERE event_id='$eid' "
                . "ORDER BY start_time");

        //return the only
        return $query->result_array();
    }

    /**
     * @param type $data [optional] post data
     * @return boolean on result
     */
    public function add($data = '') {
        if ($data == '')
            $data = $this->input->post();
        if ($data['type'] == 'song') {
            $arrangement = json_decode($data['arrangement_search'], TRUE);
            $arrangement_data = $this->arrangement->get($arrangement['id']);
            $song = $this->song->get($arrangement_data['song']);
        }

        //setting up insert
        $data = array(
            'event_id' => $data['event_id'],
            'type' => $data['type'],
            'title' => ($data['type'] == 'song' ? $song['title'] . ' - ' . $arrangement_data['artist'] . '' : $data['title']),
            'arrangement_id' => ($data['type'] == 'song' ? $arrangement_data['id'] : ''),
            'arrangement_key' => ($data['type'] == 'song' ? $data['a_search_key'] : ''),
            'memo' => $data['memo'],
            'start_time' => verify_date_time($data['event_time']),
            'date_created' => time(),
            'created_by' => config_item('auth_user_id')
        );

        return $this->db->insert('event_item', $data);
    }

    /**
     * @param type $data [optional] post data
     * @return boolean On result
     */
    public function edit($data = '') {
        if ($data == '')
            $data = $this->input->post();

        if ($data['type'] == 'song') {
            $arrangement = json_decode($data['arrangement_search'], TRUE);
            $arrangement_data = $this->arrangement->get($arrangement['id']);
            $song = $this->song->get($arrangement_data['song']);
        }

        //setting up insert
        $data = array(
            'type' => $data['type'],
            'title' => ($data['type'] == 'song' ? $song['title'] . ' - ' . $arrangement_data['artist'] . '' : $data['title']),
            'arrangement_id' => ($data['type'] == 'song' ? $arrangement_data['id'] : ''),
            'arrangement_key' => ($data['type'] == 'song' ? $data['a_search_key'] : ''),
            'memo' => $data['memo'],
            'start_time' => verify_date_time($data['event_edit_date'], $data['event_edit_time'])
        );

        $this->db->where('id', $this->input->post('eiid'));
        return $this->db->update('event_item', $data);
    }

    /**
     * Removes event if organization matches that of that event
     * @param int $eid
     * @param int $organization
     * @return array Response
     */
    public function delete($eiid) {
        //delete the row
        $response = $this->db->delete('event_item', array('id' => $eiid));
        if (!$response)
            return array('success' => FALSE, 'reason' => 'Database query error.');
        else
            return array('success' => TRUE);
    }

}
