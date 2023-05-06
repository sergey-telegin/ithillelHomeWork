<?php
require_once(__DIR__ . '/repository.php');
require_once(__DIR__ . '/mime.php');

function setMessages(array $message, string $type = 'alerts')
{
    $_SESSION[$type] = $message;
}

function getMessages(string $type): array
{
    $messages = $_SESSION[$type] ?? [];

    return $messages;

}


function setFormData(string $field): ?string
{
    return $_SESSION['registerFormInfo'][$field] ?? NULL;
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
    $arrayPost = getFiltredPostData();
    $registerUserData = [];
    $registerUserData['name'] = $arrayPost['name'];
    $registerUserData['email'] = $arrayPost['email'];
    $registerUserData['password'] = password_hash($_POST['password'], PASSWORD_BCRYPT);

    return $registerUserData;
}

function getUserData()
{
    $arrayPost = getFiltredPostData();
    $userData = [];
    $email = $arrayPost['email'] ?? null;
    $password = $_POST['password'] ?? null;
    $ip = $_SERVER['REMOTE_ADDR'];
    $userAgent = $_SERVER['HTTP_USER_AGENT'];


    if ($email && $password) {
        $userData = [
            'email' => $email,
            'password' => $password,
            'user_agent' => $userAgent,
            'ip' => $ip
        ];
    }
    return $userData;
}

function deleteTokenFromCookie(): void
{
    unset($_COOKIE['token']);
    setcookie("token", "", 1, "/");

}

function getFiltredPostItem(string $key): string
{
    $value = filter_var($key);
    $value = htmlspecialchars($value);
    return $value;
}

function getFiltredPostData(): array
{
    $postData = [];

    foreach ($_POST as $key => $item) {
        $postData[$key] = getFiltredPostItem($item);
    }
    return $postData;
}

function reFilterItem(string $item): string
{
    return htmlspecialchars_decode($item);
}

function reFilterArray(array $array): array
{
    $reFitredArray = [];
    foreach ($array as $key => $item) {
        $reFitredArray[$key] = reFilterItem($item);
    }
    return $reFitredArray;
}

function loadPhoto(): ?string
{

    $fileName = $_POST['author_id'] . "_" . date('m_d_Y_H:i:s');
    $defaultFilePath = $_FILES['image']['tmp_name'];
    $newImageDirectory = dirname(__DIR__) . DIRECTORY_SEPARATOR . "Images" . DIRECTORY_SEPARATOR . date("m_d_Y"). DIRECTORY_SEPARATOR;
    $fileExtension = mime2ext($_FILES['image']['type']);
    $imageNewPath = $newImageDirectory . $fileName . '.' .$fileExtension;

    if (!$fileExtension) {

        return false;
    }

    if (file_exists($newImageDirectory) || mkdir($newImageDirectory, 0777, true)) {
        rename($defaultFilePath, $imageNewPath);
        chmod($imageNewPath, 0777);
        $imageNewPath = str_replace('/var/www/html', '',$imageNewPath);
         return $imageNewPath;
    }else{
        return false;
    }
}

function logger($message, $filename = 'log.txt'): void{
    $currentDate = date('d.m.Y H:i:s');
    $userId = loadSession();
    $message = "[$currentDate][user #$userId][$message]".PHP_EOL;
    $file = fopen($filename, 'a');
    fwrite($file, $message);
    fclose($file);
}