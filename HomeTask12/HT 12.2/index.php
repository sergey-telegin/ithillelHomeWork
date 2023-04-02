<?php
//вариант, когда функция принимает два числа в качестве аргументов.

$arrowFunction = fn($a, $b)=>$a - $b;
echo $arrowFunction(10, 5);


echo PHP_EOL;

//или вариант, когда 2 числа уже есть в окружении.
$a = 5;
$b = 10;

$arrowFunction = fn()=>$a - $b;

echo $arrowFunction();