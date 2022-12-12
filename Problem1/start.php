#!/usr/bin/env php
<?php 
declare(strict_types=1);

function execute(array $array, int $k): bool {

    for ($i = 0; $i < count($array); $i++) {
        $searchValue = $k - $array[$i];

        for ($j = $i; $j < count($array) - $i; $j++) {
            if ($searchValue === $array[$j]) {
                return true;
            }
        }
    }

    return false;
}


assertT(execute([1, 2, 3, 4], 5), true);
assertT(execute([10, 15, 3, 7], 17), true);
assertT(execute([10, 15, 3, 7, 9, 8, 12, 31, 45], 55), true);

assertT(execute([], 56), false);
assertT(execute([1, 2, 3, 4], 8), false);
assertT(execute([1, 2, 3, 4], 9), false);
assertT(execute([10, 15, 3, 7, 9, 8, 12, 31, 45], 56), false);


function assertT($actual, bool $expected) {
    if ($actual != $expected) {
        echo "Error" . PHP_EOL;
    } else {
        echo "Ok" . PHP_EOL;
    }
}
