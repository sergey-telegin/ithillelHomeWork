<?php
$testArray = [1, 5, 8, 11, 22, 6];

$sumArray = function (array $arr): int {
    $sum = 0;
    foreach ($arr as $num) {
        if ($num>10){
            $sum+=$num;
        }
    }
    return $sum;
};

echo $sumArray($testArray);