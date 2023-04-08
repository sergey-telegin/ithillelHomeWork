<?php

$array = [3, 4, 5, 3, 4];

$evenNum = function (int $num): bool {
    $result = $num % 2 === 0;
    return $result;
};

function workWithNums(array $arr, callable $callback): array
{
    $newArray = [];
    {
        foreach ($arr as $num) {
            if ($callback($num)) {
                $newArray[] = $num;
            }
        }
    }
    return $newArray;
}

var_dump(workWithNums($array, $evenNum));