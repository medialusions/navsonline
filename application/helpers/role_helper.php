<?php

/**
 * Takes string or array of strings in format
 * 'lead-guitar' and turns them into display
 * names like 'Lead Guitar'
 * @param mixed $args String or array of strings
 * @return mixed Array or single formatted roles
 */
function slug_to_proper($args) {
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

    if (count($toRet) === 1)
        return $toRet[0];

    return $toRet;
}
