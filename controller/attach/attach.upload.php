<?php
require '../../model/Process.php';
$process = new Process();

//Upload file to server
$process_id = $_POST["process_id_attach"];
$files_post = $_FILES["attach_files"];
$files_keys = array_keys($files_post);

$files = array();
$c = count( $files_post["name"] );

for ($i=0; $i < $c; $i++) { 
    foreach ($files_keys as $key) {
        $files[$i][$key] = $files_post[$key][$i];
    }
}

foreach ($files as $fileID => $value) {
    $file_content = file_get_contents($value['temp_name']);
    file_put_contents("../../upload/attached/" . $value['name'], $file_content);
}


var_dump($process_id);

