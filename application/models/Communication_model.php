<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Communication_model extends MY_Model
{
  public function __construct()
  {
    parent::__construct();
    include_once APPPATH.'third_party/Twilio/autoload.php';
  }

  static function confirmation_to_emoji($status) {
    switch ($status) {
      case 'confirmed':
        return '✔️';
      case 'denied':
        return '❌';
      default:
        return '❔';
    }
  }

  /**
  * @param array  $user           Complete user data
  * @param string $type           enum(event...) i.e. template
  * @param array  $pertanent_data data for the template
  *
  * @return bool Success|failure
  */
  public function send_email($user)
  {
    $text = "";
    foreach ($user['events'] as $event) {
      $text .= date('M jS', $event['date']) . " • " . $event['name'] . ' ' . confirmation_to_emoji($event['confirmed']) . "<br/>";
      foreach ($event['roles_matrix'][$user['user_id']] as $role) {
        $text .= "‣ " . slug_to_proper($role) . "<br/>";
      }
    }
    $subject = 'Scheduling Request';
    $replace = [
    'LINK' => base_url('user/schedule'),
    'F_NAME' => $user['first_name'],
    '*|MC:SUBJECT|*' => 'Setup Your Account',
  ];
    $this->email->from('info@medialusions.com', 'NavsBot');
    $this->email->to($user['email']);
    $this->email->subject($subject);
    //set up image
    $img_path = base_url().'logo/email_template.jpg';
    $this->email->attach($img_path);
    //get template
    $email_template = file_get_contents('application/views/comm_templates/email/event.html');
    //set replace values and replace them
    $default_email_replace = [
    'CURRENT_YEAR' => date('Y'),
    'NAV_COMPANY' => 'Medialusions Interactive, Inc.',
    'UPDATE_PROFILE' => base_url('user/preferences'),
    'LOGO_URL' => $this->email->attachment_cid($img_path),
    'SCHEDULE' => $text
  ];
    //append template replace
    foreach ($default_email_replace as $key => $val) {
      $replace[$key] = $val;
    }
    $keys = array_keys($replace);
    $values = array_values($replace);
    $email_template = str_replace($keys, $values, $email_template);

    $this->email->message($email_template);
    if ($this->email->send(false)) {
      $this->email->clear(true);
      echo 'Email sent<br>'.PHP_EOL;
      return true;
    } else {
      var_dump($this->email->print_debugger(['headers', 'subject']));
      $this->email->clear(true);
      echo 'Email failed to send<br>'.PHP_EOL;

      return false;
    }
  }

  /**
  * @param array  $user           Complete user array
  * @param string $type           enum(event...) i.e. template
  * @param array  $pertanent_data data for the template
  *
  * @return bool Succes|failure
  */
  public function send_sms($user)
  {
    $text = "";
    foreach ($user['events'] as $event) {
      $text .= "\n" . date('M jS', $event['date']) . " • " . $event['name'] . ' ' . confirmation_to_emoji($event['confirmed']);
      foreach ($event['roles_matrix'][$user['user_id']] as $role) {
        $text .= "\n" . "‣ " . slug_to_proper($role);
      }
    }
    $text .= "\n\n";
    $replace = [
    'LINK' => base_url('user/schedule/'),
    'F_NAME' => $user['first_name'],
    'SCHEDULE' => $text
  ];

    //include TWILIO API
    $client = new Twilio\Rest\Client(TWILIO_ACCOUNT_SID, TWILIO_ACCOUNT_TOKEN);
    //setup message
    $sms_template = file_get_contents('application/views/comm_templates/sms/event.html');
    $keys = array_keys($replace);
    $values = array_values($replace);
    $sms_template = str_replace($keys, $values, $sms_template);
    //send message
    try {
      $client->messages->create(
    '+1'.$user['phone'],
    [
      'body' => $sms_template.' '.TWILIO_SIGNATURE,
      'from' => TWILIO_NUMBER,
    ]
    );
      echo 'SMS sent<br>'.PHP_EOL;
    } catch (Exception $e) {
      echo 'SMS failed to send.<br>'.PHP_EOL;
      var_dump($e);

      return false;
    }

    return true;
  }

  /**
  * Updates comm_queue data.
  *
  * @param id    $id
  * @param array $data associative array with data
  *
  * @return bool Success|failure
  */
  public function update_raw_data($id, $data)
  {
    return $this->db->where('id', $id)->update('communication_queue', $data);
  }
}
