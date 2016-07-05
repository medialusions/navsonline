<?php

/**
 * 
 * @param string $date in format m/d/Y
 * @param string $time in format H:i:s
 * @param boolean $unix [optional] select return type. True for unix timestamp. False for bool
 * @return mixed
 */
function verify_date_time($date, $time, $unix = TRUE) {
    //verify length
    if (strlen($date) !== 10 || strlen($time) !== 8)
        return false;

    $date = DateTime::createFromFormat('m/d/Y H:i:s', $date . ' ' . $time);
    if ($unix)
        return $date->getTimestamp();

    return true;
}

/**
 * 
 * @param string $date in format m/d/Y
 * @param string $time in format H:i:s
 * @param boolean $unix [optional] select return type. True for unix timestamp. False for bool
 * @return mixed
 */
function verify_date($date, $unix = TRUE) {
    //verify length
    if (strlen($date) !== 10)
        return false;

    $date = DateTime::createFromFormat('m/d/Y', $date);
    if ($unix)
        return $date->getTimestamp();

    return true;
}

function format_phone($unformatted_phone_number) {
    $ph = $unformatted_phone_number;
    if (strlen($unformatted_phone_number . '') == 10) {
        return '(' . substr($ph, 0, 3) . ') ' . substr($ph, 3, 3) . '-' . substr($ph, 6, 4);
    } else {
        return 'err';
    }
}
