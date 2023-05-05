<?php
require_once(__DIR__ . '/../functions/functions.php');
require_once(__DIR__ . '/../functions/repository.php');
$token = $_COOKIE['token'];

deleteSessionFromDb($token);

if ($_COOKIE['token']) {
    deleteTokenFromCookie();
}

header('Location: http://localhost:8000/src/Tasks/HomeTask24/login.php');

