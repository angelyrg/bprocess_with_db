<?php
require '../../model/Process.php';
$process = new Process();

$process_id = $_POST["id_process_delete_bizagi"];
$bizagi_folder_name = '../../upload/bizagi/'.$process->get_bizagi_folder_name($process_id);

if( deleteDirectory($bizagi_folder_name) ){
    //Remove bizagi_folder name from DB
    echo $process->remove_bizagi($process_id);    
}else{  
    echo "error";
}


function deleteDirectory($dir){
    if (is_dir($dir)) {
        $objects = scandir($dir);
        foreach ($objects as $object) {
            if ($object != "." && $object != "..") {
                if (is_dir($dir . "/" . $object))
                    deleteDirectory($dir . "/" . $object);
                else
                    unlink($dir . "/" . $object);
            }
        }
        rmdir($dir);
        return true;
    }else{
        return false;
    }
}

?>