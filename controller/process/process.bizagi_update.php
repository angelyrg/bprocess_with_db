<?php
//Set Bizagi folder name in DB
require '../../model/Process.php';
$process = new Process();

$id = $_POST['id'];
$bizagi_folder = $_POST['bizagi_folder'];
// TO DO: Make bizagi folder unique
//$bizagi_folder = time()."/".$_POST['bizagi_folder'];

echo $process->update_bizagi_folder($id, $bizagi_folder);

?>