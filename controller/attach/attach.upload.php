<?php
require '../../model/Attachment.php';
$att = new Attachment();

$process_id = $_POST["process_id_attach"];
$file_type = $_POST["file_type"];
$files_post = $_FILES["attach_files"];
$files_keys = array_keys($files_post);

$files = array();
$files_lenght = count( $files_post["name"] );

//Create the folder is it doesn't exists
$attachFolder = '../../upload/attach/';
if (!file_exists($attachFolder)) {
    mkdir($attachFolder, 0777, true);
}

//Sort file info into an array
for ($i=0; $i < $files_lenght; $i++) { 
    foreach ($files_keys as $key) {
        $files[$i][$key] = $files_post[$key][$i];
    }
}

$upload_flag = false;

//Foreach new array, move and save in DB
foreach ($files as $fileID => $value) {
    $upload_flag = false;
    $fileName = $value['tmp_name'];
    $file_content = file_get_contents($fileName);

    $fileExt = pathinfo($value['name'], PATHINFO_EXTENSION);
    $newFileName = pathinfo($value['name'], PATHINFO_FILENAME)."_".time().".".$fileExt;

    //If file was moved into server, save info in DB
    if (file_put_contents($attachFolder . $newFileName, $file_content)){
        $att->insert_new($value['name'], $newFileName, $file_type, $process_id);
        $upload_flag = true;
    }
}

//Return Process ID
echo $upload_flag ? $process_id : '0';