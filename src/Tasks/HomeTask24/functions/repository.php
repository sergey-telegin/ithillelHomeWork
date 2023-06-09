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
    setcookie('token', $token, time()+60*60*24*30, '/');

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

function getAllUsers(): array
{
    $connectionToDb = connectToDb();
    $query = "SELECT `id`, `name` FROM `users`";
    $stmt = $connectionToDb->prepare($query);

    try {
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $exception) {
        return false;
    }
}


function savePost($post): ?string
{

    $connectionToDB = connectToDb();

    $title = $post['title'];
    $text = $post['text'];
    $author_id = $post['author_id'];
    $image=$post['image'];


    try {
        $request = $connectionToDB->prepare(
            'INSERT INTO `posts` (title, text, author_id, created_at, image) VALUES (:title, :text, :author_id, NOW(), :image);'
        );
        $request->execute(
            ['title' => $title, 'text' => $text, 'author_id' => $author_id, 'image' => $image]
        );
        return $connectionToDB->lastInsertId();
    } catch (PDOException $exception) {
        return false;
    }
}

function getPosts($elementsPerPage = false, $offset = false): array
{
    $connectionToDb = connectToDb();
    $query = "SELECT * FROM `posts`";
    if($elementsPerPage!==false && $offset !== false){
        $query.= "LIMIT $offset, $elementsPerPage";
    }

    $stmt = $connectionToDb->prepare($query);

    try {
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $exception) {
        return false;
    }
}

function countPosts(): int
{
    $connectionToDb = connectToDb();
    $query = "SELECT count('id') as counter FROM `posts`";
    $stmt = $connectionToDb->prepare($query);

    try {
        $stmt->execute();
        return $stmt->fetchColumn();
    } catch (PDOException $exception) {
        return false;
    }
}