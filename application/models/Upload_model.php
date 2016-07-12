<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Upload_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'doc|docx|pdf|mp3|mp4|aif|aifc|aiff|wav';
        $config['encrypt_name'] = TRUE;
        $this->upload->initialize($config);
    }

}
