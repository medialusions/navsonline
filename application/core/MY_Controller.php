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

        //load models
        $this->load->model('user_model', 'user', TRUE);
        $this->load->model('blockout_model', 'blockout', TRUE);
        $this->load->model('event_model', 'event', TRUE);
        $this->load->model('event_item_model', 'event_item', TRUE);
        $this->load->model('music_model', 'music', TRUE);
        $this->load->model('song_model', 'song', TRUE);
        $this->load->model('organization_model', 'organization', TRUE);
        $this->load->model('media_model', 'media', TRUE);
        $this->load->model('arrangement_model', 'arrangement', TRUE);

        //upload class
        $config['upload_path'] = 'media/';
        $config['allowed_types'] = 'doc|docx|pdf|mp3|mp4|m4a|aif|aifc|aiff|wav';
        $config['encrypt_name'] = TRUE;
        $this->upload->initialize($config);

        //if logged in, check organizations session
        if (isset($_COOKIE['ci_session']) && $this->require_min_level(1)) {
            $data['user'] = $this->user->generate_user_data($this->auth_user_id);
            $this->session->set_userdata('organization_id', extract_organization($data['user']['organizations']), 0);
            //get organization db data
            $organization_data = $this->organization->get($_SESSION['organization_id']);
            //get tz offset
            $tz_navs = new DateTimeZone(date_default_timezone_get());
            $tz_org = new DateTimeZone($organization_data['timezone']);
            $dateTime1 = new DateTime("now", $tz_navs);
            $dateTime2 = new DateTime("now", $tz_org);
            $tz_navs_offset = $tz_navs->getOffset($dateTime1);
            $tz_org_offset = $tz_org->getOffset($dateTime2);
            $organization_data['offset'] = $tz_org_offset - $tz_navs_offset; //in seconds
            //set session variables
            $this->session->set_userdata('organization_data', $organization_data, 0);
        }
    }

}

/* End of file MY_Controller.php */
/* Location: /community_auth/core/MY_Controller.php */