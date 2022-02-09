<?php

function isCnpValid(string $value): bool {
    // CNP must be digits only and exactly 13 digits long
    if (($value != intval($value)) || (strlen($value) != 13)) {
        return false;
    }
    // CNP format S AA LL ZZ JJ NNN C
    // Collect the fields and pass them through intval just to be safe, even if they prooved to be digits :)
    $born = intval($value[0]);
    $year = intval(substr($value, 1, 2));
    $month = intval(substr($value, 3, 2));
    $day = intval(substr($value, 5, 2));
    $county = intval(substr($value, 7, 2));
    $checksum = intval($value[12]);
    // LL month validation
    // Month is two digits but it also must be in [1..12] range
    if (($month < 1) || ($month > 12)) {
        return false;
    }
    // ZZ day validation
    // Day is two digits but is also must be valid for days in month
    if (in_array($born, [1, 2])) {
        $year += 1900;
    }
    elseif (in_array($born, [3, 4])) {
        $year += 1800;
    }
    elseif (in_array($born, [5, 6])) {
        $year += 2000;
    }
    else {
        $year += 1900;
    }
    if (($day < 1) || ($day > cal_days_in_month(0, $month, $year))) {
        return false;
    }
    // JJ county validation
    // JJ is two digits, but it also must be in [1..52] range
    if (($county < 1) || ($county > 52)) {
        return false;
    }
    // C checksum validation
    // Last 13th digit is a checksum for validation of the other 12 digits
    $control = '279146358279';
    $hash = 0;
    for ($i=0; $i<12; $i++) {
        $hash += $value[$i] * $control[$i];
    }
    $reminder = $hash % 11;
    if ($reminder == 10) {
        $reminder = 1;
    }
    if ($checksum != $reminder) {
        return false;
    }
    // Looks like our CNP is valid! Yey!
    return true;
}

?>