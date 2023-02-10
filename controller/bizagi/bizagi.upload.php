<?php

require_once("../../model/UploadFolder.php");

$up = new UploadFolder();

//Create the folder is it doesn't exists
$bizagiFolder = '../../upload/bizagi/';
if (!file_exists($bizagiFolder)) {
    mkdir($bizagiFolder, 0777, true);
}

$up->set_folder($bizagiFolder);
$up->process($_POST["path"], $_FILES["file"]);

?>
 