<?php

/**
 * Takes string or array of strings in format
 * 'lead-guitar' and turns them into display
 * names like 'Lead Guitar'
 * @param mixed $args String or array of strings
 * @param boolean $array select whether to return as array forcefully.
 * @return mixed Array or single formatted roles
 */
function slug_to_proper($args, $array = FALSE) {
    $roles = $args;
    if (!is_array($args))
        $roles = array($args);

    $toRet = array();
    $index = 0;
    foreach ($roles as $role) {
        $words = explode('-', $role);
        $current = '';
        foreach ($words as $word)
            $current .= ucfirst($word) . ' ';
        $toRet[$index] = trim($current);
        $index++;
    }

    if (count($toRet) === 1 && !$array)
        return $toRet[0];

    return $toRet;
}

function slugify($text) {
    // replace non letter or digits by -
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);

    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    // trim
    $text = trim($text, '-');

    // remove duplicate -
    $text = preg_replace('~-+~', '-', $text);

    // lowercase
    $text = strtolower($text);

    if (empty($text)) {
        return 'n-a';
    }

    return $text;
}

/**
 * Returns roles in proper form whether in an array or a comma separated string
 * @param String $json_matrix Json encoded array.
 * @param Varchar $user_id Unique user id for indexing out from the Json array.
 * @param Boolean $array Whether to return as an array or as a comma separated string.
 * @return Mixed Either a comma separated string or an array.
 */
function list_roles($json_matrix, $user_id, $array = FALSE) {
    $arr = matrix_decode($json_matrix, $user_id);
    if (!$arr) {
        if ($array)
            return array('N/A');
        else
            return 'N/A';
    }

    $prop = slug_to_proper($arr, TRUE);
    if ($array)
        return $prop;

    return implode(', ', $prop);
}

/**
 * Helper function for finding arrays or values for json encoded arrays.
 * @param String $json_matrix Is json encoded array.
 * @param String $index For selecting the first associative key.
 * @param String $second_index In case is multi-dimensional, finds secondary value or array.
 * @return Mixed Returns either an array or a value assuming the indexes where correctly specified.
 */
function matrix_decode($json_matrix, $index = '', $second_index = '') {
    $arr = json_decode($json_matrix, TRUE);

    if ($index == '')
        return $arr;

    //search for first
    if (key_exists($index, $arr))
        $current = $arr[$index];
    else
        return FALSE;

    //if second index, search
    if ($second_index == '')
        return $current;
    else {
        if (key_exists($second_index, $current))
            return $current[$second_index];
        else
            return FALSE;
    }
}

/**
 * Gets the unique artists for this organization
 */
function get_roles() {
    // Get a reference to the controller object
    $CI = get_instance();
    // You may need to load the model if it hasn't been pre-loaded
    $CI->load->model('event_model');
    $roles = $CI->event_model->get_roles();
    if (!$roles) {
        //failure
        return '';
    } else {
        $ind_roles = array();
        foreach ($roles as $roles_matrix) {
            $arr = json_decode($roles_matrix['roles_matrix'], TRUE);
            $no_keys = array_values($arr);
            foreach ($no_keys as $u) {
                foreach ($u as $role) {
                    if (array_search($role, $ind_roles) === FALSE) {
                        array_push($ind_roles, $role);
                    }
                }
            }
        }
        $html = "";
        foreach ($ind_roles as $ind_role) {
            $html .= '<div class="item" data-value="' . slug_to_proper($ind_role) . '">' . slug_to_proper($ind_role) . '</div>';
        }
        return $html;
    }
}

function auth_role($auth_level, $slug = FALSE) {
    if ($slug)
        return auth_role_slug($auth_level);

    if ($auth_level >= 10) {
        return 'Super Admin';
    } else if ($auth_level >= 9) {
        return 'Admin';
    } else if ($auth_level >= 5) {
        return 'Viewer';
    } else if ($auth_level >= 2) {
        return 'Archived';
    } else if ($auth_level >= 1) {
        return 'Denied';
    }
}

function auth_role_slug($auth_role) {
    switch ($auth_role) {
        case 10:
            return "s_admin";
        case 9:
            return "admin";
        case 5:
            return "viewer";
        case 2:
            return "archived";
        case 1:
            return "denied";
        default:
            return FALSE;
    }
}

function auth_level($auth_role) {
    $arr = array(
        "s_admin" => 10,
        "admin" => 9,
        "viewer" => 5,
        "archived" => 2,
        "denied" => 1
    );
    if (array_key_exists($auth_role, $arr))
        return $arr[$auth_role];
    else
        return FALSE;
}
