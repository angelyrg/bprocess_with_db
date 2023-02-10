<?php
//Update process level name
require '../../model/Process.php';
$process = new Process();

$id = $_POST['id'];
$bizagi_folder = $_POST['bizagi_folder'];

echo $process->update_bizagi_folder($id, $bizagi_folder);

?>