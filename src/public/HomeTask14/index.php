<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="css/bootstrap.rtl.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1zt
    cQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 well">
            <h3 class="text-center">Registration form</h3>
            <form class="form" method="post" action="controllers/registration.php">
                <div class="col-xs-12">
                    <div class="form-group">
                        <input type="text" class="form-control" name="name"  placeholder="Enter your name" />
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="E-mail" value="123@123.com"/>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <input type="password" class="form-control" name="pass" placeholder="Enter your password"
                               value="123@123.com"/>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <input type="password" class="form-control" name="pass_confirm" placeholder="Repeat password"
                               value="123@123.com"/>
                    </div>
                </div>
                <div class="text-center col-xs-12">
                    <input type="submit" class="btn btn-default" value="Submit" />
                </div>
            </form>


<script src="js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>