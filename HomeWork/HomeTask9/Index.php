<?php
$vacancies = [
    0 => ['id' => 1, 'title' => 'PHP Programmer', 'salary' => 2500, 'sector_id' => 1],
    1 => ['id' => 2, 'title' => 'Designer', 'salary' => 3000, 'sector_id' => 1],
    2 => ['id' => 3, 'title' => 'Finance Manager', 'salary' => 3500, 'sector_id' => 2],
    3 => ['id' => 4, 'title' => 'Finance Director', 'salary' => 3500, 'sector_id' => 2],
];

$sectors = [
    0 => ['id' => 1, 'title' => 'IT'],
    1 => ['id' => 2, 'title' => 'Finance']
];

$vacanciesWithSectors = [];

foreach ($vacancies as $vacancy => $VacancyKeys) {
    foreach ($sectors as $sector)
        if ($VacancyKeys['sector_id'] === $sector['id']) {
            $vacancies[$vacancy]['sector_name'] = $sector['title'];
            unset($vacancies[$vacancy]['sector_id']);
        }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="CSS.css">
    <title>Document</title>
</head>
<body>
<table>
    <tr>
        <?php
        foreach ($vacancies[0] as $key => $vacancy) {
            if ($key == 'sector_name') {
                $key = str_replace('_n', ' N', $key);
            }
            $uckey = ucFirst($key);
            echo '<th>' . $uckey . '</th>';
        }
        ?>
    </tr>

    <?php

    foreach ($vacancies as $key => $vacancy) {
        echo '<tr>';
        foreach ($vacancy as $key => $item) {
            echo '<td>' . $item . '</td>';
        }
        echo '</tr>';
    }
    ?>
</table>
</body>
</html>
