<?php
require_once(__DIR__ . '/../functions/functions.php');
require_once(__DIR__ . '/../functions/validator.php');


if(session_status() !== PHP_SESSION_ACTIVE) session_start();
$errors = [];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $errors['method'][] = "'Method not allowed!'";
    setMessages($errors, 'warnings');
    header('Location: http://localhost:8000/src/Tasks/HomeTask19/index.php');
    exit;
}

$errors = validate($_POST, [
    'name' => 'required|min_length[3]|max_length[10]',
    'email' => 'required|email|unique',
    'password' => 'required|password',
    'password_confirm' => 'required|password-confirm'
]);

if ($errors){
    setMessages($errors);
    header('Location: http://localhost:8000/src/Tasks/HomeTask19/index.php');
    exit;
}

$userData = getNewUserData();
saveUser($userData);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

//    loadSession(1);

    $userData = getUserLoginHPass();
    $userId = login($userData);

    if (!$userId) {
        echo "error";
        header('Location: http://localhost:8000/src/Tasks/HomeTask17/controllers/login.php');
        return;
    }

    saveUserSession($userId);
    header('Location: http://localhost:8000/src/Tasks/HomeTask17/cabinet.php');
}