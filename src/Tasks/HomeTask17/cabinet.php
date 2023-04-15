<?php
require_once 'functions/functions.php';
session_start();

$userId = loadSession();

if($userId) {
    $user = loadUserById($userId);
    echo "Hello ".$user['name'], " your email is " , $user['email'];
} else {
    echo "Login not successful";
}