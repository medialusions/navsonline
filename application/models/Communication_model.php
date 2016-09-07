<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Communication_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        include_once APPPATH . 'third_party/Twilio/autoload.php';
    }

    /**
     * Queue communication for next door opening
     * @param string $type enum(event)
     * @param id $user_id
     * @param array $pertanent_data
     */
    public function enqueue($type, $user_id, $pertanent_data) {
        $data = [
            'type' => $type,
            'user_id' => $user_id,
            'pertanent_data' => json_encode($pertanent_data),
            'status' => 'queued',
            'created' => date('Y-m-d H:i:s')
        ];

        $this->db->insert('communication_queue', $data);
    }

    /**
     * 'Do' action and release from active queue
     * @param id $id Queue id
     */
    public function dequeue($id) {
        $query = $this->db->get_where('communication_queue', array('id' => $id));

        $queue = $query->result_array();
        foreach ($queue as $comm) //item in $comm
            break;

        $user = $this->user->get($comm['user_id']);
        $comm_pref = $user['comm_preference'];
        $type = $comm['type'];

        switch ($comm_pref) {
            case 'email':
                $response = $this->send_email($user, $type, json_decode($comm['pertanent_data'], TRUE));
                break;
            case 'phone':
                $response = $this->send_sms($user, $type, json_decode($comm['pertanent_data'], TRUE));
                break;
        }

        if ($response) //done. update data
            $this->update_raw_data($id, ['status' => 'dequeued']);
        else
            $this->update_raw_data($id, ['status' => 'error']);

        return;
    }

    /**
     * Go through each queued item and dequeue them.
     */
    public function open_doors() {
        //build upcoming query
        $query = $this->db->query(""
                . "SELECT id "
                . "FROM `communication_queue` "
                . "WHERE status = 'queued'"
        );

        $queue = $query->result_array();
        if ($query->num_rows() > 0) {
            foreach ($queue as $comm) {
                $this->dequeue($comm['id']);
            }
        } else  //base case
            return;

        //recursive
        $this->open_doors();
    }

    /**
     * 
     * @param array $user Complete user data
     * @param string $type enum(event...) i.e. template
     * @param array $pertanent_data data for the template
     * @return boolean Success|failure
     */
    public function send_email($user, $type, $pertanent_data) {
        switch ($type) {
            case 'event':
                $template = 'event';
                $subject = 'Scheduling Request';
                $replace = [
                    'LINK' => base_url('event/view' . $pertanent_data['eid']),
                    'F_NAME' => $user['first_name'],
                    '*|MC:SUBJECT|*' => 'Setup Your Account'
                ];
                break;
            default:
                return FALSE;
        }
        $this->email->from('info@medialusions.com', 'NavsBot');
        $this->email->to($user['email']);
        $this->email->subject($subject . ' - Sent ' . date('n/j/y G:ia'));
        //set up image
        $img_path = base_url() . 'logo/email_template.jpg';
        $this->email->attach($img_path);
        //get template
        $email_template = file_get_contents('application/views/comm_templates/email/' . $template . '.html');
        //set replace values and replace them
        $default_email_replace = [
            'CURRENT_YEAR' => date('Y'),
            'NAV_COMPANY' => 'Medialusions Interactive, Inc.',
            'UPDATE_PROFILE' => base_url('user/preferences'),
            'LOGO_URL' => $this->email->attachment_cid($img_path)
        ];
        //append template replace
        foreach ($default_email_replace as $key => $val) {
            $replace[$key] = $val;
        }
        $keys = array_keys($default_email_replace);
        $values = array_values($default_email_replace);
        $email_template = str_replace($keys, $values, $email_template);
        $this->email->message($email_template);
        if ($this->email->send()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * 
     * @param array $user Complete user array
     * @param string $type enum(event...) i.e. template
     * @param array $pertanent_data data for the template
     * @return boolean Succes|failure
     */
    public function send_sms($user, $type, $pertanent_data) {
        switch ($type) {
            case 'event':
                $template = 'event';
                $replace = [
                    'LINK' => base_url('event/view' . $pertanent_data['eid']),
                    'F_NAME' => $user['first_name']
                ];
                break;
            default:
                return FALSE;
        }

        //include TWILIO API
        $client = new Twilio\Rest\Client(TWILIO_ACCOUNT_SID, TWILIO_ACCOUNT_TOKEN);
        //setup message
        $sms_template = file_get_contents('application/views/comm_templates/sms/' . $template . '.html');
        $keys = array_keys($replace);
        $values = array_values($replace);
        $sms_template = str_replace($keys, $values, $sms_template);
        //send message
        try {
            $client->messages->create(
                    '+1' . $user['phone'], [
                "body" => $sms_template . ' ' . TWILIO_SIGNATURE,
                "from" => TWILIO_NUMBER
                    ]
            );
        } catch (\Twilio\Exceptions\TwilioException $e) {
            return FALSE;
        }
    }

    /**
     * Updates comm_queue data
     * @param id $id
     * @param array $data Associative array with data.
     * @return boolean Success|failure
     */
    public function update_raw_data($id, $data) {
        return $this->db->where('id', $id)
                        ->update('communication_queue', $data);
    }

}
