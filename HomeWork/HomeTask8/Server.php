
<?php
$worker = [];
$nameOfWorker = $_POST['name'];
$surnameOfWorker = $_POST['surname'];
$pathOfPhotoOld = $_FILES['photo']['tmp_name'];
$pathOfPhotoNew = "./HomeTask\Workers\\$nameOfWorker$surnameOfWorker\\$nameOfWorker$surnameOfWorker.jpg";

foreach ($_POST as $dataItem => $dataValue){
    $worker[$dataItem] = $dataValue;

}

if (!file_exists("./HomeTask\Workers\\$nameOfWorker.$surnameOfWorker")) {
    @mkdir("./HomeTask\Workers\\$nameOfWorker$surnameOfWorker", 0777, true);
}

rename($pathOfPhotoOld, $pathOfPhotoNew);
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
    <h1>Information update</h1>
    <p>Fill in the fields below for the HR department</p>
</header>

</body>
</html>
