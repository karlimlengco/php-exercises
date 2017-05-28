
<?php

/**
 * Assertion
 * @param  [type] $a [description]
 * @param  [type] $b [description]
 * @return [type]    [description]
 */
function a($a, $b) {
    if ($a === $b) {
        $r =  "\033[32m✓\033[37m ";
    } else {
        $r =  "\033[31m✗\033[37m ";
    }

    if (is_array($a)) {
        $a = json_encode($a);
    }

    if (is_array($b)) {
        $b = json_encode($b);
    }

    echo sprintf("\033[1m%s\033[0m Got %s, expected %s. \n", $r, $a, $b);
}
