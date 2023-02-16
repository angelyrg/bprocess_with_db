<?php
require '../../model/Process.php';
$process = new Process();

$process_id = $_POST["id_process_delete_pdf"];
$pdf_file_name = $process->get_main_file_name($process_id);

if(unlink('../../upload/pdfs/'.$pdf_file_name)){
    //Remove main_file name from DB
    echo $process->remove_pdf($process_id);
    
}else{  
    echo "error";
}

?>