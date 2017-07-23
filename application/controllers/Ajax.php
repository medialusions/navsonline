<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Ajax extends MY_Controller
{

  /**
  * Constructor. Gets user data/status.
  */
  public function __construct()
  {
    parent::__construct();
  }

  public function resend_phone_confirmation()
  {
    //get user data
    $this->verify_min_ajax_level(3);
    $user_data = $this->verify_cookie();
    //tell pref model to resend
    $this->preference->confirm_phone($user_data['user_id'], $user_data['user_data']['phone_to_confirm']);
    echo json_encode(array('success' => true, 'message' => 'Message resent.'));
  }

  public function resend_user_confirmation($uid)
  {
    //get user data
    $this->verify_min_ajax_level(9);
    //tell pref model to resend
    $response = $this->user->send_confirmation_email($this->user->get($uid));
    if ($response) {
      echo json_encode(array('success' => true, 'message' => 'Message resent.'));
    } else {
      echo json_encode(array('success' => false, 'message' => 'Message couldn\'t be sent.'));
    }
  }

  public function confirm_phone_confirmation()
  {
    //get user data
    $this->verify_min_ajax_level(3);
    $user_data = $this->verify_cookie();
    //get post data
    $confirmation = $this->input->post('confirmation');
    //check post data first
    if (is_null($confirmation)) {
      die(json_encode(array('success' => false, 'message' => 'Incomplete post data sent.')));
    }
    //tell pref model to check confirmation
    $response = $this->preference->confirm_phone_confirmation($user_data['user_id'], $confirmation);
    echo json_encode($response);
  }

  /**
  * Uses Cookie, Post, and Files data to upload and create database instance of media files
  */
  public function media_add()
  {
    //get user data
    $this->verify_min_ajax_level(9);
    $user_data = $this->verify_cookie();
    //check post data first
    if (!isset($_POST) || is_null($this->input->post("link_type")) || is_null($this->input->post("name"))) {
      die(json_encode(array('success' => false, 'message' => 'Incomplete post data sent.')));
    }
    $link_type = $this->input->post("link_type");
    $name = $this->input->post("name");
    //determine link type and set upload path
    switch ($link_type) {
      case 'audio':
      case 'chord':
      case 'lyric':
      $upload_path = 'media/' . $link_type . '/';
      break;
      default:
      die(json_encode(array('success' => false, 'message' => 'Unknown link type.')));
      break;
    }
    //upload class
    $upload['upload_path'] = $upload_path;
    $upload['allowed_types'] = 'doc|docx|pdf|mp3|mp4|m4a|aif|aifc|aiff|wav';
    $upload['encrypt_name'] = true;
    $this->upload->initialize($upload);
    //do the upload
    $upload_result = $this->upload->do_upload("file");
    if (!$upload_result) {
      die(json_encode(array('success' => false, 'message' => 'Error. ' . $this->upload->display_errors('', ''), "data" => $this->upload->data())));
    }


    //insert into db
    $response = $this->media->add_declaration($this->upload->data(), $this->input->post(), $user_data);
    if (!$response) {
      die(json_encode(array('success' => false, 'message' => 'Error with databse.')));
    } else {
      die(json_encode(array('success' => true, 'message' => 'File uploaded.')));
    }
  }

  public function media_search()
  {
    //get user data
    $this->verify_min_ajax_level(1);
    $user_data = $this->verify_cookie();
    $user_organizations = explode(',', $user_data['user_data']['organizations']);

    $type = $this->input->get("type");
    $query = $this->input->get("q");
    if (is_null($type)) {
      $type = "";
    }

    //do it
    $result = array('results' => array());
    $search_result = $this->media->search($query, $user_organizations[0], $type);
    foreach ($search_result as $row) {
      array_push($result['results'], array(
        "title" => $row['name'],
        "id" => $row['id'],
        "link" => $row['link']
      ));
    }
    echo json_encode($result);
  }

  public function user_search()
  {
    //get user data
    $this->verify_min_ajax_level(1);
    $user_data = $this->verify_cookie();
    $user_organizations = explode(',', $user_data['user_data']['organizations']);

    $restriction = $this->input->get("restricted");
    $query = $this->input->get("q");
    if (is_null($restriction)) {
      $restriction = "";
    }

    //do it
    $result = array('results' => array());
    $search_result = $this->organization->user_search($query, $user_organizations[0], $restriction);
    foreach ($search_result as $row) {
      array_push($result['results'], array(
        "title" => $row['first_name'] . ' ' . $row['last_name'],
        "id" => $row['user_id']
      ));
    }
    echo json_encode($result);
  }

  /**
  * API for updating event confirmation
  * @param int $eid
  * @param int $uid
  * @param bool $value
  * @return void
  */
  public function event_confirm($eid, $uid, $value = true)
  {
    //verify user with cookie data
    $this->verify_user($uid);
    //call the model function
    $response = $this->event->confirm($eid, $uid, $value);
    echo json_encode($response);
  }

  /**
  * See event_confirm($eid, $uid, FALSE)
  */
  public function event_deny($eid, $uid)
  {
    //confirm it
    $this->event_confirm($eid, $uid, false);
  }

  /**
  * Controller function to remove the event. Verifies with cookie auth level.
  * @param int $eid ID of the cookie.
  */
  public function event_delete($eid)
  {
    $cookie = $this->verify_cookie();
    $user_organizations = explode(',', $cookie['user_data']['organizations']);

    //verify admin level
    $this->verify_min_ajax_level(9);

    //remove
    $response = $this->event->delete($eid, $user_organizations[0]);

    if ($response['success']) {
      echo json_encode(array('success' => true, 'data' => $eid));
    } else {
      echo json_encode(array('success' => false));
    }
  }

  /**
  *
  * @param int $eiid Id of event item
  */
  public function event_item_delete($eiid)
  {
    //verify admin level
    $this->verify_min_ajax_level(5);

    //remove
    $response = $this->event_item->delete($eiid);

    if ($response['success']) {
      echo json_encode(array('success' => true, 'data' => $eiid));
    } else {
      echo json_encode(array('success' => false));
    }
  }

  public function event_name_edit($eid)
  {
    //verify admin level
    $this->verify_min_ajax_level(5);
    if(!is_null($this->input->post("name"))) {
      $event = $this->event->get($eid, false);
      $event['name'] = $this->input->post("name");
      $this->event->update($event, $eid);
    }else{
      die(json_encode(['success' => false]));
    }
    die(json_encode(['success' => true]));
  }

  /**
  * Via POST variables
  */
  public function event_person_add($eid)
  {
    //verify admin level
    $this->verify_min_ajax_level(5);
    //get post data
    if (!is_null($this->input->post("user"))) { //new user
      $user = $this->input->post("user");
      $user_arr = json_decode($user, true);
    } elseif (!is_null($this->input->post("user_id"))) { //editing existing user
      $user_arr = array('title' => $this->input->post("user_name"), 'id' => $this->input->post("user_id"));
    }
    $role = $this->input->post("roles");
    $role_arr = explode(",", $role);
    //get current data
    $event = $this->event->get($eid, false);
    $users_matrix = $event['users_matrix'];
    $users = json_decode($users_matrix, true);
    $roles_matrix = $event['roles_matrix'];
    $roles = json_decode($roles_matrix, true);
    //update data
    if (!key_exists($user_arr['id'], $users)) {
      $users[$user_arr['id']] = ['confirmed' => "unknown"];
    }

    $role_slugs = array_map('slugify', $role_arr);
    if (!key_exists($user_arr['id'], $roles)) {
      $roles[$user_arr['id']] = $role_slugs;
    } else {
      $roles[$user_arr['id']] = $role_slugs;
    }
    //put back and send it to DB
    $event['users_matrix'] = json_encode($users);
    $event['roles_matrix'] = json_encode($roles);
    $result = $this->event->update($event, $eid);
    if ($result) {
      $imploded = implode(', ', $role_arr);
      $json_data = json_encode([
        'name' => $user_arr['title'],
        'user_id' => $user_arr['id'],
        'roles' => $role_arr
      ]);
      switch ($users[$user_arr['id']]['confirmed']) {
        case 'confirmed':
        $confirmed = 'green checkmark';
        $conf_text = "Confirmed";
        break;
        case 'denied':
        $confirmed = 'red remove';
        $conf_text = "Denied";
        break;
        case 'unknown':
        $confirmed = 'grey help';
        $conf_text = "Unknown";
        break;
      }
      $html = <<< HTML
      <div class="item" id="person_{$user_arr['id']}">
        <i class="ui $confirmed icon navs_popup" data-content="$conf_text" data-position="top center"></i>
        <div class="middle aligned content">
          <a href="javascript:void(0)" class="ui people_edit_modal_link"><b>{$user_arr['title']}</b></a>
          <span class="hidden" style="display: none;">$json_data</span>
          $imploded
        </div>
      </div>
HTML;
      die(json_encode(['success' => true, 'html' => $html]));
    } else {
      die(json_encode(['success' => false]));
    }
  }

  public function event_person_delete($eid, $uid)
  {
    //verify admin level
    $this->verify_min_ajax_level(5);
    //get current data
    $event = $this->event->get($eid, false);
    $users_matrix = $event['users_matrix'];
    $users = json_decode($users_matrix, true);
    $roles_matrix = $event['roles_matrix'];
    $roles = json_decode($roles_matrix, true);

    //remove
    unset($users[$uid]);
    unset($roles[$uid]);

    //put back and send it to DB
    $event['users_matrix'] = json_encode($users);
    $event['roles_matrix'] = json_encode($roles);
    $result = $this->event->update($event, $eid);
    if (!$result) {
      echo json_encode(array('success' => false));
    } else {
      echo json_encode(array('success' => true, 'reload' => true));
    }
  }

  /**
  * Controller function to remove the song. Verifies with cookie auth level.
  * @param int $sid
  */
  public function song_delete($sid)
  {
    $cookie = $this->verify_cookie();
    $user_organizations = explode(',', $cookie['user_data']['organizations']);

    //verify admin level
    $this->verify_min_ajax_level(9);

    //remove
    $response = $this->song->delete($sid, $user_organizations[0]);

    if ($response['success']) {
      //delete the arrangements
      $arrangements = $this->arrangement->song_get($sid);
      foreach ($arrangements as $arr) {
        $this->arrangement->delete($arr['id']);
      }

      echo json_encode(array('success' => true));
    } else {
      echo json_encode(array('success' => false));
    }
  }

  /**
  * Controller function to remove the arrangement. Verifies with cookie auth level.
  * @param int $aid
  */
  public function arrangement_delete($aid)
  {
    //verify admin level
    $this->verify_min_ajax_level(9);

    //remove
    $response = $this->arrangement->delete($aid);

    if ($response) {
      echo json_encode(array('success' => true));
    } else {
      echo json_encode(array('success' => false));
    }
  }

  public function arrangement_search()
  {
    //get user data
    $this->verify_min_ajax_level(1);
    $user_data = $this->verify_cookie();
    $user_organizations = explode(',', $user_data['user_data']['organizations']);

    $query = $this->input->get("q");

    //do it
    $result = array('results' => array());
    $search_result = $this->arrangement->search($query, $user_organizations[0]);

    foreach ($search_result as $row) {
      array_push($result['results'], array(
        "title" => $row['title'],
        "description" => $row['artist'],
        "id" => $row['id'],
        "keys" => $row['song_keys'],
        "default" => $row['default_key']
      ));
    }
    echo json_encode($result);
  }

  public function song_search()
  {
    //get user data
    $this->verify_min_ajax_level(1);
    $user_data = $this->verify_cookie();
    $user_organizations = explode(',', $user_data['user_data']['organizations']);

    $query = $this->input->get("q");

    //do it
    $result = array('results' => array());
    $search_result = $this->song->search($query, $user_organizations[0]);

    foreach ($search_result as $row) {
      $tags = json_decode($row['tags'], true);
      $count = count($this->arrangement->song_get($row['id']));
      array_push($result['results'], array(
        "title" => $row['title'],
        "description" => 'Tags: ' . implode(', ', $tags) . '<br/>' . $count . ' arrangement' . ($count != 1 ? 's' : ''),
        "url" => base_url('music/view/' . $row['id'])
      ));
    }
    echo json_encode($result);
  }

  /**
  * Uses get vars
  * ?db={db}&de={de}&reason={reason}&uid={uid}
  * @return void
  */
  public function blockout_add()
  {
    //get and format date
    $date_begin = verify_date(stripslashes($this->input->get('db')));
    $date_end = verify_date(stripslashes($this->input->get('de')));

    //get other vars
    $reason = $this->input->get('reason');
    $uid = $this->input->get('uid');

    //verify user with cookie data
    $this->verify_user($uid);

    //send it to the model
    $result = $this->user->add_blockout($date_begin, $date_end, $reason, $uid);
    echo json_encode($result);
  }

  /**
  * Deletes the selected blockout date and echos response
  * @param text $uid
  * @param unix $date_begin
  * @param unix $date_end
  * @return void
  */
  public function blockout_delete($uid, $date_begin, $date_end)
  {
    //verify user with cookie data
    $this->verify_user($uid);

    //get all
    $blockouts = $this->user->get_blockouts($uid);

    //remove single blockout
    $clean = array();
    foreach ($blockouts as $blockout) {
      if ($blockout['start_date'] != $date_begin && $blockout['date_end'] != $date_end) {
        array_push($clean, $blockout);
      }
    }

    //update it
    $response = $this->user->update_blockout($clean, false, $uid);

    //response
    if (!$response) {
      echo json_encode(array('success' => false, 'reason' => 'Database query error.'));
    } else {
      echo json_encode(array('success' => true));
    }
  }

  public function user_role()
  {
    //verify admin level
    $this->verify_min_ajax_level(9);

    if (is_null($this->input->get()) ||
    is_null($this->input->get('uid')) ||
    is_null($this->input->get('update')) ||
    is_null($this->input->get('role'))) {
      echo json_encode(array('success' => false, 'reason' => 'Missing parameters.'));
      die;
    }
    $auth_role = $this->input->get('role');
    $user_id = $this->input->get('uid');
    $success = $this->user->update_auth_level(auth_level($auth_role), $user_id);
    if (!$success) {
      echo json_encode(array('success' => false, 'reason' => 'Database query error.'));
    } else {
      echo json_encode(array('success' => true, 'reload' => true));
    }
  }

  public function unique_username()
  {
    //get the username
    $username = $this->input->post('username');
    $result = $this->user->get_by_username($username);
    if ($result === false) {
      echo json_encode(['success' => true, 'unique' => true]);
    } else {
      echo json_encode(['success' => true, 'unique' => false]);
    }
  }

  /**
  * @return array All user data pertaining to the current ci_session cookie that was sent.
  */
  private function verify_cookie()
  {
    $headers = getallheaders();
    $cookies = explode(';', $headers['Cookie']);

    //$cookie will have ci_session
    foreach ($cookies as $cookie) {
      $arr = explode('=', $cookie);
      array_walk($arr, 'trim_value');
      if ($arr[0] == 'ci_session') {
        $cookie = $arr;
        break;
      }
    }

    //now get the session data
    $query = $this->db->get_where('auth_sessions', array('id' => $arr[1]), 1);

    if ($query->num_rows() == 0) {
      die(json_encode(array('success' => false, 'message' => "You aren't authorized to do this procedure.")));
    }

    //return the first
    foreach ($query->result_array() as $row) {
      break;
    }

    //fetch user data and return it all
    $user_data = $this->user->generate_user_data($row['user_id']);
    $row['user_data'] = $user_data;
    return $row;
  }

  /**
  * @param id $uid To be verified against cookie data.
  */
  public function verify_user($uid)
  {
    //cookie verification
    $cookie = $this->verify_cookie();
    $user_id = $cookie['user_id'];
    //verify user id
    if ($user_id != $uid) {
      die(json_encode(array('success' => false, 'message' => "You aren't authorized to do this procedure.")));
    }
  }

  /**
  * @param id $level To be verified against cookie data.
  */
  public function verify_min_ajax_level($level)
  {
    $cookie = $this->verify_cookie();
    //verify admin level
    if ($cookie['user_data']['auth_level'] < $level) {
      die(json_encode(array('success' => false, 'message' => "You aren't authorized to do this procedure.")));
    }
  }
}
