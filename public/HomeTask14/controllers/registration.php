<?php
require_once(__DIR__ . '\functions.php');
session_start();

setMethodAlert();
setNameAlert();
setPasswordValidationAlert();
setIsMatchPassAlert();

checkSession ();


echo "registration is successful";