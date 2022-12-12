#!/usr/bin/env php
<?php 
declare(strict_types=1);

function execute(array $array, int $k): bool {

    $searchValues = [];

    for ($i = 0; $i < count($array); $i++) {
        $searchValue = (int) $k - $array[$i];
        if (array_key_exists($searchValue, $searchValues)) {
            return true;
        }
        $searchValues[$array[$i]] = null;
    }

    return false;
}


assert(execute([1, 2, 3, 4], 5) === true);
assert(execute([10, 15, 3, 7], 17) === true);
assert(execute([10, 15, 3, 7, 9, 8, 12, 31, 45], 55) === true);

assert(execute([], 56) === false);
assert(execute([1, 2, 3, 4], 2) === false);
assert(execute([1, 2, 3, 4], 8) === false);
assert(execute([1, 2, 3, 4], 9) === false);
assert(execute([10, 15, 3, 7, 9, 8, 12, 31, 45], 56) === false);
