<?php
session_start();
require_once(__DIR__ . '/../functions/functions.php');

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

//    loadSession(1);

    $userData = getUserLoginPass();
    $userId = login($userData);

    if (!$userId) {
        echo "error";
        header('Location: http://localhost:8000/src/Tasks/HomeTask17/controllers/login.php');
        return;
    }

    saveUserSession($userId);
    header('Location: http://localhost:8000/src/Tasks/HomeTask17/cabinet.php');
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<form class="form" method="post" action="login.php">
    <div class="container">
        <div class="row mt-lg-5">
            <div class="col-md-8 offset-md-2">
                <div class="form-group">
                    <input type="text" class="form-control" name="email" placeholder="E-mail / nickName"/>
                </div>
            </div>
            <div class="container">
                <div class="row mt-lg-5">
                    <div class="col-md-8 offset-md-2">
                        <div class="form-group">
                            <input type="password" class="form-control" name="password"
                                   placeholder="Enter your password"/>
                        </div>

                        <div class="text-center col-xs-12">
                            <input type="submit" class="btn btn-default" value="Submit"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</form>
</body>
</html>

