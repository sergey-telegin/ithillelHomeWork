<?php
function debug ($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
    echo "<br>";
    die();
}