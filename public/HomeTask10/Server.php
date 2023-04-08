<?php

require_once('Mime.php');
require_once('Functions.php');

$worker = moveDatafromPostTo();

$fileSource = $_FILES['photo'];
$num = 0;
$pathOfPhotoNew1 = workWithFiles($fileSource, $num);
$fileSourceMulti = $_FILES['multiphoto'];
$fileSourceMulti = arrayToOtherArray($fileSourceMulti);

foreach ($fileSourceMulti as $fileSource) {
    $num += 1;
    $pathOfPhotoNew = workWithFiles($fileSource, $num);
}


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<header>
    <h1>Information is updated.</h1>
    <p><span class="red-bold">Warning!</span> If you see any mistakes, call HR department.</p>
</header>

<div>
    <?php
    echo "<img class=\"img\" public= $pathOfPhotoNew1 >";
    ?>
</div>
<div class="data-position">
    <h2>Your data</h2>
    <table>
        <?php
        foreach ($worker as $data => $itemOfdata) {
            $printData = ucfirst($data);
            echo "<tr><td>$printData:</td>" . "<td>$itemOfdata</td></tr>";
        }
        ?>
    </table>
    <h3>Your add files</h3>
    <table>
        <?php

        foreach ($fileSourceMulti as $item) {
            $printData = ucfirst($item['name']);
            echo "<tr><td>$printData:</td>" . "</tr>";
        }
        ?>
    </table>
</div>

</body>
</html>
