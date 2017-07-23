<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Event_model extends MY_Model
{
  public $organization_id;

  public function __construct()
  {
    // Call the CI_Model constructor
    parent::__construct();

    $this->organization_id = $this->session->userdata('organization_id');
  }

  public function get($id, $last_entry_time = true)
  {
    //build upcoming query
    $query = $this->db->query(""
  . "SELECT * "
  . "FROM event "
  . "WHERE organization='$this->organization_id' "
  . "AND id='$id'"
  . "LIMIT 1");

    //get the single result
    foreach ($query->result_array() as $row) {
      break;
    }

    if ($last_entry_time) {
      $row['last_entry_time'] = $this->get_last_time($id);
    }

    return $row;
  }

  public function get_if_greater_than_date($timestamp)
  {
    $query = $this->db->query(""
  . "SELECT * "
  . "FROM event "
  . "WHERE organization='$this->organization_id' "
  . "AND date >= '$timestamp'");

    return $query->result_array();
  }

  /**
  * Must have name and date/time in post data
  */
  public function create()
  {
    $event_name = $this->input->post('event_name', true);
    $event_date = $this->input->post('event_date', true);
    $event_time = $this->input->post('event_time', true);

    $timestamp = verify_date_time($event_date, $event_time);

    $user_id = config_item('auth_user_id');

    //init setup of users and roles matrix
    $users = array($user_id => array('confirmed' => 'confirmed'));
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

  public function copy()
  {
    $old_event_id = $this->input->post('eid', true);
    $new_event_id = $this->create();
    $old_event = $this->get($old_event_id);
    $new_event = $this->get($new_event_id);
    $items = $this->event_item->get($old_event_id);
    $success = true;
    foreach ($items as $item) {
      if (!$this->event_item->add([
    'type' => $item['type'],
    'arrangement_search' => json_encode(['id' => $item['arrangement_id']]),
    'event_id' => $new_event_id,
    'title' => $item['title'],
    'a_search_key' => $item['arrangement_key'],
    'memo' => $item['memo'],
    'event_time' => date('D, d M Y H:i:s', ($item['start_time'] - $old_event['date']) + $new_event['date'])
    ])) {
        $success = false;
      }
    }
    return $new_event_id;
  }

  /**
  * Updates raw data
  * @param array $data
  * @param id $eid
  */
  public function update($data, $eid)
  {
    $this->db->set($data);
    $this->db->where('id', $eid);
    return $this->db->update('event');
  }

  /**
  * Generates upcoming events
  * @param int $user_id [optional]
  * @param int $limit [optional] -1 if pagination. Otherwise limits with offset of 0.
  * @param type $page [optional] Page number. Pages with limits of 10.
  * @return type array results
  */
  public function generate_upcoming($user_id = '', $limit = 4, $page = 1, $admin = false, $get = null)
  {
    if ($limit == -1) {
      $limit_q = "LIMIT " . (($page - 1) * 10) . ", 10";
    } else {
      $limit_q = ($limit > 0 ? "LIMIT $limit" : '');
    }
    //build upcoming query
    $get_query = '';
    if (!is_null($get) && isset($get['start']) && isset($get['end'])) {
      $start = strtotime($get['start']);
      $end = strtotime($get['end']);
      $get_query .= "AND date >= $start "
    . "AND date <= $end ";
    } else {
      $get_query .= "AND date > " . time() . " ";
    }
    $query_string = ""
  . "SELECT * "
  . "FROM event "
  . "WHERE organization='$this->organization_id' "
  . ($user_id == '' || $admin ? '' : "AND  users_matrix LIKE '%$user_id%' ")
  . $get_query
  . "ORDER BY date ASC "
  . $limit_q;
    $query = $this->db->query($query_string);

    //return the array
    return $query->result_array();
  }

  /**
  * Returns the pagination array
  * @param int $page Page number
  */
  public function get_pagination($page)
  {
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
  public function confirm($eid, $uid, $value)
  {//build single event query
    $query = $this->db->query(""
  . "SELECT users_matrix FROM event "
  . "WHERE id='$eid' ");

    //grab the first/only one in $result
    foreach ($query->result_array() as $result) {
      break;
    }

    //json decode as associative array
    $users_matrix = json_decode($result['users_matrix'], true);

    if (array_key_exists($uid, $users_matrix) === false) {
      return array('success' => false, 'reason' => 'Unauthorized. User not scheduled for this event.');
    }

    //set new status
    $users_matrix[$uid]['confirmed'] = $value == 'true' ? 'confirmed' : 'denied';

    $this->db->set('users_matrix', json_encode($users_matrix));
    $this->db->where('id', $eid);
    $response = $this->db->update('event');

    if (!$response) {
      return array('success' => false, 'reason' => 'Database query error.');
    } else {
      return array('success' => true);
    }
  }

  /**
  * Removes event if organization matches that of that event
  * @param int $eid
  * @param int $organization
  * @return array Response
  */
  public function delete($eid, $organization = '')
  {
    //get session organization if unset
    if ($organization == '') {
      $organization = $this->organization_id;
    }
    //verify organization first
    $query = $this->db->query(""
  . "SELECT organization FROM event "
  . "WHERE id='$eid' ");
    //grab the first/only one in $result
    foreach ($query->result_array() as $result) {
      break;
    }
    $organization_db = $result['organization'];
    if ($organization_db != $organization) {
      return array('success' => false, 'reason' => 'Unauthorized. User has no control of this organization.');
    }
    //passed organization verification
    //delete the row
    $response = $this->db->delete('event', array('id' => $eid));
    if (!$response) {
      return array('success' => false, 'reason' => 'Database query error.');
    } else {
      return array('success' => true);
    }
  }

  /**
  * Gets last time of last event item or false if none exists.
  * @param int $id Event id
  * @return date Time stamp of the last time entered
  */
  public function get_last_time($id)
  {
    $query = $this->db->query(""
  . "SELECT start_time FROM event_item "
  . "WHERE event_id='$id' "
  . "ORDER BY start_time DESC "
  . "LIMIT 1");
    if ($query->num_rows() != 1) {
      return false;
    } else {
      $row = $query->row();
      return $row->start_time;
    }
  }

  /**
  * Gets all roles from organization.
  * @return mixed Array of roles or false on failure
  */
  public function get_roles($organization = '')
  {
    //get session organization if unset
    if ($organization == '') {
      $organization = $this->organization_id;
    }

    $query = $this->db->query(""
  . "SELECT roles_matrix FROM event "
  . "WHERE organization='$this->organization_id'");
    if ($query->num_rows() < 1) {
      return false;
    } else {
      return array_values($query->result_array());
    }
  }

  /**
  * Returns people array for this event
  * @param int $id Id of event
  * @return array Array of people associated with the event
  */
  public function get_people($id)
  {
    $event = $this->get($id);
    //get users
    $u_matrix = $event['users_matrix'];
    $users = json_decode($u_matrix, true);
    //get roles
    $r_matrix = $event['roles_matrix'];
    $roles = json_decode($r_matrix, true);
    $toRet = [];
    foreach ($users as $key => $user) {
      $toRet[$key] = $user;
      $toRet[$key]['roles'] = [];
      foreach ($roles[$key] as $role) {
        array_push($toRet[$key]['roles'], slug_to_proper($role));
      }
      foreach ($this->user->get($key) as $u_data_key => $u_data) {
        $toRet[$key][$u_data_key] = $u_data;
      }
    }
    return $toRet;
  }
}
