<?php

function extract_organization($organizations, $index = 0) {
    $arr = explode(',', $organizations);
    return $arr[$index];
}
