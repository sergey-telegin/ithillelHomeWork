<?php

require_once (__DIR__.'/../functions/repository.php');

//$values = [
//    [
//        'name' => 'User 1',
//        'email' => 'User1@example.com',
//        'password' => 'User1@example.com',
//    ],
//    [
//        'name' => 'User 2',
//        'email' => 'User2@example.com',
//        'password' => 'User2@example.com',
//    ],
//    [
//        'name' => 'User 3',
//        'email' => 'user3@example.com',
//        'password' => 'User3@example.com',
//    ],
//    [
//        'name' => 'User 4',
//        'email' => 'user4@example.com',
//        'password' => 'User4@example.com',
//    ],
//    [
//        'name' => 'User 5',
//        'email' => 'user5@example.com',
//        'password' => 'User5@example.com',
//    ],
//    [
//        'name' => 'User 6',
//        'email' => 'user6@example.com',
//        'password' => 'User6@example.com',
//    ]
//];
$values = [
    [
        'User 1',
        'User1@example.com',
        'User1@example.com',
    ],
    [
        'User 2',
        'User2@example.com',
        'User2@example.com',
    ],
    [
        'User 3',
        'user3@example.com',
        'User3@example.com',
    ],
    [
        'User 4',
        'user4@example.com',
        'User4@example.com',
    ],
    [
        'User 5',
        'user5@example.com',
        'User5@example.com',
    ],
    [
        'User 6',
        'user6@example.com',
        'User6@example.com',
    ]
];

$rowsCount = count($values);
$columCount = count(reset($values));

$questionMarks = array_fill(0, count($values[1]), '?');

$placeholderString = '(' . implode(',', $questionMarks) .')';

$valuesParamsPlaceholder = array_fill(0, $rowsCount, $placeholderString);

$queryString = 'insert into `test1` (name, email, pass) values ';

$valuesString = implode(',', $valuesParamsPlaceholder);

$valuesCount = $rowsCount * $columCount;
$queryString.= $valuesString;
$connectionToDB = connectToDb();
$query = $connectionToDB->prepare($queryString);
$counter = 0;
$row = 0;

while ($counter < $valuesCount) {
    $rowIterator = (int)($counter / $columCount);
    $columnIterator = ($counter) % $columCount;
    $query->bindParam(++$counter, $values[$rowIterator][$columnIterator]);
}
try {
    $query->execute();
} catch (Throwable $e) {
    echo $e->getMessage();
}

