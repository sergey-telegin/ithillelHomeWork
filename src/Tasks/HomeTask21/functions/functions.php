<?php
require_once(__DIR__ . '/repository.php');
function setMessages(array $message, string $type = 'alerts')
{
    $_SESSION[$type] = $message;
}

function getMessages(string $type): array
{
    $messages = $_SESSION[$type] ?? [];

    return $messages;

}

function setRegisterInform()
{
    $_SESSION['registerFormInfo']['name'] = $_POST['name'];
    $_SESSION['registerFormInfo']['email'] = $_POST['email'];
}

function printMessages($type, $field)
{
    if (existsMessages($type)) {
        foreach (getMessages($type) as $key => $messages) {
            if ($key === $field) {
                foreach ($messages as $message) {
                    echo '<div class="alert alert-danger" role="alert">' . $message . '</div>';
                }
                unset($_SESSION[$type][$key]);
            }
        }
    }
    //unset($_SESSION[$type]);
}

function existsMessages(string $type): bool
{
    return isset($_SESSION[$type]);
}


function getNewUserData()
{
    $registerUserData = [];
    $registerUserData['name'] = $_POST['name'];
    $registerUserData['email'] = $_POST['email'];
    $registerUserData['password'] = password_hash($_POST['password'], PASSWORD_BCRYPT);

    return $registerUserData;
}

function getUserLoginPass()
{
    $userData = [];
    $name = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;

    if ($name && $password) {
        $userData = [
            'email' => $name,
            'password' => $password
        ];
    }
    return $userData;
}