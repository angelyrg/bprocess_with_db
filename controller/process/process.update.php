<?php

require '../../model/Process.php';

$id_edit = $_POST['id_edit'];
$item_name_edit = $_POST['item_name_edit'];
$is_directory_edit = $_POST['is_directory_edit'] == "1" ? true : ( $_POST['is_directory_edit'] == "0" ? false : "" );
$description = $_POST['item_description_edit'];

$process = new Process();
echo $process->update_process($id_edit, $item_name_edit, $is_directory_edit, $description);

?>