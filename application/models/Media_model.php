<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Media_model extends MY_Model {

    public $organization_id;

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();

        $this->organization_id = $this->session->userdata('organization_id');
    }

    public function add_declaration($file_data, $post_data, $user_data) {
        $user_organizations = explode(',', $user_data['user_data']['organizations']);
        $data = array(
            'name' => $post_data['name'],
            'link_type' => $post_data['link_type'],
            'link' => 'media/' . $post_data['link_type'] . '/' . $file_data['file_name'],
            'file_ext' => $file_data['file_ext'],
            'file_size' => $file_data['file_size'],
            'file_type' => $file_data['file_type'],
            'organizations' => json_encode(array($user_organizations[0])),
            'date_created' => time(),
            'created_by' => $user_data['user_id']
        );
        if ($this->db->insert('media', $data)) {
            $data['id'] = $this->db->insert_id();
            return $data;
        } else {
            return false;
        }
    }

    public function search($name, $organization, $type = "") {
        //generate query
        $this->db->like('name', $name);
        $this->db->like('organizations', '"' . $organization . '"');
        if ($type != '')
            $this->db->where('link_type', $type);
        $this->db->from('media');
        
        //get built query
        $query_string = $this->db->get_compiled_select();
        
        //execute
        $query = $this->db->query($query_string);
        return $query->result_array();
    }

}
