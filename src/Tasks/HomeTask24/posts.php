<?php
require_once 'functions/functions.php';
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

$userId = loadSession();

if ($userId) {
    $user = loadUserById($userId);
} else {
    echo "Login not successful";
}

$page = (int)($_GET['page'] ?? 1);
$elementsPerPage = 3;
$elementsCount = countPosts();
$offset = ($page - 1) * $elementsPerPage;

$posts = getPosts($elementsPerPage, $offset);

$pagesCount = (int)ceil($elementsCount / $elementsPerPage);



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

<?php require_once 'templates/_header.php' ?>

<div class="container">
    <h1 class="text-center">Posts</h1>


    <div class="card-group">

        <?php if ($posts) {
            foreach ($posts as $post) {
                include 'templates/_post_card.php'
                ?>
            <?php }

        } ?>

    </div>

    <div class="d-flex justify-content-center">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <?php if ($page > 1): ?>
                    <li class="page-item"><a class="page-link" href="?page=<?= $page - 1 ?>">Previous</a></li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $pagesCount; $i++): ?>
                    <li class="page-item"><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
                <?php endfor; ?>

                <?php if ($page !== $pagesCount): ?>
                    <li class="page-item"><a class="page-link" href="?page=<?= $page + 1 ?>">Next</a></li>
                <?php endif; ?>    </ul>
        </nav>
    </div>
</div>
</body>
</html>