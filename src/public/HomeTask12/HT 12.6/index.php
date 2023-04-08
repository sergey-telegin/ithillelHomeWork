<?php
$words = [
    "123",
    "12345",
    "1234",
    "1234",
    "123",
    "12345",
    "123",
    "12345",
    "123",
    "1234"
];

function wordFilter(&$words, $length){
    $result=[];
    foreach ($words as $word){
        if (strlen($word)<$length){
            $result[]=$word;
        }
    }
    return $result;
}

$filtredWords = wordFilter($words, 5);
var_dump($filtredWords);
echo 1;