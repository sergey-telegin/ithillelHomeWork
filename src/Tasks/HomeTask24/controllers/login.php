<?php
require_once(__DIR__ . '/../functions/functions.php');
require_once(__DIR__ . '/../functions/validator.php');

if (session_status() !== PHP_SESSION_ACTIVE) session_start();

$errors = [];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $errors['method'][] = "'Method not allowed!'";
    setMessages($errors, 'warnings');
    exit;
}

$errors = validate($_POST, [
    'email' => 'required|email',
    'password' => 'required|password',
]);


$userLogInfo = getUserData();

$userId = login($userLogInfo);



if (!$userId) {
    $errors['credentials'][] = "'Insert correct login and password!'";
} else {
    saveUserSession($userId, $userLogInfo);
}

header('Location: http://localhost:8000/src/Tasks/HomeTask24/posts.php');

if ($errors) {
    setMessages($errors);
    header('Location: http://localhost:8000/src/Tasks/HomeTask24/login.php');
    exit;
}
?>
