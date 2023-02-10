<?php

require '../../model/Process.php';

$id = $_POST['id_delete'];
$parent_id = $_POST['id_delete_parent'];

$process = new Process();
$result = $process->destroy($id);

echo ($result != "error") ? $parent_id : "error";

?>