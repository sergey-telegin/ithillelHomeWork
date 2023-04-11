<?php
function setMessages(array $message, string $type = 'alerts')
{
    $_SESSION[$type] = $message;
}

function getMessages(string $type): array
{
    $messages = $_SESSION[$type] ?? [];

    return $messages;

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

