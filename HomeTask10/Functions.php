<?php
function fileExtension($fileSource)
{
    $fileExtension = mime2ext($fileSource['type']);
    if (!$fileExtension) {

        return ("<H1>Неверный тип файла</H1>");

    }
    return $fileExtension;
}

function moveDatafromPostTo(): array
{
    $worker = [];
    foreach ($_POST as $dataItem => $dataValue) {
        $worker[$dataItem] = $dataValue;
    }
    return $worker;
}

function checkUploadPhoto ($filesource){
    if (!empty($filesource['error']) || empty($filesource['tmp_name'])) {
        switch ($filesource['error']) {
            case 1:
            case 2: $error = 'Превышен размер загружаемого файла.'; break;
            case 3: $error = 'Файл был получен только частично.'; break;
            case 4: $error = 'Файл не был загружен.'; break;
            case 6: $error = 'Файл не загружен - отсутствует временная директория.'; break;
            case 7: $error = 'Не удалось записать файл на диск.'; break;
            case 8: $error = 'PHP-расширение остановило загрузку файла.'; break;
            case 9: $error = 'Файл не был загружен - директория не существует.'; break;
            case 10: $error = 'Превышен максимально допустимый размер файла.'; break;
            case 11: $error = 'Данный тип файла запрещен.'; break;
            case 12: $error = 'Ошибка при копировании файла.'; break;
            default: $error = 'Файл не был загружен - неизвестная ошибка.'; break;
        }
        echo ($error);

    }

}

function renameMoveFile($from, $to, $ceckDirectory){
    if (file_exists($ceckDirectory) || mkdir($ceckDirectory, 0777, true)) {
        rename($from, $to);
    }
}

function workWithFiles($filesource, $num){
    checkUploadPhoto($filesource);
    $fileExtension = fileExtension($filesource);
    $fileNewName = $_POST['name'] . $_POST['surname'];
    $photoDirectory = "." . DIRECTORY_SEPARATOR . "Workers" . DIRECTORY_SEPARATOR . "$fileNewName" . DIRECTORY_SEPARATOR;
    $fileLoadedPath = $filesource['tmp_name'];
    $pathOfPhotoNew = $photoDirectory . $fileNewName.$num . "." . $fileExtension;
    renameMoveFile($fileLoadedPath, $pathOfPhotoNew, $photoDirectory);
    return $pathOfPhotoNew;
}


function arrayToOtherArray($filesArray){

    $newArray= [];

    foreach ($filesArray as $key => $propertyArray){

         foreach ($propertyArray as $propertyKey => $propertyName){
             $newArray[$propertyKey][$key]=$propertyName;
         }


    }
    return $newArray;
}