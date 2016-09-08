<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function open_doors() {
        $this->communication->open_doors();
    }
    
    public function database_backup() {
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
