<?php

/**
 * Copyright 2017 REVLV Solutions Inc
 * Licensed under the GNU GPLv3
 * https://www.gnu.org/licenses/gpl-3.0.en.html
 */
require_once('../../utils/index.php');

/**
 * Converts the case of passed string
 * abc turns to ABC
 * aBc turns to AbC
 */
function swapCase($string) {
    $convertedCase = '';
    for($x = 0; $x < strlen($string); $x++) {
        if (ctype_lower($string[$x])) {
            $convertedCase .= strtoupper($string[$x]);
            continue;
        }

        $convertedCase .= strtolower($string[$x]);
    }

    return $convertedCase;
}

/**
 * Camelize the string
 * a_b_c turns to aBC
 * get_user_info turns to getUserInfo
 */
function camelize($string) {
    $words = explode('_', $string);

    $camelizedString = '';
    foreach($words as $index => $word) {
        if (!$index) {
            $camelizedString .= strtolower($word);
            continue;
        }

        $camelizedString .= ucwords(strtolower($word));
    }

    return $camelizedString;
}

/**
 * Chunk the string to array
 * 'Hello world!' with a limit set to 2 will return
 * all spaces should be trimmed
 *
 * ['he', 'll', 'ow', 'or', 'ld', '!']
 */
function chunk($string, $limit = 2) {
    $string = str_replace(' ', '', $string);

    return str_split($string, $limit);
}

/**
 * Alphabetize the passed string
 * Hello World -> HWdellloor
 */
function alphabetize($string) {
    $chars = array_map('trim', str_split($string));

    asort($chars);

    return implode('', $chars);
}

/**
 * Count the word on the string
 *
 *  String:
 *      bb aa bb aa bb aa
 *  Parameter
 *      word: bb
 *  Return
 *      3
 */
function count_word($string, $word) {
    return substr_count($string, $word);
}

/**
 * Perform tests here, don't change anything here beyond this point.
 */
a(swapCase('aaBBcc'), 'AAbbCC');
a(swapCase('abc'), 'ABC');
a(swapCase('AAbbCC'), 'aaBBcc');
a(swapCase('aBcDeFgH'), 'AbCdEfGh');
a(swapCase('AAbb1CC'), 'aaBB1cc');

a(camelize('hello_world'), 'helloWorld');
a(camelize('Pewdiepie'), 'pewdiepie');
a(camelize('hallo_hallo_'), 'halloHallo');
a(camelize('foo_bar'), 'fooBar');
a(camelize('hello_WORLD'), 'helloWorld');

a(chunk('Hello World!'), ['He', 'll', 'oW', 'or', 'ld', '!']);
a(chunk('Hello World!', 3), ['Hel', 'loW', 'orl', 'd!']);

a(alphabetize('Hello World'), 'HWdellloor');
a(alphabetize('Beat down baby boy'), 'Baabbbdenootwyy');
a(alphabetize('4chan.org'), '.4acghnor');

a(count_word('bb aa bb aa', 'aa'), 2);
a(count_word('baabaa blaackship haave.', 'aa'), 4);
a(count_word('bAabaa blaackship haave.', 'aa'), 3);

