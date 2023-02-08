<?php

require '../../model/Process.php';

$id = $_POST['id_delete'];

$process = new Process();
//echo $process->destroy_level($id);
var_dump($process->destroy_level($id));

?>