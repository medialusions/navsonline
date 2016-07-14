<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Arrangement_model extends MY_Model {

    public $organization_id;

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();

        $this->organization_id = $this->session->userdata('organization_id');
    }

    public function get($id) {
        $query = $this->db->query("SELECT * FROM arrangement WHERE id='$id'");
        
        //return the first
        foreach ($query->result_array() as $result)
            return $result;
    }

    public function song_get($song_id) {
        $query = $this->db->query("SELECT * FROM arrangement WHERE song='$song_id' ORDER BY artist");
        return $query->result_array();
    }

    public function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('arrangement');
    }

    /**
     * @param array $data
     * @return id
     */
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

    /**
     * @param array $data
     * @return id
     */
    public function edit($data) {
        print_r($data);
        $id = $data['arr_id'];
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
            'song_keys' => $data['song_keys']
        );
        $this->db->where('id', $id);
        $this->db->update('arrangement', $data);

        return $this->db->last_query();
    }

    /**
     * @param type $column
     * @return type array
     */
    public function get_unique($column = 'artist') {
        $query = $this->db->query("SELECT * FROM arrangement WHERE organizations LIKE '%\"$this->organization_id\"%' GROUP BY($column) ORDER BY $column");
        return $query->result_array();
    }

}
