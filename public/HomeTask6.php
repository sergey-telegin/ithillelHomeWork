<?php
$array = [];

for ($i=0; $i <= 30-1; $i++){
    $array[]=rand(1, 50);
}

echo count($array);
$sumOfNum = NULL;
$productOfNum = 1;
$countOfNumFive = NULL;
$countOfNumDividendBy3 = NULL;
$min = PHP_INT_MAX;
$max = PHP_INT_MIN;

foreach ($array as $num){
    $sumOfNum += $num;

    $productOfNum *= $num;

    if($num === 5){
        $countOfNumFive +=1;
    }

    if($num % 3 == 0){
        $countOfNumDividendBy3 +=1;
    }

    if($num < $min) {
        $min = $num;
    }

    if($num > $max) {
        $max = $num;
    }


}


echo "Сумма значений всех элементов массива равна $sumOfNum.".PHP_EOL;
echo "Произведение значений всех элементов массива равно $productOfNum.".PHP_EOL;
echo "В массиве $countOfNumFive элемент(-а,-ов), значениие которых равно \"5\".".PHP_EOL;
echo "В массиве $countOfNumDividendBy3 элемент(-а,-ов), значениие которых без остатка делятся на \"3\".".PHP_EOL;
echo "Минимальное значение массива равно $min, максимальное равно $max.";

echo count($array);