<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Community Auth - MY Controller
 *
 * Community Auth is an open source authentication application for CodeIgniter 3
 *
 * @package     Community Auth
 * @author      Robert B Gottier
 * @copyright   Copyright (c) 2011 - 2016, Robert B Gottier. (http://brianswebdesign.com/)
 * @license     BSD - http://www.opensource.org/licenses/BSD-3-Clause
 * @link        http://community-auth.com
 */
require_once APPPATH . 'third_party/community_auth/core/Auth_Controller.php';

class MY_Controller extends Auth_Controller {

    /**
     * Class constructor
     */
    public function __construct() {
        parent::__construct();

        //Set up Linux cron for db backup
        $command = '* * * * * * curl -s ' . base_url() . '?request=db_backup';
        if (!cronjob_exists($command)) {
            append_cronjob($command);
        }
        if (isset($_GET['request']) && $_GET['request'] == 'db_backup') {
            $this->db_backup();
            die;
        }

        //load models
        $this->load->model('User_model', 'user', TRUE);
        $this->load->model('User_Preference_model', 'preference', TRUE);
        $this->load->model('Blockout_model', 'blockout', TRUE);
        $this->load->model('Organization_model', 'organization', TRUE);
        $this->load->model('Event_model', 'event', TRUE);
        $this->load->model('Event_item_model', 'event_item', TRUE);
        $this->load->model('Music_model', 'music', TRUE);
        $this->load->model('Song_model', 'song', TRUE);
        $this->load->model('Media_model', 'media', TRUE);
        $this->load->model('Arrangement_model', 'arrangement', TRUE);

        //upload class
        $config['upload_path'] = 'media/';
        $config['allowed_types'] = 'doc|docx|pdf|mp3|mp4|m4a|aif|aifc|aiff|wav';
        $config['encrypt_name'] = TRUE;
        $this->upload->initialize($config);
    }

    //?request=db_backup
    public function db_backup() {
        // Load the DB utility class
        $this->load->dbutil();

        // STRUCTURE
        $structure = $this->dbutil->backup(array('format' => 'txt', 'add_insert' => FALSE));
        $filename = 'structure.sql';
        if (!write_file('db_backup/' . $filename, $structure))
            die("error");

        // DATA
        $data = $this->dbutil->backup(array('format' => 'txt', 'add_insert' => TRUE, 'add_drop' => FALSE));
        $filename = 'data.sql';
        if (!write_file('db_backup/' . $filename, $data))
            die("error");
    }

}

/* End of file MY_Controller.php */
/* Location: /community_auth/core/MY_Controller.php */