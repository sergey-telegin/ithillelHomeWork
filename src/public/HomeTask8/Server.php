<?php

require_once('Mime.php');

$worker = [];
$fileName = $_POST['name'] . $_POST['surname'];
$pathOfPhotoOld = $_FILES['photo']['tmp_name'];
$directoryOfPhoto = "." . DIRECTORY_SEPARATOR . "Workers" . DIRECTORY_SEPARATOR . "$fileName" . DIRECTORY_SEPARATOR;
$fileExtension = mime2ext($_FILES['photo']['type']);
$pathOfPhotoNew = $directoryOfPhoto . $fileName . $fileExtension;

if (!$fileExtension) {

    echo "<H1>Неверный тип файла</H1>";

    return;
}

foreach ($_POST as $dataItem => $dataValue) {
    $worker[$dataItem] = $dataValue;
}

if (file_exists($directoryOfPhoto) || mkdir($directoryOfPhoto, 0777, true)) {
    rename($pathOfPhotoOld, $pathOfPhotoNew);
};
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
    echo "<img class=\"img\" src= $pathOfPhotoNew >";
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
</div>

</body>
</html>
