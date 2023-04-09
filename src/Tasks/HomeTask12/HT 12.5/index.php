<?php
//сделал две версии кода, т.к. не понимаю смысла передачи множителя по ссылке.
//здесь передаю множитель по ссылке как и указано в задаче
$nums = [1, 2, 4];
$multi = 5;
$product = fn ($num, &$multi) => $num * $multi;

function productArray($array, $function, &$multi)
{
    $result = [];
    foreach ($array as $num) {
        $result [] = $function($num, $multi);
    }
    return $result;
}

var_dump(productArray($nums, $product, $multi));

echo PHP_EOL;

//здесь передаю по ссылке массив, тогда будет изменён оригинальный массив
$numsRef2 = [1, 2, 4];
$multi2 = 3;
$product2 = fn ($num, &$multi) => $num * $multi;

function productArray2(&$array2, $function2, $multi2)
{
    foreach ($array2 as &$num2) {
        $num2 = $function2($num2, $multi2);
    }
}

productArray2($numsRef2, $product2, $multi2);

var_dump($numsRef2);



