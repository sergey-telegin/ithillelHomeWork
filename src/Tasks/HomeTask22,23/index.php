<?php
if(session_status() !== PHP_SESSION_ACTIVE) session_start();

require_once(__DIR__ . '/functions/functions.php');

?>


<?php

$userId = loadSession();

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

<div class="container">
    <div class="row mt-lg-5">
        <div class="col-md-8 offset-md-2">
            <h3 class="text-center"></h3>
            <?php if(!$userId):?>
            <form class="form" action="registration.php">
                <div class="text-center col-xs-12">
                    <input type="submit" class="btn btn-default m-3" value="GO to registration"/>
                </div>
            </form>
            <form class="form m-3" action="login.php">
                <div class="text-center col-xs-12">
                    <input type="submit" class="btn btn-default" value="Login"/>
                </div>
            </form>
            <?php else:?>
            <form class="form" action="cabinet.php">
                <div class="text-center col-xs-12">
                    <input type="submit" class="btn btn-default m-3" value="GO to your Cabinet"/>
                </div>
            </form>

            <form class="form" action="controllers/logout.php">
                <div class="text-center col-xs-12">
                    <input type="submit" class="btn btn-default m-3" value="Logout"/>
                </div>
            </form>
            <?php endif;?>

            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
                    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
                    crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
                    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
                    crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
                    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
                    crossorigin="anonymous"></script>
        </div>
    </div>
</div>

</body>
</html>