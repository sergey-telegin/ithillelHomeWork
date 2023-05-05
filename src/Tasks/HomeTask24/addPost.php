<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

require_once(__DIR__ . '/functions/functions.php');

$userId = loadSession();

if (!$userId) {
    header('Location: http://localhost:8000/src/Tasks/HomeTask24/index.php');
}
$users = getAllUsers();

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
            <h3 class="text-center">Add new Post</h3>
            <form class="form" method="post" action="controllers/addPost.php" enctype="multipart/form-data">
                <div class="col-xs-12">
                    <div class="form-group">
                        <input type="text" class="form-control" name="title" placeholder="Title is here..."
                               value="<?php echo setFormData('title') ?>"/>
                                                <?php echo printMessages('alerts', 'title'); ?>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" name="text" placeholder="Content is here" id="floatingTextarea"
                                  rows="4"><?php echo setFormData('text') ?></textarea>
                        <?php echo printMessages('alerts', 'text'); ?>
                        <!--                        <label for="floatingTextarea">Comments</label>-->
                    </div>

                    <div class="mb-3">
                        <!--                    <label for="formFile" class="form-label"></label>-->
                        <input class="form-control" name="image" type="file" id="formFile">
                    </div>

                        <div class="form-group">
                            <?php if ($users) : ?>
                                <select class="form-control" name="author_id">
                                <?php foreach ($users as $user) : ?>
                                    <option value="<?= $user['id'] ?>"><?= $user['name'] ?> </option>
                                <?php endforeach; ?>
                                </select>
                            <?php endif; ?>
                        </div>

                    <div class="text-center col-xs-12">
                        <input type="submit" class="btn btn-default" value="Submit"/>
                    </div>
            </form>


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