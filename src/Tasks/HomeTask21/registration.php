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
    <title>Document</title>
</head>
<body>

<div class="container">
    <div class="row mt-lg-5">
        <div class="col-md-8 offset-md-2">
            <?php echo printMessages('warnings', 'method'); ?>
            <h3 class="text-center">Registration form</h3>
            <form class="form" method="post" action="controllers/registration.php">
                <div class="col-xs-12">
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" placeholder="Enter your name" value="<?php echo $_SESSION['registerFormInfo']['name'] ?? NULL ?>"/>
                        <?php echo printMessages('alerts', 'name'); ?>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <input type="text" class="form-control" name="email" placeholder="E-mail"  value="<?php echo $_SESSION['registerFormInfo']['email']?? NULL ?>"/>
                        <?php echo printMessages('alerts', 'email'); ?>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Enter your password"/>
                        <?php echo printMessages('alerts', 'password'); ?>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <input type="password" class="form-control" name="password_confirm"
                               placeholder="Repeat password"/>
                        <?php echo printMessages('alerts', 'password_confirm'); ?>
                    </div>
                </div>
                <div class="text-center col-xs-12">
                    <input type="submit" class="btn btn-default" value="Submit"/>
                </div>
            </form>
            <div class="text-center col-xs-12">
                <a href="controllers/login.php">LOGIN</a>
            </div>


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