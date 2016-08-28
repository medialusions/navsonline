<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends MY_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get($id = '', $organization_id = '') {
        if ($id == '') {
            if ($organization_id == '') {
                $organization_id = $_SESSION['organization_id'];
            }
            return $this->organization->list_users(1, $organization_id);
        } else {
            return $this->generate_user_data($id);
        }
    }

    /**
     * Generates data from db.
     * 
     * @param varchar $user_id
     * @return db_resource
     */
    public function generate_user_data($user_id = '') {
        if ($user_id == '')
            $user_id = config_item('auth_user_id');

        $query = $this->db->get_where('users', array('user_id' => $user_id), 1);

        //return the first
        foreach ($query->result_array() as $row)
            break;

        return $row;
    }

    /**
     * Updates the auth level field in the user database.
     * @param int $auth_level Authenticatin level
     * @param int $user_id User ID
     * @return boolean Success
     */
    public function update_auth_level($auth_level, $user_id = '') {
        $refresh_after_update = FALSE;
        if ($user_id == '') {
            $user_id = config_item('auth_user_id');
            $refresh_after_update = TRUE;
        }

        $this->db->set('auth_level', $auth_level);
        $this->db->where('user_id', $user_id);
        $success = (bool) $this->db->update('users');

        if ($success) {
            if ($refresh_after_update) {
                $this->require_min_level(1);
            }
            return TRUE;
        }
        return FALSE;
    }

    /**
     * Generates the sidebar data for the left side
     */
    public function generate_sidebar_data() {
        $data['upcoming_events_count'] = count($this->event->generate_upcoming(config_item('auth_user_id'), -1));
        $data['upcoming_events'] = $this->event->generate_upcoming(config_item('auth_user_id'), 4);
        $data['contact'] = $this->organization->list_users(9);
        //clean up the old blockouts before returning the new
        $data['blockout_dates'] = $this->clean_blockouts(TRUE);

        return $data;
    }

    /**
     * Get blockouts from current user acct
     * @return array of blockouts
     */
    public function get_blockouts($user_id = '') {
        if ($user_id == '')
            $user_id = config_item('auth_user_id');

        //build upcoming query
        $query = $this->db->query(""
                . "SELECT blockouts "
                . "FROM `users` "
                . "WHERE user_id = '$user_id' "
                . "LIMIT 1"
        );

        //get the first
        foreach ($query->result_array() as $blockouts)
            break;

        //return the array
        return json_decode($blockouts['blockouts'], TRUE);
    }

    /**
     * Removes old blockout dates.
     * @return void
     */
    public function clean_blockouts($return = FALSE) {
        //get the blockouts
        $blockouts = $this->get_blockouts();

        $curr_time = time();

        $cleaned = array();
        foreach ($blockouts as $blockout) {
            if ($blockout["date_end"] > $curr_time) {
                array_push($cleaned, $blockout);
            }
        }

        $this->update_blockout($cleaned);

        if ($return)
            return $cleaned;
    }

    /**
     * Updates confirmation of user with event. 
     * 
     * @param int $eid
     * @param int $uid
     * @param bool $value
     * @return array Result of update. 
     */
    public function add_blockout($date_begin, $date_end, $reason, $uid) {//build single event query
        $query = $this->db->query(""
                . "SELECT blockouts FROM users "
                . "WHERE user_id='$uid' ");

        //grab the first/only one in $result
        foreach ($query->result_array() as $result)
            break;

        //json decode as associative array
        if ($result['blockouts'] != '')
            $blockouts = json_decode($result['blockouts'], TRUE);
        else
            $blockouts = array();

        //set new status
        $new = array('start_date' => $date_begin . '', 'date_end' => $date_end . '', 'reason' => $reason);

        //push new onto the end
        array_push($blockouts, $new);

        //update the blockouts
        $response = $this->update_blockout($blockouts, FALSE, $uid);

        if (!$response)
            return array('success' => FALSE, 'reason' => 'Database query error.');
        else
            return array('success' => TRUE);
    }

    /**
     * Used via ajax. Stores data to the database. 
     * @param mixed $data Either array or json data.
     * @param bool $json_encoded [optional] If false, data will be encoded. Default false.
     * @param int $uid [optional]
     * @return bool Result
     */
    public function update_blockout($data, $json_encoded = FALSE, $uid = '') {
        $this->db->set('blockouts', ($json_encoded ? $data : json_encode($data)));
        $this->db->where('user_id', ($uid == '' ? config_item('auth_user_id') : $uid));
        return (bool) $this->db->update('users');
    }

    /**
     * Returns the last date that this user was scheduled. False if not.
     * @param int $user_id [optional]
     * @return mixed Unix timestamp or false if not found
     */
    public function last_scheduling($user_id = '') {
        if ($user_id == '')
            $user_id = config_item('auth_user_id');

        //build upcoming query
        $json = json_encode(array($user_id => array('confirmed' => TRUE)));
        $query = $this->db->query(""
                . "SELECT date "
                . "FROM `event` "
                . "WHERE users_matrix LIKE '%" . $json . "%' "
                . "AND date < " . time() . " "
                . "ORDER BY date DESC "
                . "LIMIT 1"
        );

        //get the first
        $result = $query->result_array();

        return (count($result) > 0 ? $result[0]['date'] : FALSE);
    }

    /**
     * Get an unused ID for user creation
     *
     * @return  int between 1200 and 4294967295
     */
    public function get_unused_id() {
        // Create a random user id between 1200 and 4294967295
        $random_unique_int = 2147483648 + mt_rand(-2147482448, 2147483647);

        // Make sure the random user_id isn't already in use
        $query = $this->db->where('user_id', $random_unique_int)
                ->get_where(config_item('user_table'));

        if ($query->num_rows() > 0) {
            $query->free_result();

            // If the random user_id is already in use, try again
            return $this->get_unused_id();
        }

        return $random_unique_int;
    }

    /**
     * Uses post data to insert new user into database
     * @return boolean
     */
    public function create() {
        //for email recovery
        $recovery_code = substr($this->authentication->random_salt()
                . $this->authentication->random_salt()
                . $this->authentication->random_salt()
                . $this->authentication->random_salt(), 0, 72);
        $time = time();
        $user_data = [
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'email' => $this->input->post('email'),
            'auth_level' => auth_level($this->input->post('permissions')),
            'organizations' => $_SESSION['organization_id'] . ',',
            'blockouts' => '[]',
            'passwd_recovery_code' => $this->authentication->hash_passwd($recovery_code),
            'passwd_recovery_date' => date('Y-m-d H:i:s', $time)
        ];

        $this->form_validation->set_data($user_data);

        $validation_rules = [
            [
                'field' => 'email',
                'label' => 'email',
                'rules' => 'trim|required|valid_email|is_unique[' . config_item('user_table') . '.email]'
            ],
            [
                'field' => 'first_name',
                'label' => 'first name',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'last_name',
                'label' => 'last name',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'auth_level',
                'label' => 'auth level',
                'rules' => 'required|integer'
            ]
        ];

        $this->form_validation->set_rules($validation_rules);

        if ($this->form_validation->run()) {
            $user_data['user_id'] = $this->get_unused_id();
            $user_data['created_at'] = date('Y-m-d H:i:s', $time);

            // If username is not used, it must be entered into the record as NULL
            if (empty($user_data['username'])) {
                $user_data['username'] = NULL;
            }

            if ($this->db->set($user_data)->insert('users')) {
                //send welcome email
                $this->email->from('info@medialusions.com', 'NavsOnline');
                $this->email->to($user_data['email']);
                $this->email->subject('Setup Your Account - ' . date('H:i:s'));
                //set up image
                $img_path = base_url() . 'logo/email_template.jpg';
                $this->email->attach($img_path);
                //get template
                $email_template = file_get_contents('application/views/email/intro.html');
                //set replace values and replace them
                $keys = array('F_NAME', 'L_NAME', 'ORG_LOC', 'EXP_DATE', 'REC_LINK', 'CURRENT_YEAR', 'NAV_COMPANY', 'UPDATE_PROFILE', 'LOGO_URL', '*|MC:SUBJECT|*');
                $values = array(
                    $user_data['first_name'],
                    $user_data['last_name'],
                    $_SESSION['organization_data']['name'],
                    date('D, M jS', $time + config_item('recovery_code_expiration')),
                    base_url('user/welcome/?r=' . myurlencode($user_data['passwd_recovery_code']) . '&u=' . $user_data['user_id']),
                    date('Y'),
                    'Medialusions Interactive, Inc.',
                    base_url('user/settings'),
                    $this->email->attachment_cid($img_path),
                    'Setup Your Account'
                );
                $email_template = str_replace($keys, $values, $email_template);
                $this->email->message($email_template);
                return $this->email->send();
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Change a user's password
     * 
     * @param  string  the new password
     * @param  string  the new password confirmed
     * @param  string  the user ID
     * @param  string  the password recovery code
     */
    public function change_password($password, $password2, $user_id, $recovery_code) {
        // User ID check
        if (isset($user_id) && $user_id !== FALSE) {
            $user = $this->get($user_id);
            // If above query indicates a match, change the password
            if ($user && $recovery_code == $user['passwd_recovery_code'] && $password == $password2) {
                if ($this->db->where('user_id', $user['user_id'])
                                ->update('users', ['passwd' => $this->authentication->hash_passwd($password)]
                                ))
                    return TRUE;
                else
                    return ['result' => FALSE, 'message' => 'Error with updating password. Check the recovery code and that the passwords match.'];
            } else {
                return ['result' => FALSE, 'message' => 'Error with updating password. Check the recovery code and that the passwords match.'];
            }
        }
    }

    /**
     * Updates username if it's unique
     * @param string $username Must start with letter, be 4-32 char long and be alphanumeric
     * @param type $user_id
     * @return boolean
     */
    public function change_username($username, $user_id) {
        //check constraints of username
        if (!preg_match('/^[A-Za-z][A-Za-z0-9]{3,31}$/', $username))
            return ['result' => FALSE, 'message' => 'Username must start with letter, be 4-32 char long and be alphanumeric.'];
        //username uniqueness
        if ($this->get_by_username($username) != FALSE)
            return ['result' => FALSE, 'message' => "Username isn't unique."];
        // If above query indicates a match, check for username, then username length
        $user = $this->get($user_id);
        if ($user) {
            if (!$this->db->where('user_id', $user['user_id'])
                            ->update('users', ['username' => strtolower($username)]))
                return ['result' => FALSE, 'message' => 'Error with updating info.'];
            else
                return TRUE;
        } else {
            return ['result' => FALSE, 'message' => 'Unknown error.'];
        }
    }

    /**
     * Get the user data
     * but only if the recovery code hasn't expired.
     *
     * @param  int  the user ID
     */
    public function get_recovery_verification_data($user_id) {
        $recovery_code_expiration = date('Y-m-d H:i:s', time() - config_item('recovery_code_expiration'));

        $query = $this->db->select('*')
                ->from('users')
                ->where('user_id', $user_id)
                ->where('passwd_recovery_date >', $recovery_code_expiration)
                ->limit(1)
                ->get();

        if ($query->num_rows() == 1)
            return $query->row();

        return FALSE;
    }

    /**
     * Get data for a recovery
     * 
     * @param   string  the email address
     * @return  mixed   either query data or FALSE
     */
    public function get_by_email($email) {
        $query = $this->db->select('u.user_id, u.email, u.banned')
                ->from('users u')
                ->where('LOWER( u.email ) =', strtolower($email))
                ->limit(1)
                ->get();

        if ($query->num_rows() == 1)
            return $query->row();

        return FALSE;
    }

    /**
     * Get data for a recovery
     * 
     * @param   string  the email address
     * @return  mixed   either query data or FALSE
     */
    public function get_by_username($username) {
        $query = $this->db->select('*')
                ->from('users u')
                ->where('LOWER( u.username ) =', strtolower($username))
                ->limit(1)
                ->get();

        if ($query->num_rows() == 1) {
            //return the first
            foreach ($query->result_array() as $row)
                return $row;
        }

        return FALSE;
    }

    /**
     * Update a user record with data not from POST
     *
     * @param  int     the user ID to update
     * @param  array   the data to update in the user table
     * @return bool
     */
    public function update_user_raw_data($the_user, $user_data = []) {
        return $this->db->where('user_id', $the_user)
                        ->update(config_item('user_table'), $user_data);
    }

    public function reset_password($email, $g_recaptcha) {
        if (is_null($email) || is_null($g_recaptcha))
            throw new Exception('Could not process request.%More Information Required', 403);
        //check recaptcha
        if (!recaptcha_validation($g_recaptcha, GOOGLE_RECAPTCHA_SECRET))
            throw new Exception('You did not pass reCAPTCHA validation.%Validation Issue', 400);
        //obtain user.
        $get_by_email = $this->get_by_email($email);
        $get_by_user = $this->get_by_username($email);
        if (!$get_by_email && !$get_by_user) {
            throw new Exception('User not found.%Error Resetting Password', 402);
        } else if (!$get_by_email) {
            $user = $get_by_user;
        } else {
            $user = $get_by_email;
        }

        //for email recovery
        $recovery_code = substr($this->authentication->random_salt()
                . $this->authentication->random_salt()
                . $this->authentication->random_salt()
                . $this->authentication->random_salt(), 0, 72);
        $time = time();
        $user['passwd_recovery_code'] = $this->authentication->hash_passwd($recovery_code);
        $user['passwd_recovery_date'] = date('Y-m-d H:i:s', $time);

        if ($this->update_user_raw_data($user['user_id'], $user)) {
            //send welcome email
            $this->email->from('info@medialusions.com', 'NavsOnline');
            $this->email->to($user['email']);
            $this->email->subject('Password Reset Request - ' . date('H:i:s'));
            //set up image
            $img_path = base_url() . 'logo/email_template.jpg';
            $this->email->attach($img_path);
            //get template
            $email_template = file_get_contents('application/views/email/reset.html');
            //set replace values and replace them
            $keys = array('F_NAME', 'L_NAME', 'EXP_DATE', 'REC_LINK', 'CURRENT_YEAR', 'NAV_COMPANY', 'UPDATE_PROFILE', 'LOGO_URL', '*|MC:SUBJECT|*');
            $values = array(
                $user['first_name'],
                $user['last_name'],
                date('D, M jS', $time + config_item('recovery_code_expiration')),
                base_url('user/reset/?r=' . myurlencode($user['passwd_recovery_code']) . '&u=' . $user['user_id']),
                date('Y'),
                'Medialusions Interactive, Inc.',
                base_url('user/settings'),
                $this->email->attachment_cid($img_path),
                'Setup Your Account'
            );
            $email_template = str_replace($keys, $values, $email_template);
            $this->email->message($email_template);
            if ($this->email->send()) {
                return TRUE;
            } else {
                throw new Exception('Internal server error.%Error Sending Reset Link', 500);
            }
        } else {
            throw new Exception('Please try again.%Internal Server Error', 501);
        }
    }

}
