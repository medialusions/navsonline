<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_Preference_model extends User_model {

    public function __construct() {
        parent::__construct();
        include_once APPPATH . 'third_party/Twilio/autoload.php';
    }

    public function update() {
        //get data
        $user = parent::get($this->auth_user_id);
        $update = [];
        $posted_data = $this->input->post();
        $form_errors = [];
        $toRet = [];

        //check fields
        /**
         * Communication preference logic
         */
        if ($posted_data['comm_preference'] == 'phone' && strlen(preg_replace('/[^0-9,]|,[0-9]*$/', '', $posted_data['phone'])) != 10) {
            array_push($form_errors, 'If you select `phone` as your communication preference, you must supply a valid number.');
        } else if (array_search($posted_data['comm_preference'], ['email', 'phone']) !== FALSE) {
            $update['comm_preference'] = $posted_data['comm_preference'];
        } else {
            array_push($form_errors, 'Invalid data provided for your communication preference.');
        }
        /**
         * Phone number logic
         */
        if ($posted_data['phone'] != '') {
            $phone = preg_replace('/[^0-9,]|,[0-9]*$/', '', $posted_data['phone']);
            if (strlen($phone) == 10) {
                if ($phone != $user['phone']) {
                    $toRet['phone_validation_required'] = $phone;
                    $update['phone_to_confirm'] = $phone;
                }
            } else {
                array_push($form_errors, 'Phone number appears to be invalid.');
            }
        } else {
            $update['phone'] = '';
        }
        /**
         * Full name logic
         */
        if (($posted_data['first_name'] != $user['first_name']) || ($posted_data['last_name'] != $user['last_name'])) {
            $update['first_name'] = $posted_data['first_name'];
            $update['last_name'] = $posted_data['last_name'];
        }
        /**
         * Password logic
         */
        if ($posted_data['passwd'] != '' && $posted_data['password'] != '' &&
                $posted_data['password'] == $posted_data['new_password_repeat'] && $posted_data['strength'] >= 3) {
            if (password_verify($posted_data['passwd'], $user['passwd'])) { //verified password
                if (!$this->db->where('user_id', $user['user_id'])
                                ->update('users', ['passwd' => $this->authentication->hash_passwd($posted_data['password'])])) { //updated password
                    array_push($form_errors, 'There was an error updating the password.');
                }
            } else {
                array_push($form_errors, 'You have entered an incorrect password.');
            }
        }
        if ($posted_data['password'] != '' && $posted_data['strength'] < 3) {
            array_push($form_errors, 'You need a stronger password.');
        }
        if ($posted_data['password'] != '' && $posted_data['password'] != $posted_data['new_password_repeat']) {
            array_push($form_errors, 'New passwords do not match.');
        }
        /**
         * Update the data
         */
        $toRet['form_errors'] = $form_errors;
        if (parent::update_user_raw_data($user['user_id'], $update)) {
            $toRet['success'] = TRUE;
        } else {
            $toRet['success'] = FALSE;
        }
        return $toRet;
    }

    public function confirm_phone($user_id, $phone) {
        //include TWILIO API
        $client = new Twilio\Rest\Client(TWILIO_ACCOUNT_SID, TWILIO_ACCOUNT_TOKEN);
        //get user data
        $user = parent::get($user_id);
        $phone_confirmation = mt_rand(100000, 999999); //6 dig conf code
        $date = date("Y-m-d H:i:s", time() + 300); //5 min from now
        //update user info before message send
        parent::update_user_raw_data($user['user_id'], [
            'phone_confirmation' => $phone_confirmation,
            'phone_confirmation_date' => $date
        ]);
        //send message
        try {
            $client->messages->create(
                    '+1' . $phone, [
                "body" => 'Hello, ' . $user['first_name'] . '. Conf #: ' . $phone_confirmation . '. Code expires in 5 min. ' . TWILIO_SIGNATURE,
                "from" => TWILIO_NUMBER
                    ]
            );
        } catch (\Twilio\Exceptions\TwilioException $e) {
            die(json_encode(['success' => FALSE, 'message' => $e->getMessage()]));
        }
    }

    public function confirm_phone_confirmation($user_id, $confirmation) {
        //get info
        $time = time();
        $user = parent::get($user_id);
        //get time limit and confirmation
        $time_limit = strtotime($user['phone_confirmation_date']);
        $user_conf = $user['phone_confirmation'];
        //logic
        if ($time > $time_limit)
            return ['success' => FALSE, 'message' => 'Code expired.'];
        if ($confirmation == $user_conf) {
            parent::update_user_raw_data($user['user_id'], [
                'phone_confirmation' => '',
                'phone_confirmation_date' => date("Y-m-d H:i:s"),
                'phone' => $user['phone_to_confirm'],
                'phone_to_confirm' => ''
            ]);
            return ['success' => TRUE, 'message' => 'Code matches.'];
        } else
            return ['success' => FALSE, 'message' => 'No match.'];
    }

}
