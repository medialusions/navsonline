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
