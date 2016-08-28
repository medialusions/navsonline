<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Community Auth - Validation_callables Model
 *
 * Community Auth is an open source authentication application for CodeIgniter 3
 *
 * @package     Community Auth
 * @author      Robert B Gottier
 * @copyright   Copyright (c) 2011 - 2016, Robert B Gottier. (http://brianswebdesign.com/)
 * @license     BSD - http://www.opensource.org/licenses/BSD-3-Clause
 * @link        http://community-auth.com
 */
class Validation_callables extends MY_Model {

    /**
     * Check the supplied password strength
     * @TODO add third party validator
     * 
     * @param   string  the supplied password 
     * @return  mixed   bool
     */
    public function _check_password_strength($password) {
        return TRUE;
    }

    // --------------------------------------------------------------
}

/* End of file Validaton_callables.php */
/* Location: /community_auth/models/Validation_callables.php */