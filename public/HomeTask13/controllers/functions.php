<?php
require_once(__DIR__ . '/debugFunction.php');
function setMethodAlert()
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        $_SESSION['method_alert'] = 'Method is not allowed';

    }
}

function printMethodAlert()
{
    if (isset($_SESSION['method_alert'])) {
        print_r($_SESSION['method_alert'] . "<br><br>");
        $_SESSION['method_alert'] = null;

    }
}
//debug($_POST);
function setNameAlert()
{
    if ($_POST['name'] == '' || strlen($_POST['name']) < 5) {
        $_SESSION['no_name'] = 'Name is not set or lenght of name too short';
    }

}

function printNameAlert()
{
    if (isset($_SESSION['no_name'])) {
        print_r($_SESSION['no_name'] . "<br><br>");
        $_SESSION['no_name'] = null;

    }
}

function setPasswordValidationAlert()
{
    $pattern = '/(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z!@#$%^&*]{6,}/';
    if (!preg_match($pattern, $_POST['pass'])) {
        $_SESSION['pathNotValid'] =
            "Your password must:"."<br>".
"contain more than 6 characters". "<br>".
"contain numbers,"."<br>".
"contain special symbols"."<br>".
"contain Latin characters"."<br>".
"contain lowercase characters"."<br>".
"contain uppercase characters"."<br>";

    }

}


function printPasswordValidationAlert()
{
    if (isset($_SESSION['pathNotValid'])) {
        print_r($_SESSION['pathNotValid']."<br><br>");
        $_SESSION['pathNotValid'] = null;

    }
}


function setIsMatchPassAlert()
{
    if ($_POST['pass'] !== $_POST['pass_confirm']) {
        $_SESSION['mismatch_pass'] = 'Passwords mismatch';

    }
}

function printIsMatchPassAlert()
{
    if (isset($_SESSION['mismatch_pass'])) {
        print_r($_SESSION['mismatch_pass']."<br><br>");
        $_SESSION['mismatch_pass'] = null;

    }
}

function checkSession (){
    $tempArray = array_filter($_SESSION);
    if (!empty($tempArray)){
        header('Location: /HomeTask13/index.php');
    }

}


//
//function setMethodAlert($method){
//if ($_SERVER['REQUEST_METHOD']!=='POST'){
//    $_SESSION['alert'] = 'Method is not allowed' ;
//    header('Location: /HomeTask13/index.php');