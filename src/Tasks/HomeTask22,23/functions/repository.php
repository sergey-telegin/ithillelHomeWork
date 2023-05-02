<?php
require_once(__DIR__ . '/functions.php');
function connectToDb(): PDO
{
    $host = "db";
    $dbname = "test";
    $username = "user";
    $password = "1";

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        //echo "Connected to $dbname at $host successfully.";
    } catch (PDOException $pe) {
        die("Could not connect to the database $dbname :" . $pe->getMessage());
    }
    return $conn;
}

function saveUser($registerUserData): ?string
{

    $connectionToDB = connectToDb();

    $name = $registerUserData['name'];
    $email = $registerUserData['email'];
    $password = $registerUserData['password'];


    try {
        $request = $connectionToDB->prepare(
            'INSERT INTO users (name, email, password, created_at, role_id) VALUES (:name, :email, :password, NOW(), 1);'
        );
        $request->execute(
            ['name' => $name, 'email' => $email, 'password' => $password]
        );
        return null;
    } catch (PDOException $exception) {
        return "$email is exists. Type another email.";
    }
}

function login($userLogInfo): int|false
{

    $data = array_filter($userLogInfo);

    $connectionToDB = connectToDb();

    $query = $connectionToDB->prepare('SELECT password, id FROM `users` WHERE email = :email');

    try {
        $query->execute(['email' => $userLogInfo['email']]);
    } catch (PDOException $e) {
        return false;
    }

    $result = $query->fetch(PDO::FETCH_ASSOC);

    if (!$result) {
        return false;
    }
    return $result['id'];
}

function loadUserById($userId): array|false
{
    $connectionToDB = connectToDb();
    $request = $connectionToDB->prepare('SELECT * FROM `users` WHERE id=:user_id;');

    try {
        $request->execute(['user_id' => $userId]);
    } catch (PDOException $e) {
        return false;
    }
    $result = $request->fetchAll(PDO::FETCH_ASSOC);

    return reFilterArray($result[0]) ?? false;
}

function loadSession(): int|false
{
    $token = $_COOKIE['token'] ?? null;

    $connectionToDB = connectToDb();
    $request = $connectionToDB->prepare('SELECT user_id FROM `user_session` WHERE token=:token;');

    try {
        $request->execute(['token' => $token]);
    } catch (PDOException $e) {
        return false;
    }
    $result = $request->fetchAll(PDO::FETCH_ASSOC);

    return $result[0]['user_id'] ?? false;
}

function saveUserSession($userId, $userLogInfo): bool
{
    $token = uniqid(more_entropy: true);

    $connectionToDB = connectToDb();
    $query = $connectionToDB->prepare('INSERT INTO `user_session` VALUES (:user_id, :token, :user_agent, :ip, NOW())');

    try {
        $query->execute(
            ['user_id' => $userId, 'token' => $token, 'user_agent' => $userLogInfo['user_agent'], 'ip' => $userLogInfo['ip']]

        );
        return true;
    } catch (PDOException $e) {
        return false;
    }

}

function deleteSessionFromDb($token): bool
{

    $connectionToDB = connectToDb();
    $query = $connectionToDB->prepare('DELETE FROM `user_session` WHERE `token` = :token');

    try {
        $query->execute(['token' => $token]);
        return true;
    } catch (PDOException $exception) {
        return false;
    }
}