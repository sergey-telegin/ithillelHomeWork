<?php
enum ListType
{
    case ol;
    case ul;
}

$animals = ["кошка", "собака", "слон", "жираф", "тигр"];

function htmllist(array $array, ListType $order = ListType::ul){

    $list = '';
    $strings = '';
    $listType = $order->name;

    foreach ($array as $item){
        $strings.="<li>".$item."</li>";
    }

    $list.="<$listType>".$strings."</$listType>";
    return $list;
}
?>

    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="css/style.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
<H1 class="title">Список из массива</H1>

    <?php
    echo htmllist($animals,ListType::ul)
    ?>

</body>
</html>