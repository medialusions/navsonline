<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$autoload['packages'] = array(
    APPPATH . 'third_party/community_auth/'
);

$autoload['libraries'] = array(
    'database', 'session', 'tokens', 'Authentication'
);

$autoload['drivers'] = array();

$autoload['helper'] = array(
    'url', 'serialization', 'cookie', 'role', 'organization', 'input'
);

$autoload['config'] = array(
    'db_tables', 'authentication'
);

$autoload['language'] = array();

$autoload['model'] = array(
    'auth_model'
);
