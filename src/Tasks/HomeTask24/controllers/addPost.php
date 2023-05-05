<?php

require_once(__DIR__ . '/../functions/functions.php');
require_once(__DIR__ . '/../functions/validator.php');

if (session_status() !== PHP_SESSION_ACTIVE) session_start();

$errors = [];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $errors['method'][] = "'Method not allowed!'";
    setMessages($errors, 'warnings');
}

$errors = validate($_POST, [
    'title' => 'required|min_length[5]|max_length[100]',
    'author_id' => 'required',
    'text' => 'required|min_length[10]|max_length[1000]']);

if(!$errors){

}

if($_FILES['image']){
    $filePath = loadPhoto();
}


$post = [];
foreach ($_POST as $key => $value){
    $post[$key] = $value;
}

$post['image'] = $filePath;

$isPostSaved = null;
if(!$errors){
    $isPostSaved = savePost($post);
}

if (!$isPostSaved){
    $errors['warnings']['post_saved'] = "'Post is not saved'";
    setMessages($errors, 'warnings');
}

if ($errors) {
    setMessages($errors);
    header('Location: http://localhost:8000/src/Tasks/HomeTask24/addPost.php');
    exit;
}

header('Location: http://localhost:8000/src/Tasks/HomeTask24/posts.php');