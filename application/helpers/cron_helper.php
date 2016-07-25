<?php

/**
 * @param string $command
 * @return boolean success
 */
function cronjob_exists($command) {

    $cronjob_exists = false;

    exec('crontab -l', $crontab);


    if (isset($crontab) && is_array($crontab)) {

        $crontab = array_flip($crontab);

        if (isset($crontab[$command])) {

            $cronjob_exists = true;
        }
    }
    return $cronjob_exists;
}

/**
 * @param string $command
 * @return string result
 */
function append_cronjob($command) {

    if (is_string($command) && !empty($command) && cronjob_exists($command) === FALSE) {

        //add job to crontab
        exec('echo -e "`crontab -l`\n' . $command . '" | crontab -', $output);
    }

    return $output;
}

//remove
//exec('crontab -r', $crontab);
