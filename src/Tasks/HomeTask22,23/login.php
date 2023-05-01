<?php
if(session_status() !== PHP_SESSION_ACTIVE) session_start();

require_once(__DIR__ . '/functions/functions.php');

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
    <title>Login</title>
</head>
<body>

<form class="form" method="post" action="controllers/login.php">
    <?php echo printMessages('warnings', 'method'); ?>
    <?php echo printMessages('alerts', 'credentials'); ?>
    <div class="container">
        <div class="row mt-lg-5">
            <div class="col-md-8 offset-md-2">
                <div class="form-group">
                    <input type="text" class="form-control" name="email" placeholder="E-mail / nickName"/>
                </div>
                <?php echo printMessages('alerts', 'email'); ?>
            </div>
            <div class="container">
                <div class="row mt-lg-5">
                    <div class="col-md-8 offset-md-2">
                        <div class="form-group">
                            <input type="password" class="form-control" name="password"
                                   placeholder="Enter your password"/>
                        </div>
                        <?php echo printMessages('alerts', 'password'); ?>
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
