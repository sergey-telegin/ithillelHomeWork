<?php
require_once(__DIR__ . '/../functions/functions.php');
require_once(__DIR__ . '/../functions/validator.php');

if (session_status() !== PHP_SESSION_ACTIVE) session_start();
setRegisterInform();
$errors = [];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $errors['method'][] = "'Method not allowed!'";
    setMessages($errors, 'warnings');
    header('Location: http://localhost:8000/src/Tasks/HomeTask24/registration.php');
    exit;
}

$errors = validate($_POST, [
    'name' => 'required|min_length[3]|max_length[10]',
    'email' => 'required|email|unique',
    'password' => 'required|password',
    'password_confirm' => 'required|password-confirm'
]);

if ($errors) {
    setMessages($errors);
    header('Location: http://localhost:8000/src/Tasks/HomeTask24/registration.php');
    exit;
}

$userData = getNewUserData();
saveUser($userData);


$userLogInfo = getUserData();
$userId = login($userLogInfo);

if (!$userId) {
    echo "error";
    header('Location: http://localhost:8000/src/Tasks/HomeTask24/controllers/login.php');
    return;
}
setRegisterInform();
saveUserSession($userId, $userLogInfo);
header('Location: http://localhost:8000/src/Tasks/HomeTask24/posts.php');
