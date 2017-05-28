<?php

/**
 * Copyright 2017 REVLV Solutions Inc
 * Licensed under the GNU GPLv3
 * https://www.gnu.org/licenses/gpl-3.0.en.html
 */
require_once('../../utils/index.php');

/**
 * Word count
 *
 * Input:
 *     words: ab, aabbaa, bbb, ccdeeff, ba
 *     length: 2
 *
 * Results:
 *     2
 */
function word_count(array $words, $length) {
    $count = [];
    foreach($words as $word) {
        if (strlen($word) === $length) {
            $count[] = $word;
        }
    }

    return count($count);
}

/**
 * Flatten an array
 *
 * Input:
 *     1, [1, 2], [3, 2]
 * Results
 *     1, 1, 2, 3, 2
 */
function flatten(array $array) {
    $flat = [];
    foreach($array as $entry) {
        if (is_array($entry)) {
            $flat = array_merge($flat, $entry);
            continue;
        }

        $flat[] = $entry;
    }

    return $flat;
}

/**
 * Combines the two array forming  new set of unique arrays
 *
 * Input:
 *     1, [2, 1], [3, 1]
 * Results
 *     1, 2, 3
 */
function union(array $x, array $y) {
    $flattenX = flatten($x);
    $flattenY = flatten($y);

    // Array values reindex the array to 0, 1, 2..
    // Array unique removes duplicated array values
    return array_values(array_unique(array_merge($flattenX, $flattenY)));
}

/**
 * Filters the content of array by callable function
 *
 * Input:
 *     collection: [
 *         ['name' => 'Sven', 'age' => 13],
 *         ['name' => 'Troll Warlord', 'age' => 14],
 *         ['name' => 'Skeleton King', 'age' => 21],
 *         ['name' => 'Tinker', 'age' => 18],
 *     ],
 *
 *     callable: function: age >= 18
 *
 *  Example:
 *
 *      filter($collection, function($hero) {
 *          return $hero['age'] >= 18;
 *      })
 */
function filterBy(array $collection, Callable $callable) {
    $items = [];
    foreach($collection as $item) {
        if ($callable($item)) {
            $items[] = $item;
        }
    }

    return $items;
}

/**
 * Merge the two array in sorted order
 *
 * Input:
 *     x: aa, xx, zz
 *     y: bb, cc
 *
 * Results:
 *     aa, bb, cc, xx, zz
 */
function linear_merge(array $x, array $y) {
    $results = [];

    while (count($x) && count($y)) {
        if ($x[0] < $y[0]) {
            // var_dump($x[0] < $y[0]);
            $results[] = array_shift($x);
        } else {
            $results[] = array_shift($y);
        }
    }

    $results = array_merge($results, $x);
    $results = array_merge($results, $y);

    return $results;
}

/**
 * Perform tests here, don't change anything here beyond this point.
 */
a(word_count(['ab', 'aabbaa', 'bbb', 'ccdeeff', 'ba'], 2), 2);
a(word_count(['', 'ba', 'd', 'e', 'hello'], 2), 1);

a(flatten([1, [2, 1], [1, 1], 3]), [1, 2, 1, 1, 1, 3]);
a(flatten([1, [], 3, 5]), [1, 3, 5]);
a(flatten([1, [], [5, 6, 7], [], []]), [1, 5, 6, 7]);

a(union([1], [[2, 1], [3, 1]]), [1, 2, 3]);
a(union([1], [2, 3, 5, 5, 5, 5, 1]), [1, 2, 3, 5]);
a(union([1, [2, 3], [3, 5]], [[2, 1], [3, 1]]), [1, 2, 3, 5]);

a(
    filterBy(
        [
            ['name' => 'Sven', 'age' => 13],
            ['name' => 'Troll Warlord', 'age' => 14],
            ['name' => 'Skeleton King', 'age' => 21],
            ['name' => 'Tinker', 'age' => 18],
        ],
        function ($o) {
            return $o['age'] >= 18;
        }
    ),
    [['name' => 'Skeleton King', 'age' => 21], ['name' => 'Tinker', 'age' => 18]]
);

a(
    filterBy(
        [
            ['name' => 'Sven', 'age' => 13],
            ['name' => 'Troll Warlord', 'age' => 14],
            ['name' => 'Skeleton King', 'age' => 21],
            ['name' => 'Tinker', 'age' => 18],
        ],
        function ($o) {
            return strpos($o['name'], 'S') === 0;
        }
    ),
    [['name' => 'Sven', 'age' => 13], ['name' => 'Skeleton King', 'age' => 21]]
);

a(
    linear_merge(['aa', 'xx', 'zz'], ['bb', 'cc']),
    ['aa', 'bb', 'cc', 'xx', 'zz']
);
a(
    linear_merge(['aa', 'xx'], ['bb', 'cc', 'zz']),
    ['aa', 'bb', 'cc', 'xx', 'zz']
);
a(
    linear_merge(['aa', 'aa'], ['aa', 'bb', 'bb']),
    ['aa', 'aa', 'aa', 'bb', 'bb']
);
