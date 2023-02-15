<?php
require '../../model/Process.php';
$process = new Process();

//Upload file to server
$process_id = $_POST["pdf_process_id"];

$tempPath = $_FILES["pdf_file_name"]["tmp_name"];
$nameFile = $_FILES["pdf_file_name"]["name"];

$fileExt = pathinfo($nameFile, PATHINFO_EXTENSION);
$newFileName = "pdf_".time().".".$fileExt;

$pdfFolder = '../../upload/pdfs/';
if (!file_exists($pdfFolder)) {
    mkdir($pdfFolder, 0777, true);
}

$targetFolder = $pdfFolder.$newFileName;

if ( move_uploaded_file($tempPath, $targetFolder) ){    
    $result = $process->update_main_file($process_id, $newFileName);
    
    echo $result;

}else{
    echo "cant upload";
} 
