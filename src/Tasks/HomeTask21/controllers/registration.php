<?php
require_once(__DIR__ . '/../functions/functions.php');
require_once(__DIR__ . '/../functions/validator.php');

if (session_status() !== PHP_SESSION_ACTIVE) session_start();
setRegisterInform();
$errors = [];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $errors['method'][] = "'Method not allowed!'";
    setMessages($errors, 'warnings');
    header('Location: http://localhost:8000/src/Tasks/HomeTask21/registration.php');
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
    setRegisterInform();
    header('Location: http://localhost:8000/src/Tasks/HomeTask21/registration.php');
    exit;
}

$userData = getNewUserData();
saveUser($userData);


$userData = getUserLoginPass();
$userId = login($userData);

if (!$userId) {
    echo "error";
    setRegisterInform();
    header('Location: http://localhost:8000/src/Tasks/HomeTask21/controllers/login.php');
    return;
}
saveUserSession($userId);
header('Location: http://localhost:8000/src/Tasks/HomeTask21/cabinet.php');
