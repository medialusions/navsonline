<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Arrangement_model extends MY_Model {

    public $organization_id;

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();

        $this->organization_id = $this->session->userdata('organization_id');
    }

    public function create($data) {
        $user_id = config_item('auth_user_id');

        //setting up insert
        $data = array(
            'artist' => $data['artist'],
            'default_key' => $data['default_key'],
            'bpm' => $data['bpm'],
            'length' => $data['length'],
            'lyrics' => $data['lyrics'],
            'video' => $data['video'],
            'audio' => $data['audio'],
            'song' => $data['song'],
            'song_keys' => $data['song_keys'],
            'organizations' => json_encode(array($this->organization_id)),
            'date_created' => time(),
            'created_by' => $user_id
        );

        $this->db->insert('arrangement', $data);

        return $this->db->insert_id();
    }

}
