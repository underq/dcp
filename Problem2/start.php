#!/usr/bin/env php
<?php 
declare(strict_types=1);

function execute(array $array): array {
    $result = [];

    for ($i = 0; $i < count($array); $i++) {
        $tmp = $array;
        unset($tmp[$i]);
        $result[$i] = product($tmp);
    }

    return $result;
}

function product(array $array): int {
    $result = 1;
    foreach($array as $value) {
        $result = $result * $value;
    }

    return $result;
}

assert(execute([]) === []);
assert(execute([2, 1, 3]) === [3, 6, 2]);
assert(execute([1, 2, 3, 4, 5]) === [120, 60, 40, 30, 24]);
assert(execute([1, 2, 3, 4, 5, 6, 7, 8, 0]) === [0, 0, 0, 0, 0, 0, 0, 0, 40320]);