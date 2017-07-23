<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cron extends MY_Controller
{
  public function __construct()
  {
    parent::__construct();
  }

  public function open_doors()
  {
    $events = $this->event->get_if_greater_than_date(time());
    $users = array();
    foreach ($events as $event) {
      $event['users_matrix'] = $users_matrix = json_decode($event['users_matrix'], true);
      $event['roles_matrix'] = json_decode($event['roles_matrix'], true);
      foreach ($users_matrix as $uid => $confirmed) {
        $event['confirmed'] = $confirmed['confirmed'];
        if (!array_key_exists($uid, $users)) {
          $to_insert = $this->user->get($uid);
          $users[$uid] = $to_insert;
          $users[$uid]['events'] = array();
        }
        array_push($users[$uid]['events'], $event);
      }
    }
    foreach ($users as $user) {
      if ($user['comm_preference'] == 'email') {
        $response = $this->communication->send_email($user);
      } else {
        $response = $this->communication->send_sms($user);
      }
    }
  }

  public function database_backup()
  {
    // Load the DB utility class
    $this->load->dbutil();

    // STRUCTURE
    $structure = $this->dbutil->backup(array('format' => 'txt', 'add_insert' => false));
    $filename = 'structure.sql';
    if (!write_file('db_backup/'.$filename, $structure)) {
      die('error');
    }

    // DATA
    $data = $this->dbutil->backup(array('format' => 'txt', 'add_insert' => true, 'add_drop' => false));
    $filename = 'data.sql';
    if (!write_file('db_backup/'.$filename, $data)) {
      die('error');
    }
  }
}
