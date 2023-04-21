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

function login($userData): int|false
{

    $data = array_filter($userData);

    $connectionToDB = connectToDb();

    $query = $connectionToDB->prepare('SELECT password, id FROM `users` WHERE email = :email');

    try {
        $query->execute(['email' => $userData['email']]);
    } catch (PDOException $e) {
        return false;
    }

    $result = $query->fetch(PDO::FETCH_ASSOC);

    if(count($result) > 1 && password_verify($userData['password'], $result['password'])) {
        return $result['id'];
    }

    return false;

}

function loadUserById($userId): array|false
{
    $connectionToDB = connectToDb();
    $request = $connectionToDB->prepare('SELECT * FROM `users` WHERE id=:user_id;');

    try {
        $request->execute(['user_id' => $userId]);
    } catch (PDOException $e){
        return false;
    }
    $result = $request->fetchAll(PDO::FETCH_ASSOC);

    return $result[0] ?? false;
}

function loadSession(): int|false
{
    $sessionId = $_COOKIE['Auth'] ?? null;
    $connectionToDB = connectToDb();
    $request = $connectionToDB->prepare('SELECT user_id FROM `user_session` WHERE uuid=:session_id;');

    try {
        $request->execute(['session_id' => $sessionId]);
    } catch (PDOException $e){
        return false;
    }
    $result = $request->fetchAll(PDO::FETCH_ASSOC);

    return $result[0]['user_id'] ?? false;
}

function saveUserSession($userID): bool
{
    $idSession = uniqid(more_entropy: true);

    setcookie('Auth', $idSession, 0, '/');

    $connectionToDB = connectToDb();
    $request = $connectionToDB->prepare('INSERT INTO `user_session` VALUES (:user_id, :session_id)');

    try {
        $request->execute(['user_id' => $userID, 'session_id' => $idSession]);
    } catch (PDOException $e){
        return false;
    }
    return true;
}