<?php

require '../../model/Process.php';

$id = $_GET['id'];

$process = new Process();
$array_process = $process->get_one_process($id);

echo json_encode($array_process);

?>