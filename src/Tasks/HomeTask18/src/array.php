<?php
require_once (__DIR__.'/../functions/repository.php');


$users = [
    [
        'name' => 'User 1',
        'email' => 'User1@example.com',
        'password' => 'User1@example.com',
    ],
    [
        'name' => 'User 2',
        'email' => 'User2@example.com',
        'password' => 'User2@example.com',
    ],
    [
        'name' => 'User 3',
        'email' => 'user3@example.com',
        'password' => 'User3@example.com',
    ],
    [
        'name' => 'User 4',
        'email' => 'user4@example.com',
        'password' => 'User4@example.com',
    ],
    [
        'name' => 'User 5',
        'email' => 'user5@example.com',
        'password' => 'User5@example.com',
    ],
    [
        'name' => 'User 6',
        'email' => 'user6@example.com',
        'password' => 'User6@example.com',
    ]
];


function saveUsersFromArray($users): ?string
{

    $connectionToDB = connectToDb();
    $query = 'INSERT INTO users (name, email, password, created_at, role_id, deleted) VALUES ';

    foreach ($users as $user){
        $query .= '("' . $user['name'] . '", "' .
            $user['email'] . '", "' .
            $user['password'] . '", NOW(), 1, 0), '
            ;
    }

    $query = rtrim($query, ', ');

    try {
        $request = $connectionToDB->prepare($query);
        $request->execute();
        return null;
    } catch (PDOException $exception) {
        return "Email is exists. Type another email.";
    }
}

saveUsersFromArray($users);