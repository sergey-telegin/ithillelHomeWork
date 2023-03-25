<?php
$i1 = 1;
$i2 = 1;
$i3 = 1;
$itemsIn10 = "";
$fof5 = 1;
$countOfOddNum = "";


//вместо "10" в условии ставим значение, диапазон которого нужно вывести на экран
while ($i1 < 10 + 1) {
    $itemsIn10 .= "\"$i1\", ";
    $i1 += 1;
}
$itemsIn10 = substr($itemsIn10, 0, -2);

echo "Между \"1\" и \"10\" мы имеем $itemsIn10 включительно." . PHP_EOL;


//вместо "5" в условии ставим значение, факториал которого нужно вывести на экран
while ($i2 <= 5) {
    $fof5 = $fof5 * $i2;
    $i2 += 1;
}

echo "Факториал \"5\" равен $fof5." . PHP_EOL;

while ($i3 <= 20 + 1) {
    if ($i3 % 2 === 0) {
        $countOfOddNum .= "\"$i3\", ";
    }
    $i3++;
}

$countOfOddNum = substr($countOfOddNum, 0, -2);

echo "Между \"1\" и \"20\" мы следующие парные числа: $countOfOddNum.";