<?php

/**
 * Copyright 2017 REVLV Solutions Inc
 * Licensed under the GNU GPLv3
 * https://www.gnu.org/licenses/gpl-3.0.en.html
 */
require_once('../../utils/index.php');

/**
 * You have given a list of words to ban make sure you
 * replace it by an asterisk. The filter should be able
 * to handle case insensitive words,
 *
 * Example
 * Fuck becomes ****
 * gay retard becomes ****
 *
 * The conversation parameter should accept array or string
 */
$chatConversation = [
    'Hello!',
    'Fuck off',
    'Whoa! there bad mouth',
    'gay retard',
];

function profanityFilter($conversation, array $filter) {
    if (is_array($conversation)) {
        foreach($conversation as &$chat) {
            $chat = str_ireplace($filter, '****', $chat);
        }

        return $conversation;
    }

    return str_ireplace($filter, '****', $conversation);
}

/**
 * Get the abbreviation of the name
 */
function abbrev($string) {
    $words = explode(' ', $string);

    $concat = '';
    foreach($words as $word) {
        $concat .= strtolower($word[0]);
    }

    return $concat;
}

/**
 * Perform tests here, don't change anything here beyond this point.
 */
$filter = ['fuck', 'gay', 'retard'];

a(
    profanityFilter($chatConversation, $filter),
    [
        'Hello!',
        '**** off',
        'Whoa! there bad mouth',
        '**** ****',
    ]
);
a(
    profanityFilter(['fUck', 'Fuck', 'fucK'], $filter),
    [
        '****',
        '****',
        '****',
    ]
);

a(
    profanityFilter('Surprise motherfucker!', $filter),
    'Surprise mother****er!'
);

a(abbrev('Foo Bar'), 'fb');
a(abbrev('Foo Bar Baz'), 'fbb');
a(abbrev('A B C'), 'abc');
