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

/**
 * Returns roles in proper form whether in an array or a comma separated string
 * @param String $json_matrix Json encoded array.
 * @param Varchar $user_id Unique user id for indexing out from the Json array.
 * @param Boolean $array Whether to return as an array or as a comma separated string.
 * @return Mixed Either a comma separated string or an array.
 */
function list_roles($json_matrix, $user_id, $array = FALSE) {
    $arr = matrix_decode($json_matrix, $user_id);
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

    $current = $arr[$index];

    if ($second_index == '')
        return $current;
    else
        return $current[$second_index];
}
