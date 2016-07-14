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

/**
 * Input 10 digit int and returns formatted phone number like (303) 555-5555
 * @param int $unformatted_phone_number
 * @return string Formatted phone number
 */
function format_phone($unformatted_phone_number) {
    $ph = $unformatted_phone_number;
    if (strlen($unformatted_phone_number . '') == 10) {
        return '(' . substr($ph, 0, 3) . ') ' . substr($ph, 3, 3) . '-' . substr($ph, 6, 4);
    } else {
        return 'err';
    }
}

/**
 * Trims and sets the value of the object passed.
 * @param String $value
 */
function trim_value(&$value) {
    $value = trim($value);
}

/**
 * Gets the unique artists for this organization
 */
function get_artists() {
    // Get a reference to the controller object
    $CI = get_instance();
    // You may need to load the model if it hasn't been pre-loaded
    $CI->load->model('arrangement_model');

    $rows = $CI->arrangement_model->get_unique();
    $html = "";
    foreach ($rows as $row) {
        $html .= '<div class="item" data-value="' . $row['artist'] . '">' . $row['artist'] . '</div>';
    }
    return $html;
}

/**
 * Gets the unique tags
 */
function get_tags() {
    // Get a reference to the controller object
    $CI = get_instance();
    // You may need to load the model if it hasn't been pre-loaded
    $CI->load->model('song_model');

    $all_songs = $CI->song_model->get();
    $tags = array();
    foreach ($all_songs as $song) {
        $song_tags = json_decode($song['tags'], TRUE);
        foreach ($song_tags as $tag) {
            array_push($tags, $tag);
        }
    }
    $unique_tags = array_unique($tags);
    sort($unique_tags);
    $html = "";
    foreach ($unique_tags as $tag) {
        $html .= '<div class="item" data-value="' . $tag . '">' . $tag . '</div>';
    }
    return $html;
}
