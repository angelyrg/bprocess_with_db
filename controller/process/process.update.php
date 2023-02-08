<?php

require '../../model/Process.php';

$id_edit = $_POST['id_edit'];
$item_name_edit = $_POST['item_name_edit'];
$is_directory_edit = $_POST['is_directory_edit'] == "1" ? true : ( $_POST['is_directory_edit'] == "0" ? false : "" );

$process = new Process();
$result = $process->update_process($id_edit, $item_name_edit, $is_directory_edit);

echo $result;

?>