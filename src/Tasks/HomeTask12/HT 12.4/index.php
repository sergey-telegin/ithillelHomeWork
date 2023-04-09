<?php

$animals = ['lion', 'tiger', 'elephant', 'giraffe', 'monkey'];

$ucWord = fn($word) => ucfirst($word);

function ucArray ($array, $ucWord){
    return array_map($ucWord, $array);
}

print_r(ucArray($animals, $ucWord));