<?php
$ds = DIRECTORY_SEPARATOR;
$dir = __DIR__;
$path = "$dir{$ds}..{$ds}src";

function validate($fileName)
{
    return $fileName === '.' || $fileName === '..' || $fileName === 'base';
}

function read($path, $pref = null)
{
    $dirList = scandir($path);
    $urlList = [];
    foreach ($dirList as $fileName) {
        if (validate($fileName)) {
            continue;
        }
        $urlList[] = getUrl($fileName, $path, $pref);
    }

    return $urlList;
}

function getUrl($fileName, $path, $urlPref = null)
{

    if (isHomeTaskValidName($path . DIRECTORY_SEPARATOR . $fileName)) {

        if ($urlPref) {
            $url = "src/$urlPref/$fileName/index.php";
        } else {
            $url = "src/$fileName/index.php";
        }

        return ['name' => $fileName, 'url' => $url];
    }

    if (str_ends_with($fileName, 'php')) {
        $name = substr($fileName, 0, -4);
        return ['name' => $name, 'url' => "src/$fileName"];
    }
    return ['name' => $fileName, 'items' => read($path . $fileName, $fileName)];
}

function isHomeTaskValidName($filePath)
{
    return is_dir($filePath) && file_exists($filePath . DIRECTORY_SEPARATOR . "index.php");
}