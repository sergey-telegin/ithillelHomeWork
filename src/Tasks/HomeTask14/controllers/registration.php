<?php
require_once(__DIR__ . '/../functions/functions.php');
require_once(__DIR__ . '/../functions/validator.php');
session_start();
$errors = [];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $errors['method'][] = "'Method not allowed!'";
    setMessages($errors, 'warnings');
    header('Location: http://localhost:8000/src/Tasks/HomeTask14/index.php');
    exit;
}

$errors = validate($_POST, [
    'name' => 'required|min_length[3]|max_length[10]',
    'email' => 'required|email',
    'password' => 'required|password',
    'password_confirm' => 'required|password-confirm'


]);

if ($errors){
    setMessages($errors);
    header('Location: http://localhost:8000/src/Tasks/HomeTask14/index.php');
}