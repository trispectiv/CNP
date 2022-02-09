<?php

function generate_random_valid_cnp() {
    $cnp = rand(1, 9) . sprintf('%02d', rand(1, 99)) . sprintf('%02d', rand(1, 12)) . sprintf('%02d', rand(1, 28)) . sprintf('%02d', rand(1, 52)) . sprintf('%03d', rand(1, 999));
    $control = '279146358279';
    $hash = 0;
    for ($i=0; $i<12; $i++) {
        $hash += $cnp[$i] * $control[$i];
    }
    $reminder = $hash % 11;
    $cnp .= ($reminder == 10 ? 1 : $reminder);
    return $cnp;
}

echo generate_random_valid_cnp() . "\n";

?>